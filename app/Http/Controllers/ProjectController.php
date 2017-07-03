<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProjectController extends Controller
{
    // GET
    public function addProjectForm() {
        return view('addProject');
    }

    // POST
    public function addProject(Request $request) {
        $name = $request->input('name');

        DB::table('project')->insert(['name' => $name]);
        return redirect('tasks');
    }
}
