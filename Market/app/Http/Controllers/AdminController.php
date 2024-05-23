<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

use App\Models\Review;
use App\Models\Ad;
use App\Models\User;

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
     * Logout current user.
     * 
    */
    protected function logout_user($current_user, $logout_user) {
        Auth::setUser($logout_user);
        Auth::logout();
        Auth::setUser($current_user);
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
    public function ads() {
		$user = self::check_auth_user();

		return view('admin/ads/list', ['user' => $user, 'ads' => Ad::paginate(10)]);
	}

    /**
     * [GET] Show the users editor page.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function users() {
		$user = self::check_auth_user();

		return view('admin/users/list', ['user' => $user, 'users' => User::where("is_admin", "=", "False")->paginate(10)]);
	}

    /**
     * [PATCH] Change Ad status to Rejected from admin.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
	public function ad_reject(Request $request, Ad $ad) {
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
	public function ad_approve(Request $request, Ad $ad) {
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
	public function user_ban(Request $request, User $user) {
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
	public function user_unban(Request $request, User $user) {
		$admin = Auth::user();

        if (!$admin->is_admin) {
            return abort('403');
        }

        $user->is_banned = False;
        $user->save();

        return redirect()->route('admin.users.list');
	}
}