<?php

namespace JSCustom\LaravelUserManagement\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;

class UserAddress extends Model
{
  use HasFactory;

  protected $table = 'user_addresses';

  protected $fillable = [
    'user_id',
    'line_1',
    'line_2',
    'city_id',
    'province_id',
    'postal_code',
    'country_id',
    'other_address_details'
  ];

  protected $casts = [
    'user_id' => 'integer',
    'line_1' => 'string',
    'line_2' => 'string',
    'city_id' => 'integer',
    'province_id' => 'integer',
    'postal_code' => 'string',
    'country_id' => 'integer',
    'other_address_details' => 'string'
  ];

  // Disable Laravel's mass assignment protection
  protected $guarded = [];

    public function saveData($request, $id = NULL)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => config('user.model.user_address.user_id'),
            'line_1' => config('user.model.user_address.line_1'),
            'line_2' => config('user.model.user_address.line_2'),
            'city_id' => config('user.model.user_address.city_id'),
            'province_id' => config('user.model.user_address.province_id'),
            'postal_code' => config('user.model.user_address.postal_code'),
            'country_id' => config('user.model.user_address.country_id')
        ]);
        if ($validator->stopOnFirstFailure()->fails()) {
            $errors = $validator->errors();
            return (object)['status' => false, 'message' => $errors->first()];
        }
        $userAddress = UserAddress::updateOrCreate([
          'user_id' => $id
        ],
        [
          'user_id' => $request->user_id,
          'line_1' => $request->line_1,
          'line_2' => $request->line_2,
          'city_id' => $request->city_id,
          'province_id' => $request->province_id,
          'postal_code' => $request->postal_code,
          'country_id' => $request->country_id,
          'other_address_details' => $request->other_address_details
        ]);
        if (!$userAddress) {
            return (object)['status' => false, 'message' => 'Failed to save user address.'];
        }
        return (object)['status' => true, 'message' => 'User address been saved.', 'data' => $userAddress];
    }
}