<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Status\StoreStatusRequest;
use App\Http\Requests\Status\UpdateStatusRequest;
use App\Models\Status;
use App\Http\Responses\ApiResponses;

class AdminStatusController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $statuses = Status::query()->with('tasks')->orderBy('name', 'ASC')->get();
            return ApiResponses::Success('Admin Statuses Index', $statuses);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreStatusRequest $request)
    {
        try {
            try {
                $data = $request->validated();
    
                $newRecord = Status::create($data);
    
                return ApiResponses::Success('Admin Status Created', $newRecord);
            } catch (\Throwable $th) {
                throw $th;
            }
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Status $status)
    {
        try {
            try {
                $status->load('tasks');
                return ApiResponses::Success('Admin Status Details', $status);
            } catch (\Throwable $th) {
                throw $th;
            }
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateStatusRequest $request, Status $status)
    {
        try {
            $data = $request->validated();
            $status->update($data);
            $status->load('tasks');
            return ApiResponses::Success('Admin Status Updated', $status);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Status $status)
    {
        try {
            $status->tasks()->delete();
            $status->delete();
            return ApiResponses::Success('Admin Status Deleted', []);
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
