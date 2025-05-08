<?php

namespace Modules\Medicine\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Traits\ApiResponseTrait;
use Exception;
use Illuminate\Http\Request;
use Modules\Medicine\Models\Category;
use Modules\Medicine\Transformers\CategoryCollection;
use Modules\Medicine\Transformers\CategoryResource;

class CategoryController extends Controller
{
    use ApiResponseTrait;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $categories = Category::with('children')->tree()->get();

            return new CategoryCollection($categories);
        } catch (Exception $e) {
            return $this->handleException($e, 'Failed to fetch categories');
        }
    }

    /**
     * Display the specified resource.
     * Get a single category with descendants
     * @param  int  $id
     */

    public function show($id)
    {
        $category = Category::with('descendants')->findOrFail($id);

        return new CategoryResource($category);
    }

    // Get only root categories
    public function roots()
    {
        $categories = Category::whereNull('parent_id')->get();

        return new CategoryCollection($categories);
    }

    // Get category with children
    public function withChildren($id)
    {
        $category = Category::with('children')->findOrFail($id);

        return new CategoryResource($category);
    }

    // Get category with all descendants
    public function withDescendants($id)
    {
        $category = Category::with('descendants')->findOrFail($id);

        return new CategoryResource($category);
    }


    /**
     * Get parent categories only.
     */

    public function parent_categories()
    {
        try {
            $categories = Category::whereNull('parent_id')
                ->withCount('descendants')->get();

            return new CategoryCollection($categories);
        } catch (Exception $e) {
            return $this->handleException($e, 'Failed to fetch parent categories');
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //

        return response()->json([]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //

        return response()->json([]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //

        return response()->json([]);
    }
}
