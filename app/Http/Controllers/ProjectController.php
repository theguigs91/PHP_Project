<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProjectController extends Controller
{
    public function showAllProjects() {
        $allProjects = DB::table('project')->get();

        $categories = [];
        foreach ($allProjects as $project) {
            $allCategories = DB::table('category')->where('project_id', $project->id)->get();
            $categories[$project->id] = $allCategories;
        }
        return view('projects', ['categories' => $categories, 'projects' => $allProjects]);
    }

    // GET
    public function addProjectForm() {
        return view('addProject');
    }

    // POST
    public function addProject(Request $request) {
        $name = $request->input('name');

        DB::table('project')->insert(['name' => $name]);
        return redirect('projects');
    }
}
