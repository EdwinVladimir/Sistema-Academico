<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ResetpasswordController extends Controller
{
    public function resetpassword(){

        return view('auth.resetpassword');

    }
}
