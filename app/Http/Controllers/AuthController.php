<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function register(Request $request)
    {
        $request->validate([
            'email' => "required|email|unique:users",
            'name' => "required",
            'password' => "required",
            "no_hp" => "required|numeric",
            'role' => ["required", Rule::in(['admin', 'bendahara', 'ketua'])]
        ]);

        $user = User::create([
            'email' => $request->email,
            'name' => $request->name,
            'password' => Hash::make($request->password),
            'no_hp' => $request->no_hp,
            'role' => $request->role,
        ]);

        if ($user) {
            return redirect('/login');
        } else {
            return redirect()->back()->withErrors(['message' => 'Akun berhasil dibuat']);
        }
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if ($validator->fails()) {
            echo ($validator->errors());
        }
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            // Authentication passed...
            //return view('welcome');
            return redirect('/dashboard');
        } else {
            //return redirect()->back()->withErrors(['error' => 'Invalid username or password',]);
            return redirect('/login');
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('auth/login');
    }

    public function test(Request $request)
    {
        $value = $request->session()->all();
        return Auth::user();
    }

    public function token()
    {
        return csrf_token();
    }
}
