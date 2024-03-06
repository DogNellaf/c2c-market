<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class HomeController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show user dashboard page with account info card.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = Auth::user();
        return view('home/index', ['user' => $user]);
    }

    /**
     * Show user dashboard page with user's own models.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function my_models()
    {
        throw new NotFoundHttpException("Страница не существует");
        // $user = Auth::user();
        // $ads = $user->ads();
        // return view('home/own-ads', ['user' => $user, 'ads' => $ads]);
    }

    /**
     * Show user dashboard page with account user's bought models.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function bought_models()
    {
        throw new NotFoundHttpException("Страница не существует");
        // TODO
        // $user = Auth::user();
        // $ads = $user->ads();
        // return view('home/bought-ads', ['user' => $user, 'ads' => $ads]);
    }

    /**
     * Show user dashboard page with user's reviews.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function reviews()
    {
        throw new NotFoundHttpException("Страница не существует");
        // TODO
        // $user = Auth::user();
        // $ads = $user->ads();
        // return view('home/reviews', ['user' => $user, 'ads' => $ads]);
    }

    /**
     * Show user dashboard page with user sell stats.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function stats()
    {
        throw new NotFoundHttpException("Страница не существует");
        // TODO
        // $user = Auth::user();
        // $ads = $user->ads();
        // return view('home/stats', ['user' => $user, 'ads' => $ads]);
    }

    /**
     * POST Save user data and redirect to account info card.
     *
     * @param \Illuminate\Http\Request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function save_data(Request $request) {
        $user = Auth::user();
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
}
