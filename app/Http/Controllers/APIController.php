<?php

namespace App\Http\Controllers;

use App\Models\UserModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class APIController extends Controller
{
    private UserModel $user_model;

    function __construct(){
        $this->user_model = new UserModel();
    }

    public function get_users_info(Request $request): \Illuminate\Http\JsonResponse
    {
        if ($request->filled('user_email') && $request->filled('user_password')) {
            $user = $this->user_model->get_users(['user_email'=>$request->input('user_email'), 'user_password'=>$request->input('user_password')]);
            if (!$user->isEmpty()) {
                if ($user->first()->user_role == 'super_admin')
                    return response()->json(['data'=>$this->user_model->get_users(), 'error'=>false]);
                else
                    return response()->json(['data'=>$user, 'error'=>false]);
            }
            else
                return response()->json(['message'=>'invalid email or password', 'error'=>true]);
        }
        else
            return response()->json(['message'=>'please input email and password', 'error'=>true]);
    }
}
