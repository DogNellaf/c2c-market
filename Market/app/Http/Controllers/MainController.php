<?php

namespace App\Http\Controllers;

use App\Models\Ad;
use App\Models\User;
use App\Models\Order;
use App\Models\WalletHistory;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

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
        return Ad::whereIn('id', $ids)->where("status", "=", "Showed");
	}

    /**
     * [GET] Show index page.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index() {
		return view('main/index', ['ads' => self::__get_most_popular_ads()->paginate(10)]);
	}

    /**
     * [GET] Show ADs list page.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
	public function ads() {
        $ads = self::__get_most_popular_ads();
		return view('main/ads/list', [
            'ads' => $ads->paginate(10),
            'main_ads' => $ads->limit(4)->get()
        ]);
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

    /**
     * [GET] Confirm buying and redirect to home.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function confirm(Ad $ad) {

        if (!Auth::check()) {
            return abort('403');
        }

        $user = Auth::user();

        if ($ad->user_id == $user->id) {
            return abort('403');
        }

        if ($user->get_wallet_balance() < $ad->price) {
            return abort('500');
        }

        $outcome_transaction = WalletHistory::create([
            'user_id' => $user->id,
            'value' => $ad->price,
            'type' => "Outcome"
        ]);
        $outcome_transaction->save();

        $income_transaction = WalletHistory::create([
            'user_id' => $ad->user_id,
            'value' => $ad->price * 0.9,
            'type' => "Income"
        ]);
        $income_transaction->save();

        $order = Order::create([
            'ad_id' => $ad->id,
            'user_id' => $user->id,
            'price' => $ad->price,
            'status' => 'Paid'
        ]);
        $order->save();
        return redirect()->route('home.ads.bought');
    }
}
