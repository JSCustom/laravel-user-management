<?php
return [
    'prefix' => 'api',
    'model' => [
        'user' => [
            'username' => [
                'required' => true,
                'type' => 'string',
                'minlength' => 4,
                'maxlength' => 70
            ],
            'email' => [
                'required' => true,
                'type' => 'email',
                'minlength' => 4,
                'maxlength' => 70
            ],
            'status' => [
                'required' => true,
                'type' => 'integer',
                'default' => 1
            ],
            'role_id' => [
                'required' => true,
                'type' => 'integer',
                'default' => 1
            ]
        ],
        'user_address' => [
            'user_id' => [
                'required' => true,
                'type' => 'integer',
            ],
            'line_1' => [
                'required' => false,
                'type' => 'string',
                'minlength' => 4,
                'maxlength' => 255
            ],
            'line_2' => [
                'required' => false,
                'type' => 'string',
                'minlength' => 4,
                'maxlength' => 255
            ],
            'city_id' => [
                'required' => false,
                'type' => 'integer',
            ],
            'province_id' => [
                'required' => false,
                'type' => 'integer',
            ],
            'postal_code' => [
                'required' => false,
                'type' => 'string',
                'minlength' => 3,
                'maxlength' => 5
            ],
            'country_id' => [
                'required' => false,
                'type' => 'integer',
            ]
        ],
        'user_profile' => [
            'user_id' => [
                'required' => true,
                'type' => 'integer',
            ],
            'first_name' => [
                'required' => true,
                'type' => 'string',
                'minlength' => 1,
                'maxlength' => 70
            ],
            'last_name' => [
                'required' => true,
                'type' => 'string',
                'minlength' => 1,
                'maxlength' => 70
            ]
        ],
        'user_role' => [
            'role' => [
                'required' => true,
                'type' => 'string',
                'unique:user_roles',
                'minlength' => 1,
                'maxlength' => 25
            ],
            'description' => [
                'required' => true,
                'type' => 'string'
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