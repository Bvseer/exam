<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function auth(Request $request) {
        $validator = Validator::make($request->all(), [
            'login' => 'required|min:5',
            'password' => 'required|min:5',
            'email' => 'required|min:5'
        ]);

        if ($validator->fails()) {
            return redirect('/')
                        ->withErrors($validator)
                        ->withInput();
        }else {
            return redirect('/welcome');
        }
    }
}
