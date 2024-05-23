<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Ad;
use App\Models\Order;
use App\Models\Review;
use App\Models\WalletHistory;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

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

    /* sales income for n-month */
    public function get_income($year, $month) {
        $sum = 0;
        $ads = $this->ads()->get();
        $month_start = date_create($year.'-'.$month.'-1');
        $month_end = date_create($year.'-'.$month.'-31');
        foreach ($ads as $ad) {
            $orders = $ad->orders()->where('created_at', '>=', $month_start)->where('created_at', '<=', $month_end)->get();
            foreach ($orders as $order) {
                $sum = $sum + $order->price;
            }
        }
        return $sum;
    }

    /* current balance */
    public function get_wallet_balance() {
        $outcome_sum = WalletHistory::where("user_id", "=", $this->id)
                                    ->where("type", "like", "Outcome")
                                    ->sum("value");
        if ($outcome_sum == null) {
            $outcome_sum = 0;
        }

        $income_sum = WalletHistory::where("user_id", "=", $this->id)
                                   ->where("type", "=", "Income")
                                   ->sum("value");
        if ($income_sum == null) {
            $outcome_sum = 0;
        }

        return $income_sum - $outcome_sum;
    }

    /* this user's transactions from Wallet History */
	public function transactions() {
		return $this->hasMany(WalletHistory::class);
	}


    /* orders to buy models */
	public function orders() {
		return $this->hasMany(Order::class);
	}

    /* orders without any reviews from this user */
	public function orders_without_review() {
        $ads_ids = $this->reviews()->pluck('ad_id');
		return $this->orders()->whereNotIn('ad_id', $ads_ids);
	}

    /* bought ads */
	public function bought_ads() {
		return $this->hasManyThrough(Order::class, Ad::class);
	}

    /* owned reviews */
	public function reviews() {
		return $this->hasMany(Review::class);
	}
}
