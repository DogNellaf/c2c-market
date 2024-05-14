<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Models\User;
use App\Models\Ad;

class Order extends Model
{
    protected $fillable = ['ad_id', 'user_id', 'price', 'status'];
	public function user() {
		return $this->belongsTo(User::class);
	}
	public function ad() {
		return $this->belongsTo(Ad::class);
	}
}
