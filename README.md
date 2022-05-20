
# Laravel User Management API
Laravel package for user management. Includes user, user profile and user role.
## Getting Started
Below are the steps in order to integrate user management API to your Laravel project.
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

## How To Use

### User Management

**Features**

- Create User
- Update User
- View User Details
- View User List
- Delete User

**Models**

```bash
  JSCustom\LaravelUserManagement\Models\User
  JSCustom\LaravelUserManagement\Models\UserAddress
  JSCustom\LaravelUserManagement\Models\UserProfile
  JSCustom\LaravelUserManagement\Models\UserRole
```

## Create User

**Controller**

```bash
  \JSCustom\LaravelUserManagement\Http\Controllers\User\UserController
```

**URL**

```bash
  {{url}}/api/user
```

**Request**

```bash
  {
    "username": "johnslatery"
    "email": "johnslatery@mail.com"
    "status": 1
    "role_id": 1
    "first_name": "John"
    "last_name": "Slatery"
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
        "username": "johnslatery",
        "email": "johnslatery@mail.com",
        "status": 1,
        "role_id": 1,
        "updated_at": "2022-05-20T14:41:03.000000Z",
        "created_at": "2022-05-20T14:41:03.000000Z",
        "id": 19,
        "password_unhashed": "NWE6YN9V",
        "user_role": {
          "id": 1,
          "role": "Developer",
          "description": "Developer",
          "created_at": "2022-05-17T12:55:53.000000Z",
          "updated_at": "2022-05-17T12:55:53.000000Z"
        },
        "user_profile": {
          "id": 9,
          "user_id": 19,
          "first_name": "John",
          "last_name": "Slatery",
          "created_at": "2022-05-20T14:41:03.000000Z",
          "updated_at": "2022-05-20T14:41:03.000000Z"
        },
        "user_address": {
          "id": 9,
          "user_id": 19,
          "line_1": null,
          "line_2": null,
          "city_id": null,
          "province_id": null,
          "postal_code": null,
          "country_id": null,
          "other_address_details": null,
          "created_at": "2022-05-20T14:41:03.000000Z",
          "updated_at": "2022-05-20T14:41:03.000000Z"
        }
      }
    }
  }
```

## Update User

**Controller**

```bash
  \JSCustom\LaravelUserManagement\Http\Controllers\User\UserController
```

**URL**

```bash
  {{url}}/api/user/$id
```

**Request**

```bash
  {
    "username": "johnslatery"
    "email": "johnslatery@mail.com"
    "status": 1
    "role_id": 1
    "first_name": "John"
    "last_name": "Slatery"
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
        "username": "johnslatery",
        "email": "johnslatery@mail.com",
        "status": 1,
        "role_id": 1,
        "updated_at": "2022-05-20T14:41:03.000000Z",
        "created_at": "2022-05-20T14:41:03.000000Z",
        "id": 19,
        "password_unhashed": "NWE6YN9V",
        "user_role": {
          "id": 1,
          "role": "Developer",
          "description": "Developer",
          "created_at": "2022-05-17T12:55:53.000000Z",
          "updated_at": "2022-05-17T12:55:53.000000Z"
        },
        "user_profile": {
          "id": 9,
          "user_id": 19,
          "first_name": "John",
          "last_name": "Slatery",
          "created_at": "2022-05-20T14:41:03.000000Z",
          "updated_at": "2022-05-20T14:41:03.000000Z"
        },
        "user_address": {
          "id": 9,
          "user_id": 19,
          "line_1": null,
          "line_2": null,
          "city_id": null,
          "province_id": null,
          "postal_code": null,
          "country_id": null,
          "other_address_details": null,
          "created_at": "2022-05-20T14:41:03.000000Z",
          "updated_at": "2022-05-20T14:41:03.000000Z"
        }
      }
    }
  }
```

## Support
For support, email developer.jeddsaliba@gmail.com or join our Slack channel.