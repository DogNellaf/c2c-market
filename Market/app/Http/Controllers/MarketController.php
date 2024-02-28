<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Ad;

class MarketController extends Controller
{
	public static function __get_popular_ads() {
		return ['ads' => Ad::latest()->get()];
	}

    public function index() {
		return view('index', self::__get_popular_ads());
	}

	public function ads() {
		return view('ads', self::__get_popular_ads());
	}

	public function detail(Ad $ad) {
		return view('detail', ['ad' => $ad]);
	}
}
