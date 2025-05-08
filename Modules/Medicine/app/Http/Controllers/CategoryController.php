<?php

namespace Modules\Medicine\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Modules\Medicine\Models\Category;
use Modules\Medicine\Transformers\CategoryResource;
use Modules\Medicine\Transformers\CategoryCollection;
use Exception;

class CategoryController extends Controller
{
    use ApiResponseTrait;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $categories = Category::all();
            return new CategoryCollection($categories);
        } catch (Exception $e) {
            return $this->handleException($e, 'Failed to fetch categories');
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'name' => 'required|string|max:255|unique:categories',
                'parent_id' => 'nullable|exists:categories,id',
                'description' => 'nullable|string|max:1000',
                'status' => 'required|boolean'
            ]);

            $validated['slug'] = Str::slug($validated['name']);

            $category = Category::create($validated);

            return new CategoryResource($category);
        } catch (Exception $e) {
            return $this->handleException($e, 'Failed to create category');
        }
    }

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        try {
            $category = Category::findOrFail($id);
            return new CategoryResource($category);
        } catch (Exception $e) {
            return $this->handleException($e, 'Failed to fetch category');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try {
            $category = Category::findOrFail($id);

            $validated = $request->validate([
                'name' => 'sometimes|required|string|max:255|unique:categories,name,' . $id,
                'parent_id' => 'nullable|exists:categories,id',
                'description' => 'nullable|string|max:1000',
                'status' => 'sometimes|required|boolean'
            ]);

            if (isset($validated['name'])) {
                $validated['slug'] = Str::slug($validated['name']);
            }

            $category->update($validated);

            return new CategoryResource($category);
        } catch (Exception $e) {
            return $this->handleException($e, 'Failed to update category');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $category = Category::findOrFail($id);
            $category->delete();

            return $this->successResponse(null, 'Category deleted successfully');
        } catch (Exception $e) {
            return $this->handleException($e, 'Failed to delete category');
        }
    }
}
