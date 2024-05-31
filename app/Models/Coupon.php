<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Coupon extends Model
{
    use HasFactory;
    protected $table = 'coupons';

    protected $fillable = [
        'code',
        'type',
        'value',
        'quantity',
        'expiration_date',
    ];

    protected $casts = [
        'expiration_date' => 'datetime', // Ensure this is cast to a Carbon instance
    ];

    public function orders():HasMany
    {
        return $this->hasMany(Order::class, 'coupon_id');
    }

    public function users():BelongsToMany
    {
        return $this->belongsToMany(User::class)->withPivot('used_at');
    }

}
