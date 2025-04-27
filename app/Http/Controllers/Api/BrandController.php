<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Brand;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $country = $request->country ?? 'DEFAULT';

        $brands = Brand::where(function ($query) use ($country) {
            $query->where('country_codes', 'like', "%$country%")
                ->orWhereNull('country_codes')
                ->orWhere('country_codes', '');
        })->get();

        return response()->json($brands);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'brand_name' => 'required|string|max:255',
            'brand_image' => 'required|url',
            'rating' => 'required|integer|min:0|max:5',
        ]);

        $brand = Brand::create($request->all());

        return response()->json($brand, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $brand = Brand::findOrFail($id);
        return response()->json($brand);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $brand = Brand::findOrFail($id);

        $request->validate([
            'brand_name' => 'sometimes|required|string|max:255',
            'brand_image' => 'sometimes|required|url',
            'rating' => 'sometimes|required|integer|min:0|max:5',
        ]);

        $brand->update($request->all());

        return response()->json($brand);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $brand = Brand::findOrFail($id);
        $brand->delete();

        return response()->json(['message' => 'Deleted brand']);
    }
}
