<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


// Route::post('tasks',[TaskController::class,'store']);
// Route::get('tasks',[TaskController::class,'index']);
// Route::put('tasks/{id}',[TaskController::class,'update']);
// Route::get('tasks/{id}',[TaskController::class,'show']);
// Route::delete('tasks/{id}',[TaskController::class,'destroy']);


Route::post('register',[UserController::class,'register']);
Route::post('login',[UserController::class,'login']);
Route::post('logout',[UserController::class,'logout'])->middleware('auth:sanctum');


Route::middleware('auth:sanctum')->group(function()
{
Route::prefix('profile')->group(function()
{
Route::post('',[ProfileController::class,'store']);
Route::get('/{id}',[ProfileController::class,'show']);
Route::put('/{id}',[ProfileController::class,'update']);
});  
Route::apiResource('tasks',TaskController::class);

Route::get('task/all',[TaskController::class,'getAllTasks'])->middleware('CheckUser');
Route::get('task/ordered',[TaskController::class,'getTaskByPriority']);

Route::post('task/{id}/favorite',[TaskController::class,'addToFavorites']);
Route::delete('task/{id}/favorite',[TaskController::class,'removeFromFavorite']);
Route::get('task/favorites',[TaskController::class,'getFavoriteTasks']);
Route::get('tasks/userpriority',[TaskController::class,'getTaskPriorityByUser']);


Route::get('getUser',[UserController::class,'GetUser']);
Route::get('user/{id}/profile',[UserController::class,'getprofile']);
Route::get('user/{id}/tasks',[UserController::class,'getUserTasks']);
Route::get('task/{id}/user',[TaskController::class,'getUserTask']);
Route::post('tasks/{taskId}/categories',[TaskController::class,'addCategoriesToTask']);
Route::get('tasks/{id}/categories',[TaskController::class,'getTaskCategories']);
Route::get('categories/{categoryId}/tasks',[TaskController::class,'getCategoryTasks']);

});




