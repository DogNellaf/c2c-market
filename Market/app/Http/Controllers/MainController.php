<?php

namespace App\Http\Controllers;

use App\Models\Ad;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class MainController extends Controller
{
	// get ads with orderBy avg rating
	protected static function __get_most_popular_ads() {
        $ads = DB::table('ads')
        ->leftJoin('reviews', 'reviews.ad_id', '=', 'ads.id')
        ->join('users', 'users.id', '=', 'ads.user_id')
        ->select(DB::raw("AVG('reviews.rating') as average, ads.id as id"))
        ->groupBy('ads.id')
        ->orderBy('average', 'DESC')
        ->get();
        $ids = $ads->pluck('id');
        return Ad::whereIn('id', $ids)->get();
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
		return view('main/ads/list', self::__get_most_popular_ads()->paginate(10));
	}

    /**
     * [GET] Show ADs buy page.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
	public function buy(Ad $ad) {
		return view('main/ads/buy', ['ad' => $ad]);
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
	public function ad_detail(Ad $ad) {
		return view('main/ads/detail', ['ad' => $ad]);
	}


    /**
     * [GET] Show User info page.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
	public function user_detail(User $user) {
		return view('main/users/detail', ['user' => $user]);
	}
}
