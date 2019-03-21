<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Provinces;
use App\Airways;
use App\Countries;

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
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('front-end.index');
    }

    // hiển thị danh sách các sân bay theo tỉnh
    public function getListAirport()
    {
        $sql = Provinces::
        leftjoin('airports', 'airports.airport_province_id', '=', 'provinces.province_id')
        ->get();

        return view('front-end.airport', ['sql' => $sql]);
    }

    // hiển thị danh sách các hãng bay theo nước
    public function listAirline()
    {
        $sql = Countries::
        leftjoin('airways', 'airways.airway_country_id', '=', 'countries.country_id')
        ->get();
        return view('front-end.airline', ['sql' => $sql]);
    }
}
