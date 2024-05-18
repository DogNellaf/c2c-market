<?php

namespace App\Models;

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

	/* ad owner */ 
	public function user() {
		return $this->belongsTo(User::class);
	}
	
	/* orders, where bought this ad */
	public function orders() {
		return $this->hasMany(Order::class);
	}

	/* reviews about this ad */
	public function reviews() {
		return $this->hasMany(Review::class);
	}

	/* reviews about this ad with pagination */
	public function reviews_with_pagination() {
		return $this->hasMany(Review::class)->paginate(10);
	}

	/* mean of rates in reviews about this ad, if no reviews, will return -1 */
	public function get_average_rating() {
		$reviews = $this->reviews;
		if ($reviews->count() != 0) {
			return $reviews->pluck('rate')->avg();
		} 
		return -1;
	}
}
