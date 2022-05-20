<?php

namespace JSCustom\LaravelUserManagement\Http\Controllers\User;

use JSCustom\LaravelUserManagement\Http\Controllers\Controller as Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use JSCustom\LaravelUserManagement\Providers\HttpServiceProvider;

class UserController extends Controller
{
    public function store(Request $request)
    {
        if (config('user.sanctum.enabled')) {
            if (!Auth::user()->tokenCan('user-create')) {
                return response(['status' => false, 'message' => HttpServiceProvider::FORBIDDEN_ACCESS_MESSAGE], HttpServiceProvider::FORBIDDEN_ACCESS);
            }
        }
        $user = $this->_user->saveData($request);
        if (!$user->status) {
            return response(['status' => $user->status, 'message' => $user->message], HttpServiceProvider::BAD_REQUEST);
        }
        $user->data->userRole;
        $request->request->add(['user_id' => $user->data->id]);
        $userProfile = $this->_userProfile->saveData($request);
        if (!$userProfile->status) {
            $this->_user->find($request->user_id)->delete();
            return response(['status' => $userProfile->status, 'message' => $userProfile->message], HttpServiceProvider::BAD_REQUEST);
        }
        $user->data->userProfile;
        $userAddress = $this->_userAddress->saveData($request);
        if (!$userAddress->status) {
            $this->_user->find($request->user_id)->delete();
            $this->_userProfile->find($request->user_id)->delete();
            return response(['status' => $userAddress->status, 'message' => $userAddress->message], HttpServiceProvider::BAD_REQUEST);
        }
        $user->data->userAddress;
        return response(['status' => $user->status, 'message' => $user->message, 'payload' => ['user' => $user->data]], HttpServiceProvider::CREATED);
    }
    public function edit(Request $request, $id)
    {
        if (config('user.sanctum.enabled')) {
            if (!Auth::user()->tokenCan('user-edit')) {
                return response(['status' => false, 'message' => HttpServiceProvider::FORBIDDEN_ACCESS_MESSAGE], HttpServiceProvider::FORBIDDEN_ACCESS);
            }
        }
        $user = $this->_user->find($id);
        if (!$user) {
            return response(['status' => false, 'message' => 'Could not find user.'], HttpServiceProvider::BAD_REQUEST);
        }
        $user = $this->_user->saveData($request, $id);
        if (!$user->status) {
            return response(['status' => $user->status, 'message' => $user->message], HttpServiceProvider::BAD_REQUEST);
        }
        $user->data->userRole;
        $request->request->add(['user_id' => $user->data->id]);
        $userProfile = $this->_userProfile->saveData($request, $id);
        if (!$userProfile->status) {
            $this->_user->find($request->user_id)->delete();
            return response(['status' => $userProfile->status, 'message' => $userProfile->message], HttpServiceProvider::BAD_REQUEST);
        }
        $user->data->userProfile;
        $userAddress = $this->_userAddress->saveData($request, $id);
        if (!$userAddress->status) {
            $this->_user->find($request->user_id)->delete();
            $this->_userProfile->find($request->user_id)->delete();
            return response(['status' => $userAddress->status, 'message' => $userAddress->message], HttpServiceProvider::BAD_REQUEST);
        }
        $user->data->userAddress;
        return response(['status' => $user->status, 'message' => $user->message, 'payload' => ['user' => $user->data]], HttpServiceProvider::CREATED);
    }
}