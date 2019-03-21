<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Airways;
use App\Cities;
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
    //1. lấy danh sách các thành phố
    public function getList()
    {
        $flight = Cities::getListCity();
        return view('front-end.index', ['flight' => $flight]);
    }

    //2. get view detail
    public function detail($flight_id, $total, $flight_class, $time_from)
    {
        $flight = Flights::getFlightById($flight_id);
        foreach($flight as $row) {
            $data['get_city_from'] = Cities::getNameCityTo($row->flight_city_from_id);
            $data['get_city_to']   = Cities::getNameCityFrom($row->flight_city_to_id);
        }
        // Truyền dữ liệu qua view
        return View('front-end.flight-detail', ['flight'       => $flight, 
                                                'flight_id'    => $flight_id, 
                                                'total'        => $total, 
                                                'flight_class' => $flight_class, 
                                                'time_from'    => $time_from,
                                                'data'         => $data]);
    }

     //3. get view booking 2 chieu
     public function booking_2(FlightRequest $res)
     {          
        $flight_re_id =  $res->flight_return;
        $flight_de_id =  $res->flight_depature;
        $flight_class =  $res->flight_class;
        $total        =  $res->total;
        
        // thong tin chuyến đi
        $flight_depature = Flights::getFlightById($flight_de_id);
        // thông tin chuyến về
        $flight_return = Flights::getFlightById($flight_re_id);
 
        return View('front-end.flight-book',['flight_depature' => $flight_depature, 
                                             'flight_return'   => $flight_return, 
                                             'flight_class'    => $flight_class,
                                             'total'           => $total, 
                                             'flight_de_id'    => $flight_de_id, 
                                             'flight_re_id'    => $flight_re_id, 
                                           ]);         
     }


    //4. search flights
    public function getSearch(Request $res)
    {
        $from_city_id       = $res->from;
        $to_city_id         = $res->to;
        $time_return        = $res->return;

        if($time_return == ""){ // nếu không có return thì tìm các chuyến bay đi
            $flight_to     = Flights::getSearchFlight($from_city_id, $to_city_id);
            $flight_return = ""; // gán các chuyến bay về = null
        }
        else {
            $flight_to     = Flights::getSearchFlight($from_city_id, $to_city_id);
            $flight_return = Flights::getSearchFlight($to_city_id, $from_city_id);         

            // lấy tên thành phố theo id
            foreach($flight_return as $row) {
                $data['get_city_from_re'] = Cities::getNameCityTo($row->flight_city_from_id);
                $data['get_city_to_re']   = Cities::getNameCityFrom($row->flight_city_to_id);
            }
        }

        // lấy tên thành phố
        foreach($flight_to as $row) {
            $data['get_city_from'] = Cities::getNameCityTo($row->flight_city_from_id);
            $data['get_city_to']   = Cities::getNameCityFrom($row->flight_city_to_id);

            $fl_price = $row->flight_price;

    }

        return view('front-end.flight-list', ['flight_to'     => $flight_to, 
                                              'flight_return' => $flight_return,
                                              'data'          => $data,
                                            ]);
    }


    //5. book flights
    public function postBooking(Request $res){ // xử lí khi thêm chuyến bay
        $total = $res->total;
        $passengers =  $res->passenger;
        if(Auth::check()) {
            for( $i = 0 ; $i< count ($passengers) ; $i++){   
            // add Passengers
            Passengers::insert([
                [
                'passenger_title' => $passengers[$i]["title"], 
                'passenger_first_name' =>  $passengers[$i]["first_name"],
                'passenger_last_name'=> $passengers[$i]["last_name"],
                'passenger_user_id'=> $res->user_id,
                'passenger_fl_id' => $res->flight_de_id
                ]
            ]);          
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

            // cập nhật lại số ghế ngồi
            $flight_id = $res->flight_de_id;
            $flights = Flights::where('flight_id' , '=', $flight_id)->first();
            $seat = $flights->flight_seat + $total;         
            $flights = Flights::where('flight_id' , '=', $flight_id)->update(['flight_seat' => $seat]);
           
            return redirect('/')->with('status', 'Chúc mừng đặt vé thành công!');    
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

    //5. trả về trang thêm chuyến bay
    public function getAdd(){
        $flight  = Cities::all();
        $airline = Airways::all();
        return view('front-end.add-flight', ['flight' => $flight, 'airline' => $airline]);
    }

    //6. xử lý thêm chuyến bay
    public function postAdd(Request $res){
       $flight = new Flights();
       $flight->airways_id          = $res->airline;
       $flight->flight_time_from    = $res->departure;
       $flight->flight_time_to      = $res->return;
       $flight->flight_city_from_id = $res->from;
       $flight->flight_city_to_id   = $res->to;

       // tính tiền theo số km
       $distance = $res->km;
       if($distance <= 100) {
            $price = 500000;
       }
       else if($distance <= 200) {
           $price = 1000000;
       }
       else if($distance <= 500) {
           $price = 2000000;
       }
       else if($distance <= 1000) {
        $price = 3000000;
        }
        else if($distance <= 2000) {
            $price = 6000000;
        }
        else if($distance <= 5000) {
            $price = 20000000;
        }
        else {
            $price = 30000000;
        }

        // ràng buộc khi tạo chuyến bay
        $day_1 = $res->departure;
        $day_2 = date('Y-m-d') ; //current date
        // tính số ngày trước chuyến bay                         
        $day = (strtotime($day_1) - strtotime($day_2)) / (60 * 60 * 24);
        if($day >= 90){
            $price =  $price;
       }
       else if ($day >= 60){
        $price =  $price + ($price * 0.05);
       }
       else if ($day <= 30) {
            $flight  = Cities::all();
            $airline = Airways::all();
            $mess = "Không được phép tạo chuyến bay cách giờ bay 1 tháng!";
            return view('front-end.add-flight', ['flight' => $flight, 'airline' => $airline, 'mess' => $mess]);
       }

        $flight->flight_price     = $price;
        $flight->flight_parent_id = $res->transit;
        $flight->save();

        return redirect('getAddFlight')->with('status', 'Tạo chuyến bay thành công hihi!');      
    }


}
