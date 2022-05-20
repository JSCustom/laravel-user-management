<?php

namespace JSCustom\LaravelUserManagement\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;

class UserProfile extends Model
{
  use HasFactory;

  protected $table = 'user_profiles';

  protected $fillable = [
    'user_id',
    'first_name',
    'last_name'
  ];

  protected $casts = [
    'user_id' => 'integer',
    'first_name' => 'string',
    'last_name' => 'string'
  ];

  // Disable Laravel's mass assignment protection
  protected $guarded = [];

    public function saveData($request, $id = NULL)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => config('user.model.user_profile.user_id'),
            'first_name' => config('user.model.user_profile.first_name'),
            'last_name' => config('user.model.user_profile.last_name')
        ]);
        if ($validator->stopOnFirstFailure()->fails()) {
            $errors = $validator->errors();
            return (object)['status' => false, 'message' => $errors->first()];
        }
        $userProfile = UserProfile::updateOrCreate([
          'user_id' => $id
        ],
        [
            'user_id' => $request->user_id,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name
        ]);
        if (!$userProfile) {
            return (object)['status' => false, 'message' => 'Failed to save user profile.'];
        }
        return (object)['status' => true, 'message' => 'User profile been saved.', 'data' => $userProfile];
    }
}