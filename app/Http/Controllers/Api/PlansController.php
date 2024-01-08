<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\PlanRequest;
use App\Models\Plans;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PlansController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Plans::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PlanRequest $request)
    {
        $plan = new Plans([
            'plan_name' => $request->plan_name,
            'plan_type' => $request->plan_type,
            'plan_price' => $request->plan_price,
        ]);

        if ($request->hasFile('plan_image')) {
            // Set the plan_image attribute before saving
            $plan->plan_image = $request->file('plan_image')->storePublicly('images', 'public');
        } else {
            // If no image is provided, set a default or null value for the plan_image
            $plan->plan_image = null; // You can set this to a default image URL or handle it as per your requirements
        }

        if ($plan->save()) {
            return response()->json($plan, 201);
        } else {
            return response()->json(['error' => 'Failed to save plan'], 500);
        }
    }

    private function saveImage(Plans $plan, Request $request)
    {
        if (!is_null($plan->plan_image)) {
            Storage::disk('public')->delete($plan->plan_image);

            $plan->plan_image = $request->file('plan_image')->storePublicly('images', 'public');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return Plans::findOrFail($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PlanRequest $request, string $id)
    {
        $plan = Plans::findOrFail($id);
        $plan->fill($request->validated());
        $plan->save();

        return response()->json($plan, 200);
    }

    public function updateImage(Request $request, string $id)
    {
        $this->validate($request, [
            'plan_image' => 'image|mimes:jpeg,png,jpg,gif,svg',
        ]);

        $plan = Plans::findOrFail($id);

        if (!$plan) {
            return response()->json(['message' => 'Plan not found'], 404);
        }

        // Delete the existing image
        if (!is_null($plan->plan_image)) {
            Storage::disk('public')->delete($plan->plan_image);
        }

        // Save the new image
        if ($request->hasFile('plan_image')) {
            $this->saveImage($plan, $request);
        }

        return response()->json($plan, 200);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $plan = Plans::findOrFail($id);

        if (!is_null($plan->plan_image)) {
            Storage::disk('public')->delete($plan->plan_image);
        }

        $plan->delete();

        return response()->json(['message' => 'Deleted successfully'], 200);
    }
}
