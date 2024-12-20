<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\StoreUserRequest;
use App\Http\Requests\User\UpdateUserRequest;
use App\Http\Responses\ApiResponses;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminUserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $users = User::query()->with(['tasks'])->orderBy('name', 'ASC')->get();
            return ApiResponses::Success('Admin Users Index', $users);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request)
    {
        try {

            $data = $request->validated();
            $data['password'] = Hash::make($data['password']);
            $newRecord = User::create($data);

            return ApiResponses::Success('Admin User Created', $newRecord);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        try {
            $user->load('tasks');
            return ApiResponses::Success('Admin User Show', $user);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        try {

            $data = $request->validated();
            $data['password'] = Hash::make($data['password']);
            $user->update($data);
            $user->load('tasks');
            return ApiResponses::Success('Admin User Created', $user);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        try {
            $user->forceDelete();
            $user->tokens()->delete();
            $user->forceDelete();

            return ApiResponses::Success('Admin User Deleted');
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
