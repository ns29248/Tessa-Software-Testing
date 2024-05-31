<?php

namespace App\Services;

use App\Models\StylistProfile;

class StylistService
{
    public function getAllStylists()
    {
        return StylistProfile::all();
    }

    public function getStylistById($id)
    {
        return StylistProfile::findOrFail($id);
    }

    public function deleteStylist(StylistProfile $stylist)
    {
        $stylist->delete();
    }
}

