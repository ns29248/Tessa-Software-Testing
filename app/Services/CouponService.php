<?php

namespace App\Services;

use App\Models\Coupon;
use Illuminate\Support\Facades\DB;
use Exception;

class CouponService
{
    public function getAllCoupons()
    {
        return Coupon::all();
    }

    public function createCoupon($data)
    {
        DB::beginTransaction();

        try {
            $coupon = Coupon::create($data);
            DB::commit();
            return $coupon;
        } catch (Exception $e) {
            DB::rollBack();
            throw new Exception('Failed to create coupon. Error: ' . $e->getMessage());
        }
    }

    public function updateCoupon(Coupon $coupon, $data)
    {
        DB::beginTransaction();

        try {
            $coupon->update($data);
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            throw new Exception('Failed to update coupon. Error: ' . $e->getMessage());
        }
    }

    public function getCoupon(Coupon $coupon)
    {
        return $coupon;
    }
}
