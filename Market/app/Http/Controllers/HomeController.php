<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

use App\Models\Ad;

class HomeController extends Controller
{

    private const AD_VALIDATOR = [
		'title' => 'required|max:255',
		'description' => 'required', 
		'price' => 'required', 
		'video_link' => 'nullable|max:255', 
		'model' => 'required|max:4096',
        'photo' => 'required|max:1024',
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

    protected function check_auth_user() {
        $user = Auth::user();

        if (!$user) {
            abort(403);
        }

        return $user;
    }

    /**
     * [GET] Show user dashboard page with account info card.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = self::check_auth_user();
        return view('home/index', ['user' => $user]);
    }

    /**
     * [GET] Show user dashboard page with user's own models.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function own_ads()
    {
        $user = self::check_auth_user();
        return view('home/ads/index', [
            'user' => $user, 
            'ads' => $user->ads()->get()
        ]);
    }

    /**
     * [GET] Show user dashboard page with account user's bought models.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function bought_models()
    {
        $user = self::check_auth_user();
        throw new NotFoundHttpException("Страница не существует");
        // TODO
        // $user = Auth::user();
        // $ads = $user->ads();
        // return view('home/bought-ads', ['user' => $user, 'ads' => $ads]);
    }

    /**
     * [GET] Show user dashboard page with user's reviews.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function reviews()
    {
        $user = self::check_auth_user();
        throw new NotFoundHttpException("Страница не существует");
        // TODO
        // $user = Auth::user();
        // $ads = $user->ads();
        // return view('home/reviews', ['user' => $user, 'ads' => $ads]);
    }

    /**
     * [GET] Show user dashboard page with user sell stats.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function stats()
    {
        $user = self::check_auth_user();
        throw new NotFoundHttpException("Страница не существует");
        // TODO
        // $user = Auth::user();
        // $ads = $user->ads();
        // return view('home/stats', ['user' => $user, 'ads' => $ads]);
    }

    /**
     * [POST] Save user data and redirect to account info card.
     *
     * @param \Illuminate\Http\Request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function save_data(Request $request) {
        $user = self::check_auth_user();
        $validated = $request->validate([
            'name' => [
                'required', 
                'string', 
                'max:255', 
                'min:8', 
                Rule::unique('users')->ignore($user)],

            'email' => [
                'required', 
                'email', 
                'max:255', 
                'min:5', 
                Rule::unique('users')->ignore($user)], 
                
            'password' => [
                'nullable', 
                'string'], 

            'avatar' => ['nullable']
        ]);

        $user->name = $validated['name'];
        $user->email = $validated['email'];

        $password = $validated['password'];
        if ($password != null) {
            $user->password = $password;
        }

        $user->avatar_url = "images/author.jpg";

        if ($request->hasFile('avatar')) {

            $avatar = $request->file('avatar');

            $date = date('YmdHis');

            $avatar_filename = $date.'.png';

            $public_path = "storage\\";

            $avatar_path = $public_path.'\\'.$avatar_filename;

            $user->avatar_url = $avatar_path;

            $avatar->move($public_path, $avatar_filename);
        }

        $user->save();
        return redirect()->route('home');
    }


    /**
     * [GET] Show the Ad create page.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
	public function ads_create_page() {
		$user = Auth::user();

        // if ($user->is_admin == 0) {
        //     return abort('403');
        // }
		return view('home/ads/create', ['user' => $user]);
	}

    /**
     * [POST] Validate and save Ad to Database and redirect to Ad editor page.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
	public function ads_create_method(Request $request) {
		$user = Auth::user();

        // if ($user->is_admin == 0) {
        //     return abort('403');
        // }

		$validated = $request->validate(self::AD_VALIDATOR);

        // save files
   
        $model = $request->file('model');
        $photo = $request->file('photo');

        $model_name = $model->getClientOriginalName();
        $photo_name = $photo->getClientOriginalName();
        
        $dir = 'storage\\\\'.explode(".", $model_name)[0].'\\\\';

        $model_path = $dir.$model_name;
        $photo_path = $dir.$photo_name;

        $model->move($dir, $model_path);
        $photo->move($dir, $photo_path);

        // create ad

        Ad::create([
			'title' => $validated['title'],
			'description' => $validated['description'],
			'price' => $validated['price'],
			'video_link' => $validated['video_link'],
			'model_link' => $model_path,
			'user_id' => $user->id,
            'photo_link' => $photo_path
			]);

		return redirect()->route('home.ads.own');
	}

    /**
     * [GET] Show Ad edit page.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
	public function ads_edit_page(Ad $ad) {
		$user = Auth::user();

        // if ($user->is_admin == 0) {
        //     return abort('403');
        // }
		return view('home/ads/edit', ['ad' => $ad, 'user' => $user]);
	}

    /**
     * [PATCH] Save new version of Ad to database and redirect to Ad edit page.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
	public function ads_edit_method(Request $request, Ad $ad) {
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
        return redirect()->route('home.ads.own');
	}

    /**
     * [PATCH] Change Ad status to Hidden from owner.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
	public function ads_hide_method(Request $request) {
		$user = Auth::user();

        $ad = Ad::find($request['id']);

        if ($ad->user_id != $user->id) {
            return abort('403');
        }

        if ($ad->status = "Showed") {
            $ad->status = 'Hidden';
            return redirect()->route('home.ads.own');
            
        }
        else {
            return abort('403');
        }
	}

    /**
     * [PATCH] Change Ad status to Showed from owner.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
	public function ads_show_method(Request $request) {
		$user = Auth::user();

        $ad = Ad::find($request['id']);

        if ($ad->user_id != $user->id) {
            return abort('403');
        }

        if ($ad->status = "Hidden") {
            $ad->status = 'Showed';
            return redirect()->route('home.ads.own');
            
        }
        else {
            return abort('403');
        }
	}
}
