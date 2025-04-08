<?php

namespace Modules\Medicine\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Medicine\Http\Requests\AtcCodeRequest;
use Modules\Medicine\Models\AtcCode;
use Modules\Medicine\Transformers\AtcCodeResource;

class AtcCodeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $atcCodes = AtcCode::all(); // Fetch all ATC codes
        return AtcCodeResource::collection($atcCodes); // Return as a resource collection
    }

    public function store(AtcCodeRequest $request)
    {
        $atcCode = AtcCode::create($request->validated()); // Create a new ATC code
        return new AtcCodeResource($atcCode); // Return the created resource
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $atcCode = AtcCode::findOrFail($id); // Find the ATC code or fail
        return new AtcCodeResource($atcCode); // Return the resource
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AtcCodeRequest $request, $id)
    {
        $atcCode = AtcCode::findOrFail($id); // Find the ATC code or fail
        $atcCode->update($request->validated()); // Update the ATC code
        return new AtcCodeResource($atcCode); // Return the updated resource
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $atcCode = AtcCode::findOrFail($id); // Find the ATC code or fail
        $atcCode->delete(); // Delete the ATC code
        return response()->json(['message' => 'ATC Code deleted successfully.'], 200); // Return success message
    }
}
