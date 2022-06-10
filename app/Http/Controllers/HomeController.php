<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use \App\Models\Year;
// use \App\Models\Role;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->current_menu = 'home';
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $data = [];
        return view('home', ['data' => $data]);
        // dump(RoleUser::with('roles')->where('user_id', 1)->get());
        // dump(Role::find(1)->users()->get());
        // dump(Role::with('roleUser')->where('id', 1)->get());
        // $data = User::find(1);
        // dump(User::find(1)->roles2()->get());
        // dump(Role::find(1)->menus()->get());
    }
}
