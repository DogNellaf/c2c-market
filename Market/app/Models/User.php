<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Ad;
use App\Models\Order;
use App\Models\Review;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'is_banned',
        'avatar_url'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'remember_token',
        'is_admin'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    /* owned ads */
	public function ads() {
		return $this->hasMany(Ad::class);
	}

    /* orders to buy models */
	public function orders() {
		return $this->hasMany(Order::class);
	}

    /* bought ads */
	// public function bought_ads() {
	// 	return $this->hasManyThrough(Order::class, Ad::class);
	// }

    /* owned reviews */
	public function reviews() {
		return $this->hasMany(Review::class);
	}
}
