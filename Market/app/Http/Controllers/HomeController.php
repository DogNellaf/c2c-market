<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

use App\Models\Ad;
use App\Models\Review;

class HomeController extends Controller
{

    private const AD_EDIT_VALIDATOR = [
		'title' => ['required', 'max:255', 'min:1'],
		'description' => ['required', 'min:1'], 
		'price' => ['required', 'numeric'], 
		'video_link' => ['nullable', 'max:255']
	];

    private const AD_CREATE_VALIDATOR = [
		'model' => 'required|max:4096',
        'photo' => 'required|max:1024',
	];

    private const REVIEW_CREATE_VALIDATOR = [
        'ad_id' => 'required|integer',
		'title' => 'required|max:255',
        'text' => 'required|string',
        'is_recommended' => 'required|string',
        'rate' => 'required|integer|min:1|max:5'
	];

    private const REVIEW_EDIT_VALIDATOR = [
		'title' => 'required|max:255',
        'text' => 'required|string',
        'is_recommended' => 'required|string',
        'rate' => 'required|integer|min:1|max:5'
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
     * Checks auth user and throw 403, if this is guest
     * 
     * @return void
     */
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
        return view('home/index', [
            'user' => $user
        ]);
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

            'avatar' => ['nullable', 'max:1024']
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
        return redirect()->route('home.index');
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
            'ads' => $user->ads()->paginate(5)
        ]);
    }

    /**
     * [GET] Show the Ad create page.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
	public function ads_create_page() {
		return view('home/ads/create', [
            'user' => self::check_auth_user()
        ]);
	}

    /**
     * [POST] Validate and save Ad to Database and redirect to Ad editor page.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
	public function ads_create_method(Request $request) {
		$user = self::check_auth_user();

        $validated = $request->validate(self::AD_EDIT_VALIDATOR);
		$request->validate(self::AD_CREATE_VALIDATOR);

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
		return view('home/ads/edit', [
            'ad' => $ad, 
            'user' => self::check_auth_user()
        ]);
	}

    /**
     * [PATCH] Save new version of Ad to database and redirect to Ad edit page.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
	public function ads_edit_method(Request $request, Ad $ad) {
		$user = self::check_auth_user();

        if ($ad->user_id != $user->id) {
            return abort('403');
        }

		$validated = $request->validate(self::AD_EDIT_VALIDATOR);

		$ad->fill([
            'title' => $validated['title'],
			'description' => $validated['description'],
			'price' => $validated['price'],
			'video_link' => $validated['video_link']
        ]);

        $ad->save();
        return redirect()->route('home.ads.own');
	}

    /**
     * [PATCH] Change Ad status to Hidden from owner.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
	public function ads_hide_method(Request $request, Ad $ad) {
		$user = Auth::user();

        if ($ad->user_id != $user->id) {
            return abort('403');
        }

        if ($ad->status = "Showed") {
            $ad->status = 'Hidden';
            $ad->save();
            return redirect()->route('home.ads.own');
        } else {
            return abort('403');
        }
	}

    /**
     * [PATCH] Change Ad status to Showed from owner.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
	public function ads_show_method(Request $request, Ad $ad) {
		$user = Auth::user();

        if ($ad->user_id != $user->id) {
            return abort('403');
        }

        if ($ad->status = "Hidden") {
            $ad->status = 'Showed';
            $ad->save();
            return redirect()->route('home.ads.own');
        } else {
            return abort('403');
        }
	}

    /**
     * [GET] Show user dashboard page with account user's bought models.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function bought_ads()
    {
        $user = self::check_auth_user();
        return view('home/ads/bought', [
            'user' => $user, 
            'orders' => $user->orders()->paginate(5)
        ]);
    }

    /**
     * [GET] Show user dashboard page with user's reviews.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function reviews()
    {
        $user = self::check_auth_user();
        return view('home/reviews/index', [
            'user' => $user, 
            'reviews' => $user->reviews()->paginate(5)
        ]);
    }

    /**
     * [GET] Show the Review create page.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
	public function review_create_page() {
        
        $user = self::check_auth_user();
		return view('home/reviews/create', [
            'user' => $user, 
            'orders' => $user->orders_without_review()->paginate(10)
        ]);
	}

    /**
     * [POST] Validate and save Review to Database and redirect to Reviews list home page.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function review_create_method(Request $request) {
		
        $user = self::check_auth_user();

        $validated = $request->validate(self::REVIEW_CREATE_VALIDATOR);

        // create ad

        $ad_id = Ad::where('id', '=', $validated['ad_id'])->first()->id;

        $is_recommended =  $validated['is_recommended'] == 'True'? True : False;

        Review::create([
            'title' => $validated['title'],
            'text' => $validated['text'],
            'is_recommended' => $is_recommended,
            'rate' => $validated['rate'],
            'ad_id' => $ad_id,
            'user_id' => $user->id
        ]);

		return redirect()->route('home.reviews.list');
	}

    /**
     * [GET] Show Review edit page.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
	public function review_edit_page(Review $review) {
		return view('home/reviews/edit', [
            'user' => self::check_auth_user(),
            'review' => $review
        ]);
	}

    /**
     * [PATCH] Save new version of Review to database and redirect to Reviews list page.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
	public function review_edit_method(Request $request, Review $review) {
		
        $user = self::check_auth_user();

        if ($review->user_id != $user->id) {
            return abort('403');
        }

		$validated = $request->validate(self::REVIEW_EDIT_VALIDATOR);

        $is_recommended =  $validated['is_recommended'] == 'True'? True : False;

		$review->fill([
            'title' => $validated['title'],
            'text' => $validated['text'],
            'is_recommended' => $is_recommended,
            'rate' => $validated['rate']
        ]);

        $review->save();

        return redirect()->route('home.reviews.list');
	}

    /**
     * [GET] Show user dashboard page with user sell stats with year param.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function stats(Request $request)
    {

        $user = self::check_auth_user();

        $current_year = date("Y");
        $current_month = date("m");

        $year = $request['year'];
        if ($year == null) {
            $year = $current_year;
        }

        $months = array(1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12);
        $values = [];
        $max_value = 0;

        if ($year > $current_year) {
            return abort(500);
        }

        if ($year == $current_year) {
            for ($i = 12; $i > $current_month; $i--) {
                unset($months[$i - 1]);
                $months = array_values($months);
            }
        }

        foreach ($months as $month) {
            $income = $user->get_income($year, $month);
            if ($income > $max_value) {
                $max_value = $income;
            }
            array_push($values, $income);
        }

        return view('home/stats', [
            'user' => $user, 
            'values' => $values,
            'months' => $months,
            'year' => $year,
            'max_value' => $max_value * 1.2
        ]);
    }
}
