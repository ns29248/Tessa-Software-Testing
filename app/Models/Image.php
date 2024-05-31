<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Support\Facades\Storage;

class Image extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    public function delete()
    {
        // Delete the image file from storage if needed
        Storage::delete('public/images/' . $this->name);


        // Delete the image record from the database
        return parent::delete();
    }

    public function imageable():MorphTo
    {
        return $this->morphTo();
    }
}
