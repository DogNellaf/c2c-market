<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

use App\Models\Ad;
use App\Models\Review;

class AdminController extends Controller
{
    private const AD_VALIDATOR = [
		'title' => 'required|max:255',
		'description' => 'required', 
		'price' => 'required', 
		'video_link' => 'nullable|max:255', 
		'model_link' => 'required|max:255'
	];

    private const REVIEW_VALIDATOR = [
		'title' => 'required|max:255',
		'text' => 'required', 
		'is_recommended' => 'required|boolean', 
		'rate' => 'required|integer'
	];

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
		return view('admin');
	}

    /**
     * [GET] Show the Ad editor page.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
	public function ad_editor() {
		$user = Auth::user();

        if ($user->is_admin == 0) {
            return abort('403');
        }
		$ads = Ad::paginate(10);
		return view('ad-editor', compact('ads'));
	}

    /**
     * [GET] Show the Ad create page.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
	public function ad_create() {
		$user = Auth::user();

        if ($user->is_admin == 0) {
            return abort('403');
        }
		return view('ad-create');
	}

    /**
     * [POST] Validate and save Ad to Database and redirect to Ad editor page.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
	public function ad_store(Request $request) {
		$user = Auth::user();

        if ($user->is_admin == 0) {
            return abort('403');
        }

		$validated = $request->validate(self::AD_VALIDATOR);
		Ad::create([
			'title' => $validated['title'],
			'description' => $validated['description'],
			'price' => $validated['price'],
			'video_link' => $validated['video_link'],
			'model_link' => $validated['model_link'],
			'user_id' => $user->id
			]);
		return redirect()->route('ad-editor');
	}

    /**
     * [DELETE] Delete Ad from Database and redirect to Ad editor page.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
	public function ad_delete(Request $request, Ad $ad) {
		$user = Auth::user();

        if ($user->is_admin == 0) {
            return abort('403');
        }
		$ad->delete();
		return redirect()->route('ad-editor');
	}

    /**
     * [GET] Show Ad edit page.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
	public function ad_edit(Ad $ad) {
		$user = Auth::user();

        if ($user->is_admin == 0) {
            return abort('403');
        }
		return view('ad-edit', ['ad' => $ad]);
	}


    /**
     * [UPDATE] Save new version of Ad to database and redirect to Ad edit page.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
	public function ad_update(Request $request, Ad $ad) {
		$user = Auth::user();

        if ($user->is_admin == 0) {
            return abort('403');
        }
		$validated = $request->validate(self::AD_VALIDATOR);
		$ad->fill(['title' => $validated['title'],
				   'description' => $validated['description'],
				   'price' => $validated['price'],
				   'video_link' => $validated['video_link'],
				   'model_link' => $validated['model_link'],
				   'status' => $ad->status]);
	  $ad->save();
	  return redirect()->route('ad-editor');
	}
	
	/**
     * [GET] Show Review edit page.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
	public function review_editor() {
		$user = Auth::user();

        if ($user->is_admin == 0) {
            return abort('403');
        }
		$reviews = Review::paginate(10);
		return view('review-editor', compact('reviews'));
	}

    /**
     * [GET] Show Review create page.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
	public function review_create() {
		$user = Auth::user();

        if ($user->is_admin == 0) {
            return abort('403');
        }
		return view('review-create');
	}

	/**
     * [POST] Save Review to database and redirect to Review editor page.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
	public function review_store(Request $request) {
		$user = Auth::user();

        if ($user->is_admin == 0) {
            return abort('403');
        }
		$validated = $request->validate(self::REVIEW_VALIDATOR);
		Review::create([
			'title' => $validated['title'],
			'text' => $validated['text'],
			'is_recommended' => $validated['is_recommended'],
			'rate' => $validated['rate'],
			'user_id' => $user->id
			]);
		return redirect()->route('review-editor');
	}

    /**
     * [DELETE] Delete Review from database and redirect to review editor page.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
	public function review_delete(Request $request, Review $review) {
		$user = Auth::user();

        if ($user->is_admin == 0) {
            return abort('403');
        }
		$review->delete();
		return redirect()->route('review-editor');
	}

    /**
     * [GET] Show Review edit page.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
	public function review_edit(Review $review) {
		$user = Auth::user();

        if ($user->is_admin == 0) {
            return abort('403');
        }
		return view('review-edit', ['review' => $review]);
	}

	/**
     * [UPDATE] Save new Review version to database and redirect to review-editor.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
	public function review_update(Request $request, Review $review) {
		$user = Auth::user();

        if ($user->is_admin == 0) {
            return abort('403');
        }
		$validated = $request->validate(self::REVIEW_VALIDATOR);
		$review->fill(['title' => $validated['title'],
					   'text' => $validated['text'],
					   'is_recommended' => $validated['is_recommended'],
					   'rate' => $validated['rate'],
					   'status' => $review->status
					   ]);
	  $review->save();
	  return redirect()->route('review-editor');
	}
}