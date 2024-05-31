<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\RequestStylistRequest;
use App\Models\RequestStylist;
use App\Services\RequestStylistService;
use Illuminate\Http\Request;

class RequestStylistController extends Controller
{
    protected $requestStylistService;

    public function __construct(RequestStylistService $requestStylistService)
    {
        $this->requestStylistService = $requestStylistService;
    }

    public function index()
    {
        $requests = $this->requestStylistService->getAllRequests();
        return view('admin.stylist-request', compact('requests'));
    }

    public function store(RequestStylistRequest $request)
    {
        $validatedData = $request->validated();
        $this->requestStylistService->createRequest(auth()->user(), $validatedData);
        return redirect()->route('show_products')->with('message', 'Request Made Successfully');
    }

    public function show(RequestStylist $request)
    {
        return view('admin.show-stylist-request', compact('request'));
    }

    public function update(RequestStylist $request)
    {
        try {
            $this->requestStylistService->approveRequest($request);
            return redirect()->back()->with('success', 'Request approved successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Unable to approve request: ' . $e->getMessage());
        }
    }

    public function destroy(RequestStylist $request)
    {
        try {
            $this->requestStylistService->denyRequest($request);
            return redirect()->back()->with('success', 'Request denied successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Unable to deny request: ' . $e->getMessage());
        }
    }
}


//    public function update(Request_Stylist $request)
//    {
//        // Assuming there's a user associated with the request
//        $user = $request->user;
//
//        // Check if the user exists and has the role 0
//        if ($user && $user->role === 0) {
//            DB::beginTransaction();
//
//            try {
//                // First, change the user's role to 2
//
//
//                // Then, move data to stylist_profiles table
//                $stylistProfile = Stylist_Profile::make([
//                    'user_id' => $user->id,
//                    'saloon_name' => $request->saloon_name,
//                    'saloon_city' => $request->saloon_city,
//                    'saloon_address' => $request->saloon_address,
//                    'saloon_phone' => $request->saloon_phone,
//                    // Add other fields as needed
//                ]);
//                $request->user->update(['role' => 2]);
//                // Save the created profile
//                $stylistProfile->save();
//
//                // Delete the record from request_stylist table
//                $request->delete();
//
//                // Commit the transaction
//                DB::commit();
//
//                // Redirect back with a success message
//                return redirect()->back()->with('success', 'Request approved successfully');
//            } catch (\Exception $e) {
//                // Rollback the transaction in case of an error
//                DB::rollBack();
//
//                // Handle the exception (e.g., log it, show an error message)
//                // Redirect back with an error message
//                return redirect()->back()->with('error', 'Unable to approve request');
//            }
//        } else {
//            // Redirect back with an error message if the user does not exist or has a different role
//            return redirect()->back()->with('error', 'Unable to approve request');
//        }
//    }
