<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Task\StoreTaskRequest;
use App\Http\Requests\Task\UpdateTaskRequest;
use App\Http\Responses\ApiResponses;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    private static $CURRENT_USER;

    public function __construct(Request $request)
    {
        try {
            if (!$request->user()) {
                return ApiResponses::Error('Unauthorized');
            }
            self::$CURRENT_USER = $request->user();
        } catch (\Throwable $th) {
            throw $th;
        }
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $tasks = self::$CURRENT_USER->tasks;
            $tasks= $tasks
            ->load([
                'user',
                'category',
                'status'
            ]);
            return ApiResponses::Success('Tasks', $tasks);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTaskRequest $request)
    {
        try {
            $data = $request->validated();
            $data['user_id'] = self::$CURRENT_USER->id;
            $newRecord = Task::create($data);
            $newRecord->load([
                'user',
                'category',
                'status'
            ]);
            return ApiResponses::Success('Admin Task Created', $newRecord);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Task $task)
    {
        try {
            $task
            ->load([
                'user',
                'category',
                'status'
            ]);
            return ApiResponses::Success('Tasks Details', $task);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTaskRequest $request, Task $task)
    {
        try {
            $data = $request->validated();
            $data['user_id'] = self::$CURRENT_USER->id;
            $task->update($data);
            $task->load([
                'user',
                'category',
                'status'
            ]);
            return ApiResponses::Success('Admin Task Updated', $task);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        try {
            $task->delete();
            return ApiResponses::Success('Admin Task Deleted');
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
