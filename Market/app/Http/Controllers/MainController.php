<?php

namespace App\Http\Controllers;

use App\Models\Ad;
use Illuminate\Support\Facades\DB;

class MainController extends Controller
{
	// get ads with orderBy avg rating
	protected static function __get_most_popular_ads() {
        return Ad::all()
            ->join('reviews', 'reviews.ad_id', '=', 'ads.id')
            ->select(DB::raw('avg(reviews.rating) as average, ads.*'))
            ->groupBy('id')
            ->orderBy('average', 'desc');
	}


	// get 10 most popular ads
	protected static function __get_ten_most_popular_ads() {
        return self::__get_most_popular_ads()->limit(10);
	}

    /**
     * [GET] Show index page.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index() {
		return view('main/index', ['ads' => self::__get_most_popular_ads()]);
	}

    /**
     * [GET] Show ADs list page.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
	public function ads() {
		return view('main/ads', self::__get_most_popular_ads()->paginate(10));
	}

    /**
     * [GET] Show rules site page.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
	public function rules() {
		return view('main/rules');
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
