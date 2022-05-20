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

    public function store($request)
    {
        $validator = Validator::make($request->all(), [
            'role' => config('user.model.user_role.role'),
            'description' => config('user.model.user_role.description')
        ]);
        if ($validator->stopOnFirstFailure()->fails()) {
            $errors = $validator->errors();
            return (object)['status' => false, 'message' => $errors->first()];
        }
        $userRole = UserRole::create([
            'role' => $request->role,
            'description' => $request->description
        ]);
        if (!$userRole) {
            return (object)['status' => false, 'message' => 'Failed to save user role.'];
        }
        return (object)['status' => true, 'message' => 'User role been saved.', 'data' => $userRole];
    }
}