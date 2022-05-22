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
            'user_id' => [
              config('user.model.user_profile.user_id.required') ? 'required' : 'nullable',
              config('user.model.user_profile.user_id.type')
            ],
            'first_name' => [
              config('user.model.user_profile.first_name.required') ? 'required' : 'nullable',
              config('user.model.user_profile.first_name.type'),
              'min:' . config('user.model.user_profile.first_name.minlength') ?? 0,
              'max:' . config('user.model.user_profile.first_name.maxlength') ?? 255
            ],
            'last_name' => [
              config('user.model.user_profile.last_name.required') ? 'required' : 'nullable',
              config('user.model.user_profile.last_name.type'),
              'min:' . config('user.model.user_profile.last_name.minlength') ?? 0,
              'max:' . config('user.model.user_profile.last_name.maxlength') ?? 255
            ]
        ]);
        if ($validator->stopOnFirstFailure()->fails()) {
            $errors = $validator->errors();
            return (object)['status' => false, 'message' => $errors->first()];
        }
        $userProfile = UserProfile::updateOrCreate([
          'user_id' => $id
        ],
        [
            'user_id' => $request->user_id ?? NULL,
            'first_name' => $request->first_name ?? NULL,
            'last_name' => $request->last_name ?? NULL
        ]);
        if (!$userProfile) {
            return (object)['status' => false, 'message' => 'Failed to save user profile.'];
        }
        return (object)['status' => true, 'message' => 'User profile been saved.', 'data' => $userProfile];
    }
}