@extends('front-end.masterpage.master')
@section('content')

<?php
    $total = $_GET['total'];
    $flight_class = $_GET['flight_class'];
    $time_from = $_GET['departure'];
 ?>

<!-- hiển thị thông báo lỗi -->
@if( count($errors) > 0)
	<div class="alert">
		<ul>
			@foreach($errors->all() as $error)
			    <li>{{ $error }}</li>
			@endforeach
		</ul>
	</div>
@endif
    <main> 
       <form role="form" method="get" action="{{ route('booking') }}">
       <input name="flight_class" type="hidden" value="{{ $flight_class }}">
       <input name="total" type="hidden" value="{{ $total }}">
       <div class="container">
                <section>
                    <h2> Danh sách các chuyến bay chiều đi  <i class="glyphicon glyphicon-arrow-right"></i> </h2>
                @foreach($flight_to as $row)

                    <article>
                        <div class="panel panel-default">
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-md-12">
                                    <?php
                                        // hien thi hang hang khogn theo id
                                        $id_air = $row->airways_id;
                                        $airway_name = DB::table('airways')->where('airways_id', '=', $id_air)->first();
                                     ?>
                                        <h4><strong><a href="flight-detail.html"> {{ $airway_name->airways_name  }} </a></strong></h4>
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <label class="control-label">From:</label>
                                                <?php
                                                    $date = $row->flight_time_from;
                                                    $d    = strtotime($date);
                                                    $date_to = $row->flight_time_to;
                                                    $d2    = strtotime($date_to);

                                                    // hien thi ten thanh pho theo id
                                                    $id = $row->flight_city_from_id;
                                                    $city = DB::table('list_cities')->where('city_id', '=', $id)->first();
                                                    $id_to = $row->flight_city_to_id;
                                                    $city_to = DB::table('list_cities')->where('city_id', '=', $id_to)->first();
                                                 ?>
                                                <div><big class="time"> <?php echo date("h:i", $d);  ?> </big></div>
                                                <div><span class="place"> {{ $city->city_name . " (" . $city->city_code . ")" }}    </span></div>
                                            </div>
                                            <div class="col-sm-3">
                                                <label class="control-label">To:</label>
                                                <div><big class="time"> <?php echo date("h:i", $d2);  ?> </big></div>

                                
                                                <div><span class="place">{{ $city_to->city_name . " (" . $city_to->city_code . ")" }}</span></div>
                                            </div>
                                            <div class="col-sm-3">
                                                <label class="control-label">Duration:</label>
                                                <div><big class="time">
                                                <?php

                                                 $date1 = $row->flight_time_from;
                                                 $date2 = $row->flight_time_to;
                                                 $diff = abs(strtotime($date2) - strtotime($date1));
                                                 $years = floor($diff / (365*60*60*24));
                                                 $months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
                                                 $days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24) / (60*60*24));
                                                 $hours = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24 - $days*60*60*24) / (60*60));
                                                 $minutes = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24 - $days*60*60*24 - $hours*60*60) / 60);

                                                  echo $hours." h ".$minutes." m";
                                                 ?> 
                                                </big></div>
                                                <div><strong class="text-danger"> Transit</strong></div>
                                            </div>
                                            <div class="col-sm-3 text-right">
                                                <h3 class="price text-danger"><strong>IDR <?php echo $row->flight_price  ?></strong></h3>
                                                <div>
                                                <a href="{{ asset('flight-detail/'.$row->flight_id.'/'.$total.'/'.$flight_class.'/'.$time_from) }}" class="btn btn-link">See Detail</a>
                                                    <input id="rad_depature" name="flight_depature" value="{{ $row->flight_id }}"  type="radio" {{ old('flight_depature') == $row->flight_id ? 'checked' : ''}}  >
                                                    
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- <a href="" class="btn btn-primary">Choose</a> -->
                            <!-- {{ asset('flight-booking/'.$row->flight_id.'/'.$total.'/'.$flight_class.'/'.$time_from) }} -->
                        </div>
                    </article>
                @endforeach
                    <div class="text-center">
                        <ul class="pagination">
                            <li><a href="#">&laquo;</a></li>
                            <li><a href="#">&lsaquo;</a></li>
                            <li class="active"><a href="#">1</a></li>
                            <li><a href="#">2</a></li>
                            <li><a href="#">3</a></li>
                            <li><a href="#">4</a></li>
                            <li><a href="#">&rsaquo;</a></li>
                            <li><a href="#">&raquo;</a></li>
                        </ul>
                    </div>
                </section>
        </div>
    

    @if($flight_return != "")
    <div class="container">
                <section>
                    <h2> Danh sách các chuyến bay chiều về  <i class="glyphicon glyphicon-arrow-right"></i> </h2>
                @foreach($flight_return as $row)
                    <article>
                        <div class="panel panel-default">
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-md-12">
                                    <?php
                                        // hien thi hang hang khogn theo id
                                        $id_air = $row->airways_id;
                                        $airway_name = DB::table('airways')->where('airways_id', '=', $id_air)->first();
                                     ?>
                                        <h4><strong><a href="flight-detail.html"> {{ $airway_name->airways_name  }} </a></strong></h4>
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <label class="control-label">From:</label>
                                                <?php
                                                    $date = $row->flight_time_from;
                                                    $d    = strtotime($date);
                                                    $date_to = $row->flight_time_to;
                                                    $d2    = strtotime($date_to);

                                                    // hien thi ten thanh pho theo id
                                                    $id = $row->flight_city_from_id;
                                                    $city = DB::table('list_cities')->where('city_id', '=', $id)->first();
                                                    $id_to = $row->flight_city_to_id;
                                                    $city_to = DB::table('list_cities')->where('city_id', '=', $id_to)->first();
                                                 ?>
                                                <div><big class="time"> <?php echo date("h:i", $d);  ?> </big></div>
                                                <div><span class="place"> {{ $city->city_name . " (" . $city->city_code . ")" }}    </span></div>
                                            </div>
                                            <div class="col-sm-3">
                                                <label class="control-label">To:</label>
                                                <div><big class="time"> <?php echo date("h:i", $d2);  ?> </big></div>

                                
                                                <div><span class="place">{{ $city_to->city_name . " (" . $city_to->city_code . ")" }}</span></div>
                                            </div>
                                            <div class="col-sm-3">
                                                <label class="control-label">Duration:</label>
                                                <div><big class="time">
                                                <?php

                                                 $date1 = $row->flight_time_from;
                                                 $date2 = $row->flight_time_to;
                                                 $diff = abs(strtotime($date2) - strtotime($date1));
                                                 $years = floor($diff / (365*60*60*24));
                                                 $months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
                                                 $days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24) / (60*60*24));
                                                 $hours = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24 - $days*60*60*24) / (60*60));
                                                 $minutes = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24 - $days*60*60*24 - $hours*60*60) / 60);

                                                  echo $hours." h ".$minutes." m";
                                                 ?> 
                                                </big></div>
                                                <div><strong class="text-danger"> Transit</strong></div>
                                            </div>
                                            <div class="col-sm-3 text-right">
                                                <h3 class="price text-danger"><strong>IDR <?php echo $row->flight_price  ?></strong></h3>
                                                <div>
                                                <a href="{{ asset('flight-detail/'.$row->flight_id.'/'.$total.'/'.$flight_class.'/'.$time_from) }}" class="btn btn-link">See Detail</a>
                                                <!-- <a href="#" id="choose" onclick="BookFunction()" class="btn btn-primary">Choose</a> -->
                                                    <input id="rad_return" name="flight_return" value="{{ $row->flight_id }}" data-active = 1  type="radio" type="radio" {{ old('flight_return') == $row->flight_id ? 'checked' : ''}}>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- <a href="" class="btn btn-primary">Choose</a> -->
                            <!-- {{ asset('flight-booking/'.$row->flight_id.'/'.$total.'/'.$flight_class.'/'.$time_from) }} -->
                        </div>
                    </article>
                @endforeach
                    <div class="text-center">
                        <ul class="pagination">
                            <li><a href="#">&laquo;</a></li>
                            <li><a href="#">&lsaquo;</a></li>
                            <li class="active"><a href="#">1</a></li>
                            <li><a href="#">2</a></li>
                            <li><a href="#">3</a></li>
                            <li><a href="#">4</a></li>
                            <li><a href="#">&rsaquo;</a></li>
                            <li><a href="#">&raquo;</a></li>
                        </ul>
                    </div>
                </section>
        </div>
    @else
        <input type="hidden" name="flight_return" value="0" >
    @endif
   
    <div class="btn-submit">
        <button type="submit" class="btn btn-primary"> Đặt vé </button>
    </div>
 </form>
    </main>
  @endsection
