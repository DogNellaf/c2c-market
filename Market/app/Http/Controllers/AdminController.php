<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

use App\Models\Review;
use App\Models\Ad;

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
     * [GET] Show the administrator dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index() {
		$user = self::check_auth_user();

		return view('admin/index', ['user' => $user, 'ads' => Ad::paginate(10)]);
	}
}