<?php

namespace App\Http\Controllers;

use App\Models\Coupon;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    /**
     * Display a listing of the resource (READ: All).
     */
    public function index()
    {
        $coupons = Coupon::all();
        return response()->json($coupons);
    }

    /**
     * Store a newly created resource in storage (CREATE).
     */
    public function store(Request $request)
    {
        $request->validate([
            'code' => 'required|string|unique:coupons,code|max:255',
            'type' => 'required|in:fixed,percentage',
            'value' => 'required|numeric|min:0',
            'expires_at' => 'nullable|date',
            'max_uses' => 'nullable|integer|min:1',
            'is_active' => 'boolean',
        ]);

        $coupon = Coupon::create($request->all());
        return response()->json($coupon, 201);
    }

    /**
     * Display the specified resource (READ: Single).
     */
    public function show(int $id)
    {
        $coupon = Coupon::where('id', $id)->firstOrFail();
        return response()->json($coupon);
    }

    /**
     * Update the specified resource in storage (UPDATE).
     */
    public function update(int $id, Request $request)
    {
        $coupon = Coupon::where('id', $id)->firstOrFail();

        $request->validate([
            'code' => 'sometimes|required|string|unique:coupons,code,' . $id . '|max:255',
            'type' => 'sometimes|required|in:fixed,percentage',
            'value' => 'sometimes|required|numeric|min:0',
            'expires_at' => 'nullable|date',
            'max_uses' => 'nullable|integer|min:1',
            'is_active' => 'boolean',
        ]);

        $coupon->update($request->all());

        return response()->json($coupon);
    }

    /**
     * Remove the specified resource from storage (DELETE).
     */
    public function destroy(int $id)
    {
        Coupon::where('id', $id)->firstOrFail()->delete();

        return response()->noContent();
    }
}