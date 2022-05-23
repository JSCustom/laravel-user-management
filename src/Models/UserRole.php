<?php

namespace JSCustom\LaravelUserManagement\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;

class UserRole extends Model
{
  use HasFactory;

  protected $table = 'user_roles';

  protected $fillable = [
    'role',
    'description'
  ];

  protected $casts = [
    'role' => 'string',
    'description' => 'string'
  ];

  // Disable Laravel's mass assignment protection
  protected $guarded = [];

  public function saveData($request)
  {
    $validator = Validator::make($request->all(), [
        'role' => [
          config('user.model.user_role.role.required') ? 'required' : 'nullable',
          config('user.model.user_role.role.type'),
          config('user.model.user_role.role.unique') ? 'unique:user_roles,role,'.$id.',id' : '',
          'min:' . config('user.model.user_role.role.minlength') ?? 0,
          'max:' . config('user.model.user_role.role.maxlength') ?? 255
        ],
        'description' => [
          config('user.model.user_role.description.required') ? 'required' : 'nullable',
          config('user.model.user_role.description.type'),
          'min:' . config('user.model.user_role.description.minlength') ?? 0,
          'max:' . config('user.model.user_role.description.maxlength') ?? 255
        ]
    ]);
    if ($validator->stopOnFirstFailure()->fails()) {
        $errors = $validator->errors();
        return (object)['status' => false, 'message' => $errors->first()];
    }
    $userRole = UserRole::updateOrCreate([
      'id' => $id
    ],
    [
      'role' => $request->role ?? NULL,
      'description' => $request->description ?? NULL
    ]);
    if (!$userRole) {
        return (object)['status' => false, 'message' => 'Failed to save user role.'];
    }
    return (object)['status' => true, 'message' => 'User role been saved.', 'data' => $userRole];
  }
  public function list($request)
  {
    $page = $request->page ?? 1;
    $limit = $request->limit ?? 10;
    $search = $request->q ?? null;
    $startDate = $request->date_start ?? NULL;
    $lastDate = $request->date_end ?? NULL;
    if ($startDate && $lastDate) {
      $startDate = date('Y-m-d', strtotime($fromDate));
      $lastDate = date('Y-m-d', strtotime($toDate));
    }
    \DB::statement("SET SQL_MODE=''");
    $query = UserRole::select('*');
    if ($startDate && $lastDate) {
      $query->whereBetween('user_roles.created_at', [$startDate, $lastDate]);
    }
    if ($search) {
      $query->where(function($q) use ($search, $request) {
          $q->where('user_roles.role', 'like', '%'.$search.'%')
          ->orWhere('user_roles.description', 'like', '%'.$search.'%');
      });
    }
    if ($request->order_by && $request->sort) {
      $query->orderBy($request->order_by,  $request->sort);
    } else {
      $query->orderBy('created_at', 'desc');
    }
    $list = $query->paginate($request->limit, ['*'], 'page', $request->page);
    return $list;
  }
}