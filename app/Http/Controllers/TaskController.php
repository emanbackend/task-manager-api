<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Task;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    public function index()
    {
        $tasks = Auth::user()->tasks;
        return response()->json($tasks, 200);
    }

    public function store(StoreTaskRequest $request)
    {
        $user_id = Auth::user()->id;
        $validatedData = $request->validated();
        $validatedData['user_id'] = $user_id;
        $task = Task::create($validatedData);
        return response()->json($task, 201);
    }

    public function update(UpdateTaskRequest $request, $id)
    {
        $user_id = Auth::user()->id;
        $task = Task::FindOrFail($id);
        if ($task->user_id != $user_id)
            return response()->json(['message' => 'unauthorized'], 403);
        $task->update($request->validated());
        return response()->json($task, 200);
    }

    public function show($id)
    {
        $task = Task::Find($id);
        return response()->json($task, 200);
    }

    public function destroy($id)
    {
        try {
            $task = Task::FindOrFail($id);
            $task->delete();
            return response()->json($task, 204);
        } catch (ModelNotFoundException $m) {
            return response()->json(
                [
                    'error' => 'Task Not Found',
                    'details' => $m->getMessage(),
                ],
                404
            );
        } catch (Exception $m) {
            return response()->json(
                [
                    'error' => 'something went wrong while deleting the task',
                    'details' => $m->getMessage(),
                ],
                404
            );
        }
    }

    public function addToFavorites($taskId)
    {
        Task::findOrFail($taskId);
        Auth::user()->favoriteTasks()->syncWithoutDetaching($taskId);
        return response()->json(['message' => 'Task Added To Favorites'], 201);
    }
    public function removeFromFavorite($taskId)
    {
        Task::findOrFail($taskId);
        Auth::user()->favoriteTasks()->detach($taskId);
        return response()->json(['message' => 'Task Removed From Favorites'], 201);
    }
    public function getFavoriteTasks()
    {
        $favoriteTasks = Auth::user()->favoriteTasks()->get();
        return response()->json($favoriteTasks, 200);
    }


    public function getTaskByPriority()
    {
        $tasks = Auth::user()->tasks()->orderByRaw("FIELD(priority,'high','medium','low')")->get();
        return response()->json($tasks, 200);
    }


    public function getAllTasks()
    {
        $tasks = Task::all();
        return response()->json($tasks, 200);
    }


    public function getUserTasks($id)
    {
        $user = Task::findOrFail($id)->user;
        return response()->json($user, 200);
    }

    public function addCategoriesToTask(Request $request, $taskId)
    {
        $task = Task::findOrFail($taskId);
        $task->categories()->attach($request->category_id);
        return response()->json(['category added sucessfully'], 200);
    }

    public function getTaskCategories($taskId)
    {
        $categoryies = Task::findOrFail($taskId)->categories;
        return response()->json($categoryies, 200);
    }

    public function getCategoryTasks($categoryId)
    {
        $tasks = Category::findOrFail($categoryId)->tasks;
        return response()->json($tasks, 200);
    }
}
