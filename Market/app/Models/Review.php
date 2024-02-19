<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\User;
use App\Models\Ad;

class Review extends Model
{
    protected $fillable = ['title', 
						   'text', 
						   'is_recommended', 
						   'rate', 
						   'status'
						   ];
	public function user() {
		return $this->belongsTo(User::class);
	}
	public function ad() {
		return $this->belongsTo(Ad::class);
	}
}
