<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;

class HomeController extends Controller
{
    // private const DATA_VALIDATOR = [
	// 	'name' => ['required', 'string', 'unique:users', 'max:255', 'min:8', Rule::unique('users')->ignore(Auth::user())],
	// 	'email' => ['required', 'email', 'unique:users', 'max:255', 'min:5', Rule::unique('users')->ignore(Auth::user())], 
	// 	'password' => ['nullable', 'string'], 
	// 	'avatar_url' => ['nullable', 'max:255']
	// ];


    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user = Auth::user();
        return view('home', ['user' => $user]);
    }

    public function save_data(Request $request) {
        $user = Auth::user();
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255', 'min:8', Rule::unique('users')->ignore($user)],
            'email' => ['required', 'email', 'max:255', 'min:5', Rule::unique('users')->ignore($user)], 
            'password' => ['nullable', 'string'], 
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
        return view('home', ['user' => $user]);
    }
}
