<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class WelcomeController extends Controller
{
    public function index()
    {
        //DB::insert('insert into user (email, password) values (?, ?)', ['g.a@free.fr', 'rooot']);
        //$users = DB::select('select * from user');

        //return $users;
        return view('welcome');
    }
}
