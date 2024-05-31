<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\StylistProfile;
use App\Services\StylistService;

class StylistController extends Controller
{
    protected $stylistService;

    public function __construct(StylistService $stylistService)
    {
        $this->stylistService = $stylistService;
    }

    public function index()
    {
        $stylists = $this->stylistService->getAllStylists();
        return view('admin.stylists', ['stylists'=> $this->stylistService->getAllStylists()]);
    }

    public function show(StylistProfile $stylist)
    {
        // Since $stylist is already resolved through route model binding, we don't need to fetch it again.
        return view('admin.show-stylist', compact('stylist'));
    }

    public function destroy(StylistProfile $stylist)
    {
        $this->stylistService->deleteStylist($stylist);
        return redirect()->back()->with('success', 'Stylist deleted successfully');
    }
}

