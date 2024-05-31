<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CouponRequest;
use App\Models\Coupon;
use App\Services\CouponService;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    protected $couponService;

    public function __construct(CouponService $couponService)
    {
        $this->couponService = $couponService;
    }

    public function index()
    {
        $coupons = $this->couponService->getAllCoupons();
        return view('admin.coupon', compact('coupons'));
    }

    public function store(CouponRequest $request)
    {
        try {
            $this->couponService->createCoupon($request->validated());
            return redirect()->back()->with('message', 'Coupon created successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error creating coupon: ' . $e->getMessage());
        }
    }

    public function show(Coupon $coupon)
    {
        $coupon = $this->couponService->getCoupon($coupon);
        return view('admin.show-coupon', compact('coupon'));
    }

    public function edit(Coupon $coupon)
    {
        $coupon = $this->couponService->getCoupon($coupon);
        return view('admin.edit-coupon', compact('coupon'));
    }

    public function update(CouponRequest $request, Coupon $coupon)
    {
        try {
            $this->couponService->updateCoupon($coupon, $request->validated());
            return redirect()->back()->with('message', 'Coupon updated successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error updating coupon: ' . $e->getMessage());
        }
    }
}


//    public function applyCoupon(Request $request)
//    {
//        $user = Auth::user();
//        $couponCode = $request->input('coupon_code');
//        $orderId = $request->input('order_id');
//
//        $coupon = ApplyCoupon::where('code', $couponCode)
//            ->where('expiration_date', '>=', now()->toDateString())
//            ->first();
//
//        if (!$coupon) {
//            return response()->json(['message' => 'This coupon is invalid or expired.'], 404);
//        }
//
//        if ($user->coupons->contains($coupon->id)) {
//            return response()->json(['message' => 'This coupon has already been used by you.'], 400);
//        }
//
//        $order = PlaceOrder::where('id', $orderId)->where('user_id', $user->id)->first();
//
//        if (!$order) {
//            return response()->json(['message' => 'PlaceOrder not found.'], 404);
//        }
//
//        // Assuming you have logic to calculate the discount based on the coupon type and value
//        // Update the order with the coupon's discount
//        $order->coupon_id = $coupon->id;
//        $order->save();
//
//        // Record the usage of the coupon for the user
//        $user->coupons()->attach($coupon->id, ['used_at' => now()]);
//
//        return response()->json(['message' => 'ApplyCoupon applied successfully.']);
//    }


