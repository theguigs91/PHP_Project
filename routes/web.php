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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

// Home
Route::get('/', function () {
    return view('welcome');
});
Route::get('/welcome2', 'WelcomeController@index');

Route::get('list', function() {
    return ["un", "deux", "trois"];
});

Route::get('/infos', function() {
    return view('infos');
});

// Login
Route::get('/login', 'UsersController@showForm')->name('login_form');
Route::post('/login', 'UsersController@login')->name('login_check');

// Contact
Route::get('contact/create', 'ContactController@create');
Route::post('contact', 'ContactController@store');

// Image
Route::get('images', 'PhotoController@create')->name('photo_create');
Route::post('images', 'PhotoController@store');

// User
Route::get('/user/list', 'UsersController@userList');

//Task
Route::get('tasks', 'TaskController@showAllProjects')->name('tasks');
Route::get('tasks/project/{p}', 'TaskController@showCategoriesFromProject')->name('categoriesProject');
Route::get('tasks/category/{c}', 'TaskController@showTaskFromCategory')->name('tasksCategory');
Route::get('/tasks/add/project/{p}', 'TaskController@addTaskForm')->name('addTask');
Route::get('/tasks/add/category/{c}', 'TaskController@addTaskSameProject')->name('addTaskSameProject');
Route::get('/tasks/edit/{t}', 'TaskController@editTaskForm')->name('editTask');
Route::post('/tasks/edit/{t}', 'TaskController@editTask');
Route::post('/tasks/add', 'TaskController@addTask');
Route::post('/tasks/finished/{task}/{category}', 'TaskController@finishTask')->name('finishTask');
Route::delete('/tasks/delete/{t}', 'TaskController@deleteTask')->name('deleteTask');

// Category
Route::get('/category/add/project/{p}', 'CategoryController@addCategoryForm')->name('addCategory');
Route::get('/category/add/category/{c}', 'CategoryController@addCategorySameProject')->name('addCategorySameProject');
Route::post('/category/add', 'CategoryController@addCategory');
Route::delete('/category/delete/{c}', 'CategoryController@deleteCategory')->name('deleteCategory');


// Project
Route::get('/projects/add', 'ProjectController@addProjectForm')->name('addProject');
Route::post('/projects/add', 'ProjectController@addProject');