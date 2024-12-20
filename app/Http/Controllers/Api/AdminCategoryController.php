<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Category\StoreCategoryRequest;
use App\Http\Requests\Category\UpdateCategoryRequest;
use App\Models\Category;
use App\Http\Responses\ApiResponses;


class AdminCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $categories =
                Category::query()
                ->with('tasks')
                ->orderBy('name', 'ASC')
                ->get();
            return ApiResponses::Success('Admin Categories Index', $categories);
        } catch (\Throwable $th) {
            throw $th;
        }
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCategoryRequest $request)
    {
        try {
            $data = $request->validated();

            $newRecord = Category::create($data);

            return ApiResponses::Success('Admin Category Created', $newRecord);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        try {
            $category->load('tasks');
            return ApiResponses::Success('Admin Category Details', $category);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategoryRequest $request, Category $category)
    {
        try {
            $data = $request->validated();
            $category->update($data);
            $category->load('tasks');
            return ApiResponses::Success('Admin Category Updated', $category);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        try {
            $category->tasks()->delete();
            $category->delete();
            return ApiResponses::Success('Admin Category Deleted', []);
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
