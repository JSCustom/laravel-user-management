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
    $validator = Validator::make($request->all(), [
      'username' => config('user.model.user.username'),
      'email' => config('user.model.user.email'),
      'status' => config('user.model.user.status'),
      'role_id' => config('user.model.user.role_id')
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
      'username' => $request->username,
      'email' => $request->email,
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
}