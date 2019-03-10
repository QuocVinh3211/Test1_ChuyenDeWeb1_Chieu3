<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Airways;
use App\List_cities;
use App\Flights;
use DB;
use Illuminate\Support\Facades\Auth;
use App\Passengers;
use App\Flights_booking;
use App\Http\Requests\BookingRequest;
use Illuminate\Support\Facades\URL; 
use App\Http\Requests\FlightRequest;

class FlightController extends Controller
{   
    // get list city
    public function getList()
    {
        $flight = list_cities::all();
        return view('front-end.index', ['flight' => $flight]);
    }

    // get view detail
    public function detail($flight_id, $total, $flight_class, $time_from)
    {
        $flight = DB::table('flights')->where('flight_id', '=' , $flight_id)->get();
        // truyen biến get
        return View('front-end.flight-detail', ['flight' => $flight, 'flight_id' => $flight_id, 
                    'total' => $total, 'flight_class' => $flight_class, 'time_from' => $time_from]);
    }

    // get view booking
    public function booking($flight_id, $total, $flight_class, $time_from)
    {          
            $flight = DB::table('flights')->where('flight_id', '=' , $flight_id)->get();

            return View('front-end.flight-book', ['flight' => $flight, 'flight_id' => $flight_id, 
                    'total' => $total, 'flight_class' => $flight_class, 'time_from' => $time_from]);         
    }

     // get view booking 2 chieu
     public function booking_2(FlightRequest $res)
     {          
        $flight_re_id =  $res->flight_return;
        $flight_de_id =  $res->flight_depature;
        $flight_class =  $res->flight_class;
        $total        =  $res->total;

        // thong tin chuyến đi
        $flight_depature = DB::table('flights')->where('flight_id', '=' , $flight_de_id)->get();
        // thông tin chuyến về
        $flight_return = DB::table('flights')->where('flight_id', '=' , $flight_re_id)->get();   
 
        return View('front-end.flight-book', ['flight_depature' => $flight_depature, 'flight_return' => $flight_return, 'flight_class' => $flight_class
          ,'total' => $total  ]);         
     }

    // search
    public function getSearch(Request $res)
    {
        $from        = $res->from;
        $to          = $res->to;
        $time_return = $res->return;

        if($time_return == ""){ // nếu không có return thì tìm các chuyến bay đi
            $flight_to = DB::table('flights')->where([
            ['flight_city_from_id', '=', $from],
            ['flight_city_to_id', '=', $to],
            ])->get();
            $flight_return = ""; // gán các chuyến bay về = null
        }
        else {
            $flight_return = DB::table('flights')->where([ // nếu có time return thì tìm các chuyến về
                ['flight_city_from_id', '=', $to],
                ['flight_city_to_id', '=', $from], 
                ])->get();
            $flight_to = DB::table('flights')->where([ // đồng thời tìm các chuyến bay đi
                    ['flight_city_from_id', '=', $from],
                    ['flight_city_to_id', '=', $to],
                    ])->get();
        }
        // cau truy van search          
        
        return view('front-end.flight-list', ['flight_to'=> $flight_to, 'flight_return' => $flight_return]);
    }

    public function getSearch_2(Request $res)
    {
        $from        = $res->from;
        $to          = $res->to;
        $time_return = $res->return;
        
        if($time_return != ""){
            $users = DB::table('flights')->where([
            ['flight_city_from_id', '=', $from],
            ['flight_city_to_id', '=', $to],
            ['flight_direction', '=' , 1],
            ])->get();
        }
        // cau truy van search             
        
        return view('front-end.flight-list', ['search'=> $users]);
    }

    // book flights
    public function postBooking(Request $res){ // dùng hắn
        $total = $res->total;
        if(Auth::check()) {
            for($i = 1; $i < $total; $i++) {
              
             
            // add Passengers
            $passenger = new Passengers();
            $passenger->passenger_title       = $res->passenger_title.$i;
            $passenger->passenger_first_name  = $res->firstName.$i;
            $passenger->passenger_last_name   = $res->lastName.$i;
            $passenger->passenger_user_id     = $res->user_id;
            $passenger->passenger_fl_id       = 1;
            $passenger->save();

            }

            // add booking-flight
            $book = new Flights_booking();
            $book->user_id        = $res->user_id;
            $book->flight_id      = 1;
            $book->total_price    = 20000;
            $book->Payment_Method = $res->payment;
            $book->card_number    = $res->card_number;
            $book->card_name      = $res->card_name;
            $book->ccv_code       = $res->ccv_code;
            $book->save();                
            return redirect()->route('/');
        }
        else {
            $url = url()->previous();
            $messa = "Bạn cần đăng nhập trước khi đặt vé";
            echo "<script type='text/javascript'>
                var r = confirm('$messa');
            if (r == true) {
                 window.location.assign('$url');
            } else {
                window.location.assign('$url');
                 }
            </script>";
        }

       
    }
}
