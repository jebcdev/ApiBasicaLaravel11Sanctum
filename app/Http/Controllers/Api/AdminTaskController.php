<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Task\StoreTaskRequest;
use App\Http\Requests\Task\UpdateTaskRequest;
use App\Models\Task;
use App\Http\Responses\ApiResponses;


class AdminTaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $tasks =
                Task::query()
                ->with([
                    'user',
                    'category',
                    'status'
                ])
                ->orderBy('created_at', 'DESC')
                ->get();

            return ApiResponses::Success(
                'Admin Tasks Index',
                [
                    'tasks_count' => $tasks->count(),
                    'tasks' => $tasks,
                ]
            );
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
            $task->load([
                'user',
                'category',
                'status'
            ]);
            return ApiResponses::Success('Admin Task Details', $task);
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
            return ApiResponses::Success('Admin Task Deleted', [null], 200);
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
