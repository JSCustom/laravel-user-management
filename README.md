
# Laravel User Management API
Laravel package for user management. Includes user, user profile and user role.

## Table of Contents

[Getting Started](#getting-started)<br>
[Installation](#installation)<br>
[How to Use](#how-to-use)<br>
&nbsp;[Download Postman API](#download-postman-api)<br>
&nbsp;[User Management](#user-management)<br>

<a name="getting-started"></a>
## Getting Started
Below are the steps in order to integrate user management API to your Laravel project.

<a name="installation"></a>
## Installation
Install the package using composer:

```bash
composer require jscustom/laravel-user-management
```

Export the configuration file:

```bash
php artisan vendor:publish --provider="JSCustom\LaravelUserManagement\Providers\LaravelUserManagementServiceProvider" --tag="config"
```

Export the migration files:

```bash
php artisan vendor:publish --provider="JSCustom\LaravelUserManagement\Providers\LaravelUserManagementServiceProvider" --tag="migrations"
```

Do a quick migration:

```bash
php artisan migrate --path=/database/migrations/laravel-user-management
```

<a name="how-to-use"></a>
## How To Use

<a name="download-postman-api"></a>
### Download Postman API

Download the Postman API Collection [here](https://minhaskamal.github.io/DownGit/#/home?url=https://github.com/JSCustom/laravel-user-management/blob/master/src/assets/postman/Laravel_User_Management.postman_collection.json).

<a name="user-management"></a>
### User Management

**Features**

- Create User
- Update User
- View User Details
- View UserList
- Delete User

**Models**

```bash
JSCustom\LaravelUserManagement\Models\User
JSCustom\LaravelUserManagement\Models\UserAddress
JSCustom\LaravelUserManagement\Models\UserProfile
```

### Create User API

**Controller**

```bash
\JSCustom\LaravelUserManagement\Http\Controllers\User\UserController
```

**URL**

```bash
{{url}}/api/user
```

**Form Data**

```bash
{
  "username": "stevengrant",
  "email": "stevengrant@mail.com",
  "status": 1,
  "role_id": 1,
  "first_name": "Steven",
  "last_name": "Grant",
}
```

**Method**

```bash
POST
```

**Headers**

```bash
{
  "Authorization": "Bearer ...",
  "Accept": "application/json"
}
```

**Response**

```bash
{
  "status": true,
  "message": "User has been saved.",
  "payload": {
    "user": {
      "username": "stevengrant",
      "email": "stevengrant@mail.com",
      "status": 1,
      "role_id": 1,
      "updated_at": "2022-05-23T07:52:41.000000Z",
      "created_at": "2022-05-23T07:52:41.000000Z",
      "id": 2,
      "password_unhashed": "X2QQTVZZ",
      "user_role": {
        "id": 1,
        "role": "Developer",
        "description": "Developer",
        "created_at": "2022-05-23T15:52:12.000000Z",
        "updated_at": "2022-05-23T15:52:12.000000Z"
      },
      "user_profile": {
        "id": 2,
        "user_id": 2,
        "first_name": "Steven",
        "last_name": "Grant",
        "created_at": "2022-05-23T07:52:41.000000Z",
        "updated_at": "2022-05-23T07:52:41.000000Z"
      },
      "user_address": {
        "id": 2,
        "user_id": 2,
        "line_1": null,
        "line_2": null,
        "city_id": null,
        "province_id": null,
        "postal_code": null,
        "country_id": null,
        "other_address_details": null,
        "created_at": "2022-05-23T07:52:41.000000Z",
        "updated_at": "2022-05-23T07:52:41.000000Z"
      }
    }
  }
}
```

### Update User API

**Controller**

```bash
\JSCustom\LaravelUserManagement\Http\Controllers\User\UserController
```

**URL**

```bash
{{url}}/api/user/$id
```

**Form Data**

```bash
{
  "username": "stevengrant",
  "email": "stevengrant@mail.com",
  "status": 1,
  "role_id": 1,
  "first_name": "Steven",
  "last_name": "Grant"
}
```

**Method**

```bash
POST
```

**Headers**

```bash
{
  "Authorization": "Bearer ...",
  "Accept": "application/json"
}
```

**Response**

```bash
{
  "status": true,
  "message": "User has been saved.",
  "payload": {
    "user": {
      "id": 2,
      "username": "stevengrant",
      "email": "stevengrant@mail.com",
      "status": 1,
      "role_id": 1,
      "email_verified_at": null,
      "created_at": "2022-05-23T07:52:41.000000Z",
      "updated_at": "2022-05-23T07:54:02.000000Z",
      "password_unhashed": "OHYY0NB6",
      "user_role": {
        "id": 1,
        "role": "Developer",
        "description": "Developer",
        "created_at": "2022-05-23T15:52:12.000000Z",
        "updated_at": "2022-05-23T15:52:12.000000Z"
      },
      "user_profile": {
        "id": 2,
        "user_id": 2,
        "first_name": "Steven",
        "last_name": "Grant",
        "created_at": "2022-05-23T07:52:41.000000Z",
        "updated_at": "2022-05-23T07:52:41.000000Z"
      },
      "user_address": {
        "id": 2,
        "user_id": 2,
        "line_1": null,
        "line_2": null,
        "city_id": null,
        "province_id": null,
        "postal_code": null,
        "country_id": null,
        "other_address_details": null,
        "created_at": "2022-05-23T07:52:41.000000Z",
        "updated_at": "2022-05-23T07:52:41.000000Z"
      }
    }
  }
}
```

### View User API

**Controller**

```bash
\JSCustom\LaravelUserManagement\Http\Controllers\User\UserController
```

**URL**

```bash
{{url}}/api/user/$id
```

**Method**

```bash
GET
```

**Headers**

```bash
{
  "Authorization": "Bearer ...",
  "Accept": "application/json"
}
```

**Response**

```bash
{
  "status": true,
  "message": "User found.",
  "payload": {
    "user": {
      "id": 2,
      "username": "stevengrant",
      "email": "stevengrant@mail.com",
      "status": 1,
      "role_id": 1,
      "email_verified_at": null,
      "created_at": "2022-05-23T07:52:41.000000Z",
      "updated_at": "2022-05-23T07:54:02.000000Z",
      "user_role": {
        "id": 1,
        "role": "Developer",
        "description": "Developer",
        "created_at": "2022-05-23T15:52:12.000000Z",
        "updated_at": "2022-05-23T15:52:12.000000Z"
      },
      "user_profile": {
        "id": 2,
        "user_id": 2,
        "first_name": "Steven",
        "last_name": "Grant",
        "created_at": "2022-05-23T07:52:41.000000Z",
        "updated_at": "2022-05-23T07:52:41.000000Z"
      },
      "user_address": {
        "id": 2,
        "user_id": 2,
        "line_1": null,
        "line_2": null,
        "city_id": null,
        "province_id": null,
        "postal_code": null,
        "country_id": null,
        "other_address_details": null,
        "created_at": "2022-05-23T07:52:41.000000Z",
        "updated_at": "2022-05-23T07:52:41.000000Z"
      }
    }
  }
}
```

### User List API

**Controller**

```bash
\JSCustom\LaravelUserManagement\Http\Controllers\User\UserController
```

**URL**

```bash
{{url}}/api/user/list
```

**Parameters**

```bash
{
  "page": 1,
  "limit": 10,
  "q": '<search_string>',
  "order_by": '<column_name>',
  "sort": "asc"
}
```

**Method**

```bash
GET
```

**Headers**

```bash
{
  "Authorization": "Bearer ...",
  "Accept": "application/json"
}
```

**Response**

```bash
{
  "message": "Users found.",
  "payload": {
    "users": {
      "current_page": 1,
      "data": [
        {
          "id": 1,
          "username": "developer",
          "email": "developer@mail.com",
          "created_at": "2022-05-23T15:52:12.000000Z",
          "first_name": "Developer",
          "last_name": "Developer",
          "line_1": null,
          "line_2": null,
          "postal_code": null,
          "other_address_details": null,
          "role": "Developer"
        },
        {
          "id": 3,
          "username": "jakelockley",
          "email": "jakelockley@mail.com",
          "created_at": "2022-05-23T07:55:58.000000Z",
          "first_name": "Jake",
          "last_name": "Lockley",
          "line_1": null,
          "line_2": null,
          "postal_code": null,
          "other_address_details": null,
          "role": "Developer"
        },
        {
          "id": 4,
          "username": "marcspector",
          "email": "marcspector@mail.com",
          "created_at": "2022-05-23T07:56:15.000000Z",
          "first_name": "Marc",
          "last_name": "Spector",
          "line_1": null,
          "line_2": null,
          "postal_code": null,
          "other_address_details": null,
          "role": "Developer"
        },
        {
          "id": 2,
          "username": "stevengrant",
          "email": "stevengrant@mail.com",
          "created_at": "2022-05-23T07:52:41.000000Z",
          "first_name": "Steven",
          "last_name": "Grant",
          "line_1": null,
          "line_2": null,
          "postal_code": null,
          "other_address_details": null,
          "role": "Developer"
        }
      ],
      "first_page_url": "http://127.0.0.1:8000/api/user/list?page=1",
      "from": 1,
      "last_page": 1,
      "last_page_url": "http://127.0.0.1:8000/api/user/list?page=1",
      "links": [
        {
          "url": null,
          "label": "&laquo; Previous",
          "active": false
        },
        {
          "url": "http://127.0.0.1:8000/api/user/list?page=1",
          "label": "1",
          "active": true
        },
        {
          "url": null,
          "label": "Next &raquo;",
          "active": false
        }
      ],
      "next_page_url": null,
      "path": "http://127.0.0.1:8000/api/user/list",
      "per_page": "10",
      "prev_page_url": null,
      "to": 4,
      "total": 4
    }
  }
}
```

### Delete User API

**Controller**

```bash
\JSCustom\LaravelUserManagement\Http\Controllers\User\UserController
```

**URL**

```bash
{{url}}/api/user/$id
```

**Method**

```bash
DELETE
```

**Headers**

```bash
{
  "Authorization": "Bearer ...",
  "Accept": "application/json"
}
```

**Response**

```bash
{
  "status": true,
  "message": "User has been deleted."
}
```

### User Role Management

**Features**

- Create User Role
- Update User Role
- View User Role Details
- View User Role List
- Delete User Role

**Models**

```bash
JSCustom\LaravelUserManagement\Models\UserRole
```

### Create User Role API

**Controller**

```bash
\JSCustom\LaravelUserManagement\Http\Controllers\UserRole\UserRoleController
```

**URL**

```bash
{{url}}/api/user-role
```

**Form Data**

```bash
{
  "role": "Staff",
  "description": "Have access to staff level functions"
}
```

**Method**

```bash
POST
```

**Headers**

```bash
{
  "Authorization": "Bearer ...",
  "Accept": "application/json"
}
```

**Response**

```bash
{
  "status": true,
  "message": "User role been saved.",
  "payload": {
    "user_role": {
      "role": "Staff",
      "description": "Have access to administrator level functions",
      "updated_at": "2022-05-23T08:01:10.000000Z",
      "created_at": "2022-05-23T08:01:10.000000Z",
      "id": 2
    }
  }
}
```

### Update User Role API

**Controller**

```bash
\JSCustom\LaravelUserManagement\Http\Controllers\UserRole\UserRoleController
```

**URL**

```bash
{{url}}/api/user-role/$id
```

**Form Data**

```bash
{
  "role": "Staff",
  "description": "Have access to staff level functions"
}
```

**Method**

```bash
POST
```

**Headers**

```bash
{
  "Authorization": "Bearer ...",
  "Accept": "application/json"
}
```

**Response**

```bash
{
  "status": true,
  "message": "User role been saved.",
  "payload": {
    "user_role": {
      "id": 2,
      "role": "Staff",
      "description": "Have access to staff level functions",
      "created_at": "2022-05-23T08:01:10.000000Z",
      "updated_at": "2022-05-23T08:02:27.000000Z"
    }
  }
}
```

### View User Role API

**Controller**

```bash
\JSCustom\LaravelUserManagement\Http\Controllers\UserRole\UserRoleController
```

**URL**

```bash
{{url}}/api/user-role/$id
```

**Method**

```bash
GET
```

**Headers**

```bash
{
  "Authorization": "Bearer ...",
  "Accept": "application/json"
}
```

**Response**

```bash
{
  "status": true,
  "message": "User role found.",
  "payload": {
    "user_role": {
      "id": 2,
      "role": "Staff",
      "description": "Have access to staff level functions",
      "created_at": "2022-05-23T08:01:10.000000Z",
      "updated_at": "2022-05-23T08:02:27.000000Z"
    }
  }
}
```

### User Role List API

**Controller**

```bash
\JSCustom\LaravelUserManagement\Http\Controllers\UserRole\UserRoleController
```

**URL**

```bash
{{url}}/api/user-role/list
```

**Parameters**

```bash
{
  "page": 1,
  "limit": 10,
  "q": '<search_string>',
  "order_by": '<column_name>',
  "sort": "asc"
}
```

**Method**

```bash
GET
```

**Headers**

```bash
{
  "Authorization": "Bearer ...",
  "Accept": "application/json"
}
```

**Response**

```bash
{
  "message": "User roles found.",
  "payload": {
    "user_roles": {
      "current_page": 1,
      "data": [
        {
            "id": 1,
            "role": "Developer",
            "description": "Developer",
            "created_at": "2022-05-23T15:52:12.000000Z",
            "updated_at": "2022-05-23T15:52:12.000000Z"
        },
        {
            "id": 2,
            "role": "Staff",
            "description": "Have access to staff level functions",
            "created_at": "2022-05-23T08:01:10.000000Z",
            "updated_at": "2022-05-23T08:02:27.000000Z"
        }
      ],
      "first_page_url": "http://127.0.0.1:8000/api/user-role/list?page=1",
      "from": 1,
      "last_page": 1,
      "last_page_url": "http://127.0.0.1:8000/api/user-role/list?page=1",
      "links": [
        {
          "url": null,
          "label": "&laquo; Previous",
          "active": false
        },
        {
          "url": "http://127.0.0.1:8000/api/user-role/list?page=1",
          "label": "1",
          "active": true
        },
        {
          "url": null,
          "label": "Next &raquo;",
          "active": false
        }
      ],
      "next_page_url": null,
      "path": "http://127.0.0.1:8000/api/user-role/list",
      "per_page": "10",
      "prev_page_url": null,
      "to": 2,
      "total": 2
    }
  }
}
```

### Delete User Role API

**Controller**

```bash
\JSCustom\LaravelUserManagement\Http\Controllers\UserRole\UserRoleController
```

**URL**

```bash
{{url}}/api/user-role/$id
```

**Method**

```bash
DELETE
```

**Headers**

```bash
{
  "Authorization": "Bearer ...",
  "Accept": "application/json"
}
```

**Response**

```bash
{
  "status": true,
  "message": "User role has been deleted."
}
```

### Support
For support, email developer.jeddsaliba@gmail.com.