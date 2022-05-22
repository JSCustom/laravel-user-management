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
            'user_id' => [
              config('user.model.user_address.user_id.required') ? 'required' : 'nullable',
              config('user.model.user_address.user_id.type')
            ],
            'line_1' => [
              config('user.model.user_address.line_1.required') ? 'required' : 'nullable',
              config('user.model.user_address.line_1.type'),
              'min:' . config('user.model.user_address.line_1.minlength') ?? 0,
              'max:' . config('user.model.user_address.line_1.maxlength') ?? 255
            ],
            'line_2' => [
              config('user.model.user_address.line_2.required') ? 'required' : 'nullable',
              config('user.model.user_address.line_2.type'),
              'min:' . config('user.model.user_address.line_2.minlength') ?? 0,
              'max:' . config('user.model.user_address.line_2.maxlength') ?? 255
            ],
            'city_id' => [
              config('user.model.user_address.city_id.required') ? 'required' : 'nullable',
              config('user.model.user_address.city_id.type')
            ],
            'province_id' => [
              config('user.model.user_address.province_id.required') ? 'required' : 'nullable',
              config('user.model.user_address.province_id.type')
            ],
            'postal_code' => [
              config('user.model.user_address.postal_code.required') ? 'required' : 'nullable',
              config('user.model.user_address.postal_code.type'),
              'min:' . config('user.model.user_address.postal_code.minlength') ?? 0,
              'max:' . config('user.model.user_address.postal_code.maxlength') ?? 255
            ],
            'country_id' => [
              config('user.model.user_address.country_id.required') ? 'required' : 'nullable',
              config('user.model.user_address.country_id.type')
            ]
        ]);
        if ($validator->stopOnFirstFailure()->fails()) {
            $errors = $validator->errors();
            return (object)['status' => false, 'message' => $errors->first()];
        }
        $userAddress = UserAddress::updateOrCreate([
          'user_id' => $id
        ],
        [
          'user_id' => $request->user_id ?? NULL,
          'line_1' => $request->line_1 ?? NULL,
          'line_2' => $request->line_2 ?? NULL,
          'city_id' => $request->city_id ?? NULL,
          'province_id' => $request->province_id ?? NULL,
          'postal_code' => $request->postal_code ?? NULL,
          'country_id' => $request->country_id ?? NULL,
          'other_address_details' => $request->other_address_details ?? NULL,
        ]);
        if (!$userAddress) {
            return (object)['status' => false, 'message' => 'Failed to save user address.'];
        }
        return (object)['status' => true, 'message' => 'User address been saved.', 'data' => $userAddress];
    }
}