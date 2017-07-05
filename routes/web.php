<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', 'HomeController@index')->name('home');

//Task
//Route::get('tasks', 'TaskController@showAllProjects')->name('tasks');
Route::get('tasks/project/{p}', 'TaskController@showCategoriesFromProject')->name('categoriesProject');
Route::get('tasks/category/{c}', 'TaskController@showTaskFromCategory')->name('tasksCategory');
Route::get('/tasks/add/project/{p}', 'TaskController@addTaskForm')->name('addTask');
Route::get('/tasks/add/category/{c}', 'TaskController@addTaskSameProject')->name('addTaskSameProject');
Route::get('/tasks/edit/{t}', 'TaskController@editTaskForm')->name('editTask');
Route::post('/tasks/edit/{t}', 'TaskController@editTask');
Route::post('/tasks/add', 'TaskController@addTask');
Route::post('/tasks/finished/{task}/{category}', 'TaskController@finishTask')->name('finishTask');
Route::delete('/tasks/delete/{t}/{c}', 'TaskController@deleteTask')->name('deleteTask');

// Category
Route::get('/category/add/project/{p}', 'CategoryController@addCategoryForm')->name('addCategory');
Route::get('/category/add/category/{c}', 'CategoryController@addCategorySameProject')->name('addCategorySameProject');
Route::post('/category/add', 'CategoryController@addCategory');
Route::delete('/category/delete/{c}', 'CategoryController@deleteCategory')->name('deleteCategory');


// Project
Route::get('projects', 'ProjectController@showAllProjects')->name('projects');
Route::get('/projects/add', 'ProjectController@addProjectForm')->name('addProject');
Route::post('/projects/add', 'ProjectController@addProject');
Route::get('/projects/addUser/{p}', 'ProjectController@addUserForProjectForm')->name('addUserForProject');
Route::post('/projects/addUser/{p}', 'ProjectController@addUserForProject');



Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();
