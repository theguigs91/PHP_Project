<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function create()
    {
        return view('infos');
    }

    public function store(Request $request)
    {
        return 'Le nom est ' . $request->input('nom');
    }

    public function login(Request $request) {
        return 'LOGIN : Le nom est ' . $request->input('login') . ' et le MDP est ' . $request->input('password');
    }

    public function signin(Request $request) {
        return 'SIGNIN : Le nom est ' . $request->input('login') . ' et le MDP est ' . $request->input('password');
    }
}
