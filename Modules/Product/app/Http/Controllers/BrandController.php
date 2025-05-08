<?php

namespace Modules\Product\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Product\Models\Brand;
use Modules\Product\Transformers\BrandResource;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $brands = Brand::all(); // Fetch all brands
        return BrandResource::collection($brands); // Return as a resource collection        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:brands',
            'website' => 'nullable|url|max:255',
            'status' => 'required|boolean'
        ]);

        $brand = Brand::create($validated);

        return new BrandResource($brand);
    }

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        $brand = Brand::findOrFail($id); // Find the brand or fail
        return new BrandResource($brand); // Return the resource
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:brands,name,' . $id,
            'website' => 'nullable|url|max:255',
            'status' => 'required|boolean'
        ]);

        $brand = Brand::findOrFail($id); // Find the brand or fail
        $brand->update($validated); // Update the brand

        return new BrandResource($brand); // Return the updated resource
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $brand = Brand::findOrFail($id); // Find the brand or fail
        $brand->delete(); // Delete the brand

        return response()->json(['message' => 'Brand deleted successfully.'], 200); // Return success message
    }
}
