<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

use App\Models\Review;
use App\Models\Ad;
use App\Models\User;
use App\Models\Order;

class AdminController extends Controller
{
    // private const REVIEW_VALIDATOR = [
	// 	'title' => 'required|max:255',
	// 	'text' => 'required', 
	// 	'is_recommended' => 'required|boolean', 
	// 	'rate' => 'required|integer'
	// ];

	/**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Checks auth user and throw 403, if this is guest
     * 
     * @return \Illuminate\Contracts\Auth\Authenticatable
     */
    protected function check_auth_user() {
        $user = Auth::user();

        if (!$user) {
            abort(403);
        }

        if ($user->is_admin == 0) {
            abort(403);
        }

        return $user;
    }

    /**
     * [GET] Show the ads editor page.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function ads(Request $request) {
		$user = self::check_auth_user();

        $ads = Ad::where("user_id", "!=", "-1");

        $status = $request['status'];

        if ($status != null) {
            if ($status != "All") {
                $ads = $ads->where("status", "=", $status);
            }
        } else {
            $status = "All";
        }

		return view('admin/ads/list', ['user' => $user, 
                                       'ads' => $ads->paginate(10),
                                       'status' => $status]);
	}

    /**
     * [GET] Show the users editor page.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function users(Request $request) {
		$user = self::check_auth_user();

        $users = User::where("is_admin", "=", "False");

        $is_banned = $request['is_banned'];

        if ($is_banned != null) {
            if ($is_banned == "true") {
                $users = $users->where("is_banned", "=", "1");
            } else if ($is_banned == "false") {
                $users = $users->where("is_banned", "=", "0");
            }
        }

		return view('admin/users/list', ['user' => $user, 
                                         'users' => $users->paginate(10),
                                         'is_banned' => $is_banned]);
	}

    /**
     * [GET] Show the reviews editor page.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function reviews() {
		$user = self::check_auth_user();

		return view('admin/reviews/list', ['user' => $user, 
                                           'reviews' => Review::paginate(10)]);
	}

    /**
     * [GET] Show the detail review page.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function review(Review $review) {
		$user = self::check_auth_user();

		return view('admin/reviews/detail', ['user' => $user, 
                                             'review' => $review]);
	}

    /**
     * [PATCH] Change Ad status to Rejected from admin.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
	public function review_reject(Review $review) {
		$user = Auth::user();

        if (!$user->is_admin) {
            return abort('403');
        }

        $review->status = "Rejected";
        $review->save();
        return redirect()->route('admin.reviews.list');
	}

    /**
     * [PATCH] Change Ad status to Showed from admin.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
	public function review_approve(Review $review) {
		$user = Auth::user();

        if (!$user->is_admin) {
            return abort('403');
        }

        $review->status = "Showed";
        $review->save();
        return redirect()->route('admin.reviews.list');
	}

    /**
     * [GET] Show the reviews editor page.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function orders() {
		$user = self::check_auth_user();

		return view('admin/orders/list', ['user' => $user, 
                                          'orders' => Order::paginate(10)]);
	}

    /**
     * [PATCH] Change Ad status to Rejected from admin.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
	public function ad_reject(Ad $ad) {
		$user = Auth::user();

        if (!$user->is_admin) {
            return abort('403');
        }

        $ad->status = "Rejected";
        $ad->save();
        return redirect()->route('admin.ads.list');
	}

    /**
     * [PATCH] Change Ad status to Showed from admin.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
	public function ad_approve(Ad $ad) {
		$user = Auth::user();

        if (!$user->is_admin) {
            return abort('403');
        }

        $ad->status = "Showed";
        $ad->save();
        return redirect()->route('admin.ads.list');
	}

    /**
     * [PATCH] Ban user.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
	public function user_ban(User $user) {
		$admin = Auth::user();

        if (!$admin->is_admin) {
            return abort('403');
        }

        $user->is_banned = True;
        $user->save();

        // $this->logout_user($admin, $user);

        return redirect()->route('admin.users.list');
	}

    /**
     * [PATCH] Unban user.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
	public function user_unban(User $user) {
		$admin = Auth::user();

        if (!$admin->is_admin) {
            return abort('403');
        }

        $user->is_banned = False;
        $user->save();

        return redirect()->route('admin.users.list');
	}
}