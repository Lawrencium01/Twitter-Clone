<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Mail\WelcomeEmail;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class AuthController extends Controller
{
    public function register(){
        return view("auth.register");
    }

    public function store(){
        $validated = request()->validate([
            "name"=> "required|min:4|max:40",
            "email"=> ["required","email", Rule::unique('users','email')],
            "password"=> "required|confirmed|min:8"
        ]);
        $user = User::create([
            "name"=> $validated["name"],
            "email"=> $validated["email"],
            "password"=> Hash::make($validated["password"]),
        ]);

        Mail::to($user->email)->send(new WelcomeEmail($user));

        return redirect()->route('dashboard')->with("success","Account created successfully");
    }

    public function login(){
        return view("auth.login");
    }

    public function authenticate(){

        $validated = request()->validate([
            "email"=> ["required","email"],
            "password"=> "required|min:8"
        ]);

        if(auth()->attempt($validated)){
            request()->session()->regenerate();
            return redirect()->route("dashboard")->with("success","Logged in successful");
        }

        return redirect("login")->withErrors([
            "email"=> "No matching user found with the provided email and password"
        ]);
    }

    public function logout(){

        request()->session()->invalidate();
        request()->session()->regenerateToken();

        auth()->logout();

        return redirect()->route('dashboard')->with('success','User successfully logged out');


    }
}
