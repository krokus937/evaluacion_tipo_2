<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {

        $userData     = User::get("email","name");
        $Response=APIHelpers::APIResponse(false,200,null,$userData);
        return response()->json($Response,200);
    }
}
