<?php

namespace JSCustom\LaravelUserManagement\Http\Controllers\UserRole;

use JSCustom\LaravelUserManagement\Http\Controllers\Controller as Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use JSCustom\LaravelUserManagement\Providers\HttpServiceProvider;

class UserRoleController extends Controller
{
    public function store(Request $request)
    {
        if (config('user.sanctum.enabled')) {
            if (!Auth::user()->tokenCan('user-role-create')) {
                return response(['status' => false, 'message' => HttpServiceProvider::FORBIDDEN_ACCESS_MESSAGE], HttpServiceProvider::FORBIDDEN_ACCESS);
            }
        }
        $userRole = $this->_userRole->saveData($request);
        if (!$userRole->status) {
            return response(['status' => $userRole->status, 'message' => $userRole->message], HttpServiceProvider::BAD_REQUEST);
        }
        return response(['status' => $userRole->status, 'message' => $userRole->message, 'payload' => ['user_role' => $userRole->data]], HttpServiceProvider::CREATED);
    }
    public function edit(Request $request, $id = null)
    {
        if (config('user.sanctum.enabled')) {
            if (!Auth::user()->tokenCan('user-role-edit')) {
                return response(['status' => false, 'message' => HttpServiceProvider::FORBIDDEN_ACCESS_MESSAGE], HttpServiceProvider::FORBIDDEN_ACCESS);
            }
        }
        if (!$id) {
            $id = Auth::user()->id;
        }
        $userRole = $this->_userRole->find($id);
        if (!$userRole) {
            return response(['status' => false, 'message' => 'Could not find user role.'], HttpServiceProvider::BAD_REQUEST);
        }
        $userRole = $this->_userRole->saveData($request, $id);
        if (!$userRole->status) {
            return response(['status' => $userRole->status, 'message' => $userRole->message], HttpServiceProvider::BAD_REQUEST);
        }
        return response(['status' => $userRole->status, 'message' => $userRole->message, 'payload' => ['user_role' => $userRole->data]], HttpServiceProvider::OK);
    }
    public function destroy(Request $request, $id)
    {
        if (config('user.sanctum.enabled')) {
            if (!Auth::user()->tokenCan('user-role-delete')) {
                return response(['status' => false, 'message' => HttpServiceProvider::FORBIDDEN_ACCESS_MESSAGE], HttpServiceProvider::FORBIDDEN_ACCESS);
            }
        }
        $userRole = $this->_userRole->find($id);
        if (!$userRole) {
            return response(['status' => false, 'message' => 'Could not find user role.'], HttpServiceProvider::BAD_REQUEST);
        }
        $this->_userRole->find($id)->delete();
        return response(['status' => true, 'message' => 'User role has been deleted.'], HttpServiceProvider::OK);
    }
    public function list(Request $request)
    {
        if (config('user.sanctum.enabled')) {
            if (!Auth::user()->tokenCan('user-role-list')) {
                return response(['status' => false, 'message' => HttpServiceProvider::FORBIDDEN_ACCESS_MESSAGE], HttpServiceProvider::FORBIDDEN_ACCESS);
            }
        }
        $list = $this->_userRole->list($request);
        return response(['message' => 'User roles found.', 'payload' => ['user_roles' => $list]], HttpServiceProvider::OK);
    }
    public function show(Request $request, $id = null)
    {
        if (config('user.sanctum.enabled')) {
            if (!Auth::user()->tokenCan('user-role-view')) {
                return response(['status' => false, 'message' => HttpServiceProvider::FORBIDDEN_ACCESS_MESSAGE], HttpServiceProvider::FORBIDDEN_ACCESS);
            }
        }
        if (!$id) {
            $id = Auth::user()->id;
        }
        $userRole = $this->_userRole->find($id);
        if (!$userRole) {
            return response(['status' => false, 'message' => 'Could not find user role.'], HttpServiceProvider::BAD_REQUEST);
        }
        return response(['status' => true, 'message' => 'User role found.', 'payload' => ['user_role' => $userRole]], HttpServiceProvider::OK);
    }
}