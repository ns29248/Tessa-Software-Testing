<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Relations\HasOne;

class User extends Authenticatable
{
    use  HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'address',
        'city',
        'phone',
        'postcode',
        'password',
        'request_submitted',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

	public function profile(): HasOne
	{
		return $this->hasOne(StylistProfile::class);
	}

    public function request(): HasOne
    {
        return $this->hasOne(RequestStylist::class, 'user_id');
    }

    public function coupons() :BelongsToMany
    {
        return $this->belongsToMany(Coupon::class)->withPivot('used_at');
    }

    public function cart() :HasMany
    {
        return $this->hasMany(Cart::class);
    }
    public function products()
    {
        return $this->belongsToMany(Product::class, 'product_user');
    }


}
