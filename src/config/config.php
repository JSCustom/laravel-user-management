<?php
return [
    'prefix' => 'api',
    'model' => [
        'user' => [
            'username' => [
                'required',
                'string',
                'unique:users',
                'max:70',
                'min:4'
            ],
            'email' => [
                'required',
                'email',
                'unique:users',
                'max:70'
            ],
            'status' => [
                'required',
                'integer',
                'max:1'
            ],
            'role_id' => [
                'required',
                'integer',
                'max:2'
            ]
        ],
        'user_address' => [
            'user_id' => [
                'required',
                'integer'
            ],
            'line_1' => [
                'string',
                'max:255'
            ],
            'line_2' => [
                'string',
                'max:255'
            ],
            'city_id' => [
                'integer'
            ],
            'province_id' => [
                'integer'
            ],
            'postal_code' => [
                'string',
                'max:5'
            ],
            'country_id' => [
                'integer'
            ]
        ],
        'user_profile' => [
            'user_id' => [
                'required',
                'integer'
            ],
            'first_name' => [
                'required',
                'string',
                'max:70'
            ],
            'last_name' => [
                'required',
                'string',
                'max:70'
            ]
        ],
        'user_role' => [
            'role' => [
                'required',
                'string',
                'unique:user_roles',
                'max:25'
            ],
            'description' => [
                'required',
                'string'
            ]
        ]
    ],
    'sanctum' => [
        'enabled' => false,
        'modules' => [
            'user-create',
            'user-edit',
            'user-list',
            'user-view',
            'user-delete'
        ]
    ],
    'middleware' => ['api']
];
?>