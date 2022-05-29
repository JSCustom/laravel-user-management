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
            $this->_userProfile->whereUserId($request->user_id)->delete();
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
            $this->_userProfile->whereUserId($request->user_id)->delete();
            return response(['status' => $userAddress->status, 'message' => $userAddress->message], HttpServiceProvider::BAD_REQUEST);
        }
        $user->data->userAddress;
        return response(['status' => $user->status, 'message' => $user->message, 'payload' => ['user' => $user->data]], HttpServiceProvider::OK);
    }
    public function destroy(Request $request, $id)
    {
        if (config('user.sanctum.enabled')) {
            if (!Auth::user()->tokenCan('user-delete')) {
                return response(['status' => false, 'message' => HttpServiceProvider::FORBIDDEN_ACCESS_MESSAGE], HttpServiceProvider::FORBIDDEN_ACCESS);
            }
        }
        $user = $this->_user->find($id);
        if (!$user) {
            return response(['status' => false, 'message' => 'Could not find user.'], HttpServiceProvider::BAD_REQUEST);
        }
        $this->_user->find($id)->delete();
        $this->_userProfile->whereUserId($id)->delete();
        $this->_userAddress->whereUserId($id)->delete();
        return response(['status' => true, 'message' => 'User has been deleted.'], HttpServiceProvider::OK);
    }
    public function list(Request $request)
    {
        if (config('user.sanctum.enabled')) {
            if (!Auth::user()->tokenCan('user-list')) {
                return response(['status' => false, 'message' => HttpServiceProvider::FORBIDDEN_ACCESS_MESSAGE], HttpServiceProvider::FORBIDDEN_ACCESS);
            }
        }
        $list = $this->_user->list($request);
        return response(['message' => 'Users found.', 'payload' => ['users' => $list]], HttpServiceProvider::OK);
    }
    public function show(Request $request, $id)
    {
        if (config('user.sanctum.enabled')) {
            if (!Auth::user()->tokenCan('user-view')) {
                return response(['status' => false, 'message' => HttpServiceProvider::FORBIDDEN_ACCESS_MESSAGE], HttpServiceProvider::FORBIDDEN_ACCESS);
            }
        }
        $user = $this->_user->find($id);
        if (!$user) {
            return response(['status' => false, 'message' => 'Could not find user.'], HttpServiceProvider::BAD_REQUEST);
        }
        $user->userRole;
        $user->userProfile;
        $user->userAddress;
        return response(['status' => true, 'message' => 'User found.', 'payload' => ['user' => $user]], HttpServiceProvider::OK);
    }
    public function generateToken(Request $request)
    {
        if (config('user.sanctum.enabled')) {
            $accessToken = null;
            $user = $this->_user->find(1);
            if (!$user) {
                return response(['status' => false, 'message' => 'Could not generate token.'], HttpServiceProvider::BAD_REQUEST);
            }
            $accessToken = $user->createToken('access_token', config('user.abilities'));
            return response(['status' => true, 'message' => 'Access token generated.', 'payload' => ['access_token' => $accessToken->plainTextToken]]);
        } else {
            return response(['status' => false, 'message' => 'Please enable sanctum in config/user file.'], HttpServiceProvider::BAD_REQUEST);
        }
    }
}