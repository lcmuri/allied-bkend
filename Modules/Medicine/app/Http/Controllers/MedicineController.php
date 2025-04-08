<?php

namespace Modules\Medicine\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Modules\Medicine\Models\Medicine;
use Modules\Medicine\Transformers\MedicineResource;
use Modules\Medicine\Transformers\MedicineCollection;
use Exception;

class MedicineController extends Controller
{
    use ApiResponseTrait;

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        try {
            $query = Medicine::query();

            // Apply filters
            if ($request->has('category')) {
                $query->whereHas('categories', function ($q) use ($request) {
                    $q->where('id', $request->category);
                });
            }

            if ($request->has('search')) {
                $search = $request->search;
                $query->where(function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%")
                        ->orWhere('generic_name', 'like', "%{$search}%")
                        ->orWhere('brand_name', 'like', "%{$search}%");
                });
            }

            // Apply sorting
            $sortField = $request->get('sort_by', 'created_at');
            $sortDirection = $request->get('sort_direction', 'desc');
            $query->orderBy($sortField, $sortDirection);

            $medicines = $query->with(['categories', 'doseForms'])->paginate(15);
            return new MedicineCollection($medicines);
        } catch (Exception $e) {
            return $this->handleException($e, 'Failed to fetch medicines');
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'name' => 'required|string|max:255|unique:medicines',
                'generic_name' => 'required|string|max:255',
                'brand_name' => 'required|string|max:255',
                'manufacturer' => 'required|string|max:255',
                'description' => 'nullable|string',
                'price' => 'required|numeric|min:0',
                'status' => 'required|boolean',
                'categories' => 'required|array',
                'categories.*' => 'exists:categories,id',
                'dose_forms' => 'required|array',
                'dose_forms.*' => 'exists:dose_forms,id'
            ]);

            $validated['slug'] = Str::slug($validated['name']);

            $medicine = Medicine::create($validated);

            // Sync relationships
            if (isset($validated['categories'])) {
                $medicine->categories()->sync($validated['categories']);
            }

            if (isset($validated['dose_forms'])) {
                $medicine->doseForms()->sync($validated['dose_forms']);
            }

            return new MedicineResource($medicine->load(['categories', 'doseForms']));
        } catch (Exception $e) {
            return $this->handleException($e, 'Failed to create medicine');
        }
    }

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        try {
            $medicine = Medicine::with(['categories', 'doseForms'])->findOrFail($id);
            return new MedicineResource($medicine);
        } catch (Exception $e) {
            return $this->handleException($e, 'Failed to fetch medicine');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try {
            $medicine = Medicine::findOrFail($id);

            $validated = $request->validate([
                'name' => 'sometimes|required|string|max:255|unique:medicines,name,' . $id,
                'generic_name' => 'sometimes|required|string|max:255',
                'brand_name' => 'sometimes|required|string|max:255',
                'manufacturer' => 'sometimes|required|string|max:255',
                'description' => 'nullable|string',
                'price' => 'sometimes|required|numeric|min:0',
                'status' => 'sometimes|required|boolean',
                'categories' => 'sometimes|required|array',
                'categories.*' => 'exists:categories,id',
                'dose_forms' => 'sometimes|required|array',
                'dose_forms.*' => 'exists:dose_forms,id'
            ]);

            if (isset($validated['name'])) {
                $validated['slug'] = Str::slug($validated['name']);
            }

            $medicine->update($validated);

            // Sync relationships if provided
            if (isset($validated['categories'])) {
                $medicine->categories()->sync($validated['categories']);
            }

            if (isset($validated['dose_forms'])) {
                $medicine->doseForms()->sync($validated['dose_forms']);
            }

            return new MedicineResource($medicine->load(['categories', 'doseForms']));
        } catch (Exception $e) {
            return $this->handleException($e, 'Failed to update medicine');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $medicine = Medicine::findOrFail($id);

            // Remove relationships
            $medicine->categories()->detach();
            $medicine->doseForms()->detach();

            $medicine->delete();

            return $this->successResponse(null, 'Medicine deleted successfully');
        } catch (Exception $e) {
            return $this->handleException($e, 'Failed to delete medicine');
        }
    }
}
