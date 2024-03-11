<?php

namespace App\Http\Controllers;

use App\Models\Ad;

class MainController extends Controller
{
	// get most popular ads (by sells count)
	protected static function __get_popular_ads() {
		return ['ads' => Ad::latest()->get()];
	}

    /**
     * [GET] Show index site page.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index() {
		return view('main/index', self::__get_popular_ads());
	}

    /**
     * [GET] Show ADs site page.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
	public function ads() {
		return view('main/ads', self::__get_popular_ads());
	}

    /**
     * [GET] Show Ad info page.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
	public function detail(Ad $ad) {
		return view('main/detail', ['ad' => $ad]);
	}
}