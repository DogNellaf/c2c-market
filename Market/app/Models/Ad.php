<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\User;
use App\Models\Order;
use App\Models\Review;

class Ad extends Model
{
    protected $fillable = ['title', 
						   'description', 
						   'price', 
						   'video_link', 
						   'model_link', 
						   'status', 
						   'user_id',
						   'photo_link'
						   ];
	public function user() {
		return $this->belongsTo(User::class);
	}
	public function orders() {
		return $this->hasMany(Order::class);
	}
	public function reviews() {
		return $this->hasMany(Review::class);
	}
}
