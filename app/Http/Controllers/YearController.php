<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Models\Year;
use Vinkla\Hashids\Facades\Hashids;

class YearController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    // --------------------------------------------------

    public function index()
    {
        return view('year');
    }

    // --------------------------------------------------

    /**
     * Mengubah year active di session
     * berdampak hanya ke pengguna ini
     */
    public function change_current($year_id = 0)
    {
        $year_id = Hashids::decode($year_id)[0];
        $year = Year::find($year_id)->toArray();

        session()->put('current_year', $year);
        return redirect('/home');
    }
}
