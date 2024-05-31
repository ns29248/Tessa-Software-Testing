<?php

namespace App\Services;

use App\Models\RequestStylist;
use App\Models\StylistProfile;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\RequestDenied;

class RequestStylistService
{
    public function getAllRequests()
    {
        return RequestStylist::with('user')->get();
    }

    public function createRequest($user, $data)
    {
        $request = $user->request()->create($data);
        $user->update(['request_submitted' => true]);
        return $request;
    }

    public function approveRequest(RequestStylist $request)
    {
        $user = $request->user;
        $cartService = new CartService();

        if ($user && $user->role === 0) {
            DB::beginTransaction();
            try {


                StylistProfile::create([
                    'user_id' => $user->id,
                    'saloon_name' => $request->saloon_name,
                    'saloon_city' => $request->saloon_city,
                    'saloon_address' => $request->saloon_address,
                    'saloon_phone' => $request->saloon_phone,
                ]);

                $request->delete();
                $request->user()->update(['role' => 2]);
                $cartService->deleteCart($user);
                DB::commit();
                return true;
            } catch (\Exception $e) {
                DB::rollBack();
                throw $e;
            }
        }

        throw new \Exception("Invalid user status or role.");
    }

    public function denyRequest(RequestStylist $request)
    {
        $user = $request->user;

        if ($user && $user->role === 0) {
            $request->delete();
            Mail::to($user->email)->send(new RequestDenied($user));
            return true;
        }

        throw new \Exception("Invalid user status or role.");
    }
}

