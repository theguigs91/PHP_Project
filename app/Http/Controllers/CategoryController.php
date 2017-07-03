<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    // GET
    public function addCategoryForm($project_id){
        $project = DB::table('project')->where('id', $project_id)->first();

        return view('addCategory', ['project' => $project]);
    }

    public function addCategorySameProject($category_id) {
        $category = DB::table('category')->where('id', $category_id)->first();
        $project = DB::table('project')->where('id', $category->project_id)->first();

        return view('addCategory', ['project' => $project]);
    }

    //POST
    public function addCategory(Request $request) {
        $name = $request->input('name');
        $project = $request->input('project');

        DB::table('category')->insert(['name' => $name, 'project_id' => $project]);
        return redirect('tasks');
    }

    // DELETE
    public function deleteCategory($category_id) {
        DB::table('category')->where('id', $category_id)
            ->delete();
        return redirect('tasks');
    }
}
