<?php

namespace App\Http\Controllers;

use Faker\Provider\DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TaskController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    // GET
    public function addTaskForm($project_id){
        $categories = DB::table('category')->where('project_id', $project_id)->get();
        $project_name = DB::table('project')->where('id', $project_id)->pluck('name')->first();

        $contributors = DB::table('users')
            ->join('user_project', 'users.id', '=', 'user_project.user_id')
            ->select('users.id', 'users.name')
            ->where('user_project.project_id', $project_id)
            ->get();

        $list = [];
        foreach ($categories as $category) {
            $list[$category->id] = $category->name;
        }

        return view('addTask', ['list' => $list, 'categories' => $categories, 'project' => $project_name, 'contributors' => $contributors]);
    }

    public function addTaskSameProject($category_id)
    {
        $category = DB::table('category')->where('id', $category_id)->first();
        $project = DB::table('project')->where('id', $category->project_id)->first();

        $project_name = $project->name;
        $categories = DB::table('category')->where('project_id', $project->id)->get();

        $contributors = DB::table('users')
            ->join('user_project', 'users.id', '=', 'user_project.user_id')
            ->select('users.id', 'users.name')
            ->where('user_project.project_id', $project->id)
            ->get();

        $list = [];
        foreach ($categories as $category_iy) {
            $list[$category_iy->id] = $category_iy->name;
        }

        return view('addTask', ['list' => $list, 'item_selected' => $category, 'categories' => $categories, 'project' => $project_name, 'contributors' => $contributors]);
    }

    //POST
    public function addTask(Request $request) {
        $description = $request->input('description');
        $deadline = $request->input('deadline');
        $date = null;
        if($deadline) {
            $date = date('Y-m-d', strtotime($deadline));
        }

        $priority = $request->input('priority');
        $category = $request->input('category');
        $contributors = $request->input('contributors');


        DB::table('task')->insert(['description' => $description,
                                    'deadline' => $date,
                                    'priority' => $priority,
                                    'category_id' => $category
                                  ]);

        $lastTask = DB::table('task')->orderBy('id', 'DESC')->first();

        foreach ((array)$contributors as $contributor) {
             DB::table('user_task')->insert(['user_id' => $contributor, 'task_id' => $lastTask->id]);
        }

        return redirect('tasks/category/'.$category);
    }

    // GET
    public function showAllTasks() {
        $allTasks = DB::table('task')->get();
        $allCategories = DB::table('category')->get();
        $allProjects = DB::table('project')->get();
        return view('tasks', ['tasks' => $allTasks, 'categories' => $allCategories, 'projects' => $allProjects]);
    }

    public function showCategoriesFromProject($n){
        $allProjects = DB::table('project')->get();
        $allCategories = DB::table('category')->where('project_id', $n)->get();
        return view('tasks', ['tasks' => [], 'categories' => $allCategories, 'projects' => $allProjects]);
    }

    // GET
    // TODO: rajouter project_id à TASK pour les non classés
    public function showTaskFromCategory($n) {
        $contributors_name = DB::table('users')
            ->join('user_task', 'users.id', '=', 'user_task.user_id')
            ->join('task', 'task.id', '=', 'user_task.task_id')
            ->select('task.id', 'users.name')
            ->get();

        $category = DB::table('category')->where('id', $n)->get()->first();


        $task_category = DB::table('task')->where('category_id', $n)->get();

        return view('tasks', ['tasks' => $task_category, 'category' => $category, 'contributors' => $contributors_name]);
    }

    // PUT
    public function finishTask($task, $category){
       $finished = DB::table('task')
            ->where('id',$task)
            ->pluck('finished')->first();

       $finished_bool = (bool)$finished;

       if ($finished_bool == "") {
           $finished_bool = 1;
       }
       else {
           $finished_bool = 0;
       }

        DB::table('task')
            ->where('id', $task)
            ->update(['finished' => $finished_bool]);

       return redirect('tasks/category/'.$category);
    }

    //GET
    public function editTaskForm($task_id) {
        $task = DB::table('task')->where('id', $task_id)->first();

        $contributors_task = DB::table('user_task')->where('task_id', $task->id)->pluck('user_id')->toArray();

        $category = DB::table('category')->where('id', $task->category_id)->first();
        $project = DB::table('project')->where('id', $category->project_id)->first();

        $categories_project = DB::table('category')->where('project_id', $project->id)->get();
        $contributors_project = DB::table('users')
            ->join('user_project', 'users.id', '=', 'user_project.user_id')
            ->select('users.id', 'users.name')
            ->where('user_project.project_id', $project->id)
            ->get();

        $listCategory = [];
        foreach ($categories_project as $category_it) {
            $listCategory[$category_it->id] = $category_it->name;
        }

        $listContributors = [];
        foreach ($contributors_project as $contributors) {
            $listContributors[$contributors->id] = $contributors->name;
        }


        return view('editTask',
            ['task' => $task,
                'listCategory' => $listCategory,
                'listContributors' => $listContributors,
                'item_selected' => $category->id,
                'categories_project' => $categories_project,
                'contributors_task' => $contributors_task,
                'contributors_project' => $contributors_project]);
    }

    // POST
    public function editTask($task, Request $request) {
        $description = $request->input('description');
        $deadline = $request->input('deadline');

        $date = null;
        if($deadline) {
            $date = date('Y-m-d', strtotime($deadline));
        }
        $priority = $request->input('priority');
        $category = $request->input('category');

        DB::table('task')->where('id', $task)
        ->update(['description' => $description,
            'deadline' => $date,
            'priority' => $priority,
            'category_id' => $category
        ]);

        $contributors = $request->input('contributors');
        $oldContributors = DB::table('user_task')->where('task_id', $task)->pluck('user_id')->toArray(); // array

        // Insert new contributors
        foreach ((array)$contributors as $contributor) {
            if(is_null(DB::table('user_task')->where('user_id', $contributor)
                                ->where('task_id', $task)
                                ->first())) {
                DB::table('user_task')->insert(['user_id' => $contributor, 'task_id' => $task]);
            }
        }

        // Delete contributors
        foreach($oldContributors as $oldContributor){
            if(!in_array($oldContributor, (array)$contributors)) {
                DB::table('user_task')->where('user_id', $oldContributor)
                    ->delete();
            }
        }

        return redirect('tasks');
    }

    // DELETE
    public function deleteTask($task_id, $category_id) {
        DB::table('task')->where('id', $task_id)->delete();

        return redirect('tasks/category/'.$category_id);
    }

    public function assignTaskForm(){

    }
}
