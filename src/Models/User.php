<?php

namespace JSCustom\LaravelUserManagement\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class User extends Authenticatable
{
  use HasApiTokens, HasFactory, Notifiable;

  protected $table = 'users';

  protected $fillable = [
    'username',
    'email',
    'password',
    'status',
    'role_id',
    'email_verified_at'
  ];
  
  protected $hidden = [
    'password',
    'remember_token',
  ];

  protected $casts = [
    'username' => 'string',
    'email' => 'string',
    'password' => 'string',
    'status' => 'integer',
    'role_id' => 'integer',
    'email_verified_at' => 'datetime'
  ];

  protected $guarded = [];

  public function userProfile() {
    return $this->hasOne(UserProfile::class, 'user_id', 'id');
  }
  public function userAddress() {
    return $this->hasOne(UserAddress::class, 'user_id', 'id');
  }
  public function userRole() {
    return $this->belongsTo(UserRole::class, 'role_id', 'id');
  }
  public function saveData($request, $id = NULL)
  {
    if (!config('user.model.user.status.required')) {
      $request->status = config('user.model.user.status.default');
    }
    if (!config('user.model.user.role_id.required')) {
      $request->role_id = config('user.model.user.role_id.default');
    }
    $validator = Validator::make($request->all(), [
      'username' => [
        config('user.model.user.username.required') ? 'required' : 'nullable',
        config('user.model.user.username.type'),
        config('user.model.user.username.unique') ? 'unique:users,username,'.$id.',id' : '',
        'min:' . config('user.model.user.username.minlength') ?? 0,
        'max:' . config('user.model.user.username.maxlength') ?? 255
      ],
      'email' => [
        config('user.model.user.email.required') ? 'required' : 'nullable',
        config('user.model.user.email.type'),
        config('user.model.user.email.unique') ? 'unique:users,email,'.$id.',id' : '',
        'min:' . config('user.model.user.email.minlength') ?? 0,
        'max:' . config('user.model.user.email.maxlength') ?? 255
      ],
      'status' => [
        config('user.model.user.status.required') ? 'required' : 'nullable',
        config('user.model.user.status.type')
      ],
      'role_id' => [
        config('user.model.user.role_id.required') ? 'required' : 'nullable',
        config('user.model.user.role_id.type')
      ]
    ]);
    if ($validator->stopOnFirstFailure()->fails()) {
      $errors = $validator->errors();
      return (object)['status' => false, 'message' => $errors->first()];
    }
    $password = strtoupper(Str::random(8));
    if ($request->password) {
      $password = $request->password;
    }
    $user = User::updateOrCreate([
      'id' => $id
    ],
    [
      'username' => $request->username ?? NULL,
      'email' => $request->email ?? NULL,
      'password' => Hash::make($password),
      'status' => $request->status,
      'role_id' => $request->role_id
    ]);
    if (!$user) {
      return (object)['status' => false, 'message' => 'Failed to save user.'];
    }
    $user->password_unhashed = $password;
    return (object)['status' => true, 'message' => 'User has been saved.', 'data' => $user];
  }
  public function list($request)
  {
    $page = $request->page ?? 1;
    $limit = $request->limit ?? 10;
    $search = $request->q ?? null;
    $fromDate = $request->date_start;
    $toDate = $request->date_end;
    if ($fromDate && $toDate) {
      $startDate = date('Y-m-d', strtotime($fromDate));
      $lastDate = date('Y-m-d', strtotime($toDate));
    }
    \DB::statement("SET SQL_MODE=''");
    $query = User::join('user_profiles', 'user_profiles.user_id', '=', 'users.id')
    ->join('user_addresses', 'user_addresses.user_id', '=', 'users.id')
    ->join('user_roles', 'user_roles.id', '=', 'users.role_id');
    $query->select(DB::raw('users.id, users.username, users.email, users.created_at, user_profiles.first_name, user_profiles.last_name, user_addresses.line_1, user_addresses.line_2, user_addresses.postal_code, user_addresses.other_address_details'));
    if ($startDate && $lastDate) {
      $query->whereBetween('users.created_at', [$startDate, $lastDate]);
    }
    if ($search) {
      $query->where(function($q) use ($search, $request) {
          $q->where('users.username', 'like', '%'.$search.'%')
          ->orWhere('users.email', 'like', '%'.$search.'%')
          ->orWhere('user_profiles.first_name', 'like', '%'.$search.'%')
          ->orWhere('user_profiles.last_name', 'like', '%'.$search.'%')
          ->orWhere('user_addresses.line_1', 'like', '%'.$search.'%')
          ->orWhere('user_addresses.line_2', 'like', '%'.$search.'%')
          ->orWhere('user_addresses.postal_code', 'like', '%'.$search.'%')
          ->orWhere('user_addresses.other_address_details', 'like', '%'.$search.'%');
      });
    }
    $list = $query->paginate($request->limit, ['*'], 'page', $request->page);
    return $list;
  }
}