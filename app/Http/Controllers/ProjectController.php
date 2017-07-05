<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ProjectController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function showAllProjects() {
        $allProjects = DB::table('project')->get();

        $userId = Auth::id();

        $projects = DB::table('user_project')
            ->join('project', 'user_project.project_id', '=', 'project.id')
            ->select('project.id', 'project.name')
            ->where('user_project.user_id', $userId)
            ->get();

        $categories = [];
        foreach ($projects as $project) {
            $allCategories = DB::table('category')->where('project_id', $project->id)->get();
            $categories[$project->id] = $allCategories;
        }

        return view('projects', ['categories' => $categories, 'projects' => $projects]);
    }

    // GET
    public function addProjectForm() {
        return view('addProject');
    }

    // POST
    public function addProject(Request $request) {
        $name = $request->input('name');

        DB::table('project')->insert(['name' => $name]);

        $projectId = DB::table('project')
            ->where('project.name', $name)
            ->pluck('id')
            ->first();

        $userId = Auth::id();


        DB::table('user_project')->insert(['user_id' => $userId, 'project_id' => $projectId]);

        return redirect('projects');
    }

    // GET
    public function addUserForProjectForm($id) {
        $project = DB::table('project')
            ->where('project.id', $id)
            ->get()
            ->first();

        return view('addUserForProject', ['project' => $project]);
    }

    // POST
    public function addUserForProject($projectId, Request $request) {
        $mail = $request->input('userEmail');

        $userId = DB::table('users')
            ->where('users.email', $mail)
            ->pluck('id')
            ->first();
        
        DB::table('user_project')->insert(['user_id' => $userId, 'project_id' => $projectId]);

        return redirect('projects');
    }
}
