<?php

namespace JSCustom\LaravelUserManagement\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    public function __construct(
        \JSCustom\LaravelUserManagement\Models\User $User,
        \JSCustom\LaravelUserManagement\Models\UserAddress $UserAddress,
        \JSCustom\LaravelUserManagement\Models\UserProfile $UserProfile,
        \JSCustom\LaravelUserManagement\Models\UserRole $UserRole
    ) {
        $this->_user = $User;
        $this->_userAddress = $UserAddress;
        $this->_userProfile = $UserProfile;
        $this->_userRole = $UserRole;
    }
}