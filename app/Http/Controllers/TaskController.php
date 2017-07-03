<?php

namespace App\Http\Controllers;

use Faker\Provider\DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TaskController extends Controller
{
    // GET
    public function addTaskForm($project_id){
        $categories = DB::table('category')->where('project_id', $project_id)->get();
        $project_name = DB::table('project')->where('id', $project_id)->pluck('name')->first();

        $contributors = DB::table('user')
            ->join('user_project', 'user.id', '=', 'user_project.user_id')
            ->select('user.id', 'user.name')
            ->where('user_project.project_id', $project_id)
            ->get();

        return view('addTask', ['categories' => $categories, 'project' => $project_name, 'contributors' => $contributors]);
    }

    public function addTaskSameProject($category_id)
    {
        $category = DB::table('category')->where('id', $category_id)->first();
        $project = DB::table('project')->where('id', $category->project_id)->first();

        $project_name = $project->name;
        $categories = DB::table('category')->where('project_id', $project->id)->get();

        $contributors = DB::table('user')
            ->join('user_project', 'user.id', '=', 'user_project.user_id')
            ->select('user.id', 'user.name')
            ->where('user_project.project_id', $project->id)
            ->get();

        return view('addTask', ['categories' => $categories, 'project' => $project_name, 'contributors' => $contributors]);
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

        return redirect('tasks');
    }

    // GET
    public function showAllTasks() {
        $allTasks = DB::table('task')->get();
        $allCategories = DB::table('category')->get();
        $allProjects = DB::table('project')->get();
        return view('tasks', ['tasks' => $allTasks, 'categories' => $allCategories, 'projects' => $allProjects]);
    }

    public function showAllProjects() {
        $allProjects = DB::table('project')->get();
        return view('tasks', ['tasks' => [], 'categories' => [], 'projects' => $allProjects]);
    }

    public function showCategoriesFromProject($n){
        $allProjects = DB::table('project')->get();
        $allCategories = DB::table('category')->where('project_id', $n)->get();
        return view('tasks', ['tasks' => [], 'categories' => $allCategories, 'projects' => $allProjects]);
    }

    // GET
    // TODO: rajouter project_id à TASK pour les non classés
    public function showTaskFromCategory($n) {
        $allProjects = DB::table('project')->get();
        $category = DB::table('category')->where('id', $n)->first();

        $currentProject_id = DB::table('project')->where('id', $category->project_id)->pluck('id');
        $categories = DB::table('category')->where('project_id', $currentProject_id)->get();

        $contributors_name = DB::table('user')
            ->join('user_task', 'user.id', '=', 'user_task.user_id')
            ->join('task', 'task.id', '=', 'user_task.task_id')
            ->select('task.id', 'user.name')
            ->get();


        if ($n == 0) {
            $task_category = DB::table('task')->whereNull('category_id')->get();
        }
        else {
            $task_category = DB::table('task')->where('category_id', $n)->get();
        }
        return view('tasks', ['tasks' => $task_category, 'categories' => $categories, 'projects' => $allProjects,
                    'contributors' => $contributors_name]);
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
        $contributors_project = DB::table('user')
            ->join('user_project', 'user.id', '=', 'user_project.user_id')
            ->select('user.id', 'user.name')
            ->where('user_project.project_id', $project->id)
            ->get();

        return view('editTask', ['task' => $task,
            'categories_project' => $categories_project,
          'contributors_task' => $contributors_task, 'contributors_project' => $contributors_project]);
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
    public function deleteTask($task_id) {
        DB::table('task')->where('id', $task_id)
            ->delete();
        return redirect('tasks');
    }

    public function assignTaskForm(){

    }
}
