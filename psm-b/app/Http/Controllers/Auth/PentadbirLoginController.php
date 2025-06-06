<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class PentadbirLoginController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            //'ic_no' => 'required|ic_no',
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Optionally, you can limit the login to users with role_id = 3 (Pentadbir)
        if (!Auth::attempt($request->only('ic_no', 'password'), $request->filled('remember'))) {
            throw ValidationException::withMessages([
                'ic_no' => ['The provided credentials are incorrect.'],
            ]);
        }

        // Optional: check user role before proceeding
        $user = Auth::user();
        if (!$user->roles->contains('id', 3)) {
            Auth::logout();
            throw ValidationException::withMessages([
                'ic_no' => ['You do not have permission to login as Pentadbir.'],
            ]);
        }

        $request->session()->regenerate();

        //return response()->json(Auth::user());
    }
}
