<?php

namespace Tests\Feature;

use Illuminate\Support\Facades\DB;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class TaskTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testTasksPage()
    {
        $response = $this->get('/tasks')->assertSee('Projets');
        $response->assertStatus(200);
    }

    // Test if all projects are displayed in /tasks
    public function testAllProjects() {
        $allProjects = DB::table('project')->get();
        $response = $this->get('/tasks');

        foreach($allProjects as $project) {
            $response->assertSee($project->name);
        }
    }

    public function testAllCategories() {
        $allProjects = DB::table('project')->get();

        foreach ($allProjects as $project) {
            $response = $this->get('/tasks/project/' .$project->id);
            $categories = DB::table('category')->where('project_id', $project->id)->get();

            foreach($categories as $category) {
                $response->assertSee($category->name);
            }
        }
    }

    public function testAllTasks(){
        $allProjects = DB::table('project')->get();

        foreach ($allProjects as $project) {
            $categories = DB::table('category')->where('project_id', $project->id)->get();

            foreach($categories as $category) {
                $tasks = DB::table('task')->where('category_id', $category->id)->get();
                $response = $this->get('/tasks/category/'.$category->id);
                foreach($tasks as $task) {
                    $response->assertSee($task->description);
                }
            }
        }
    }
}
