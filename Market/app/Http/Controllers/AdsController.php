<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

use App\Models\Ad;

use Illuminate\Http\Request;

class AdsController extends Controller
{

    private const AD_VALIDATOR = [
		'title' => 'required|max:255',
		'description' => 'required', 
		'price' => 'required', 
		'video_link' => 'nullable|max:255', 
		'model_link' => 'required|max:255'
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
     * [GET] Show the Ad create page.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
	public function create_page() {
		$user = Auth::user();

        // if ($user->is_admin == 0) {
        //     return abort('403');
        // }
		return view('ad/create', ['user' => $user]);
	}

    /**
     * [GET] Show Ad edit page.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
	public function edit_page(Ad $ad) {
		// $user = Auth::user();

        // if ($user->is_admin == 0) {
        //     return abort('403');
        // }
		return view('ad/edit', ['ad' => $ad]);
	}

    /**
     * [POST] Validate and save Ad to Database and redirect to Ad editor page.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
	public function create(Request $request) {
		$user = Auth::user();

        // if ($user->is_admin == 0) {
        //     return abort('403');
        // }

		$validated = $request->validate(self::AD_VALIDATOR);
		Ad::create([
			'title' => $validated['title'],
			'description' => $validated['description'],
			'price' => $validated['price'],
			'video_link' => $validated['video_link'],
			'model_link' => $validated['model_link'],
			'user_id' => $user->id
			]);
		return redirect()->route('home-own');
	}

    /**
     * [DELETE] Delete Ad from Database and redirect to Ad editor page.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
	public function delete(Request $request, Ad $ad) {
		// $user = Auth::user();

        // if ($user->is_admin == 0) {
        //     return abort('403');
        // }
		$ad->delete();
		return redirect()->route('ad-editor');
	}


    /**
     * [PATCH] Save new version of Ad to database and redirect to Ad edit page.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
	public function update(Request $request, Ad $ad) {
		// $user = Auth::user();

        // if ($user->is_admin == 0) {
        //     return abort('403');
        // }
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
}
