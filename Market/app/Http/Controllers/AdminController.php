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
     * [GET] Show the administrator dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index() {
		$user = Auth::user();

        if ($user->is_admin == 0) {
            return abort('403');
        }
		return view('admin/index');
	}
}