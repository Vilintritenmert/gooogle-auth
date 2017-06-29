<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserAuthRequest;
use Google;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Auth or Login
     *
     * @param UserAuthRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function auth(Request $request){
        var_die('1');
        $access_token = $request->access_token;


        return response()->json(Google::getProfile($access_token));
    }
}
