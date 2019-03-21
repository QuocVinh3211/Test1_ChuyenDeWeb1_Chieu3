@extends('front-end.masterpage.master')
@section('content')
<main>
     <?php
     $total = 1;
     $flight_class = "keka";
     $time_from   = "20/10/1998";
        foreach ($flight as $row) {
            // cắt ngày giờ:
            $date = $row->flight_time_from;
            $d    = strtotime($date);
            $date_to = $row->flight_time_to;
            $d2    = strtotime($date_to);

     ?>
        <div class="container">
            <section>
                <h2> {{ $data['get_city_from']->city_name . " (" . $data['get_city_from']->city_code . ")" }}  <i class="glyphicon glyphicon-arrow-right"></i> {{ $data['get_city_to']->city_name . " (" . $data['get_city_to']->city_code . ")" }} </h2>
                <article>
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-12">
                                
                                        <h4><strong><a href="flight-detail.html">{{ $data['get_airline']->airways_name }} </a></strong></h4>
                                    <div class="row">
                                    


                                        <div class="col-sm-3">
                                            <label class="control-label">From:</label>
                                            <div><big class="time"><?php echo date("h:i", $d); ?></big></div>
                                            <div><span class="place">{{ $data['get_city_from']->city_name . " (" . $data['get_city_from']->city_code . ")" }} </span></div>
                                        </div>
                                        <div class="col-sm-3">
                                            <label class="control-label">To:</label>
                                            <div><big class="time"><?php echo date("h:i", $d2); ?></big></div>
                                            <div><span class="place">{{ $data['get_city_to']->city_name . " (" . $data['get_city_to']->city_code . ")" }} </span></div>
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
                                            <div><strong class="text-danger">1 Transit</strong></div>
                                        </div>
                                        <div class="col-sm-3 text-right">
                                            <h3 class="price text-danger"><strong><?php echo number_format($row->flight_price) ?> VNĐ</strong></h3>
                                            <div>
                                           
                                            </div>
                                        </div>
                                    </div>
                                    <ul class="nav nav-tabs">
                                        <li class="active"><a data-toggle="tab" href="#flight-detail-tab">Flight Details</a></li>
                                        <li><a data-toggle="tab" href="#flight-price-tab">Price Details</a></li>
                                        <li><a data-toggle="tab" href="#flight-passenger-tab">Passenger</a></li>
                                    </ul>
                                    <div class="tab-content">
                                        <div id="flight-detail-tab" class="tab-pane fade in active">
                                            <ul class="list-group">
                                                <li class="list-group-item">
                                                    <h5>
                                                        <strong class="airline"><?php echo $row->airways_id ?> Airways QR-957</strong>
                                                        <p><span class="flight-class"><?php echo $flight_class ?></span></p>
                                                    </h5>
                                                    <div class="row">
                                                        <div class="col-sm-4">
                                                            <div class="row">
                                                                <div class="col-sm-4">
                                                                    <div><big class="time"><?php echo date("h:i", $d); ?></big></div>
                                                                    <div><small class="date"><?php echo $time_from ?></small></div>
                                                                </div>
                                                                <div class="col-sm-6">
                                                                    <div><span class="place">{{ $data['get_city_from']->city_name . " (" . $data['get_city_from']->city_code . ")" }} </span></div>
                                                                    <div><small class="airport">Airport</small></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-1">
                                                            <i class="glyphicon glyphicon-arrow-right"></i>
                                                        </div>
                                                        <div class="col-sm-4">
                                                            <div class="row">
                                                                <div class="col-sm-4">
                                                                    <div><big class="time"><?php echo date("h:i", $d2); ?></big></div>
                                                                    <div><small class="date"><?php echo $time_from ?></small></div>
                                                                </div>
                                                                <div class="col-sm-6">
                                                                    <div><span class="place">{{ $data['get_city_to']->city_name . " (" . $data['get_city_to']->city_code . ")" }} </span></div>
                                                                    <div><small class="airport"> Airport</small></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-3 text-right">
                                                            <label class="control-label">Duration:</label>
                                                            <div><strong class="time"><?php echo $hours." h ".$minutes." m"; ?></strong></div>
                                                        </div>
                                                    </div>
                                                </li>
                                               
                                                <!-- <li class="list-group-item list-group-item-warning">
                                                
                                                    <ul>
                                                        <li>Transit for 1h 30m in Doha (DOH)</li>
                                                    </ul>
                                                </li> -->
                                              <!--   <li class="list-group-item">
                                                    <h5>
                                                        <strong class="airline">Qatar Airways QR-1052</strong>
                                                        <p><span class="flight-class">Economy</span></p>
                                                    </h5>
                                                    <div class="row">
                                                        <div class="col-sm-4">
                                                            <div class="row">
                                                                <div class="col-sm-4">
                                                                    <div><big class="time">00:50</big></div>
                                                                    <div><small class="date">30 Apr 2017</small></div>
                                                                </div>
                                                                <div class="col-sm-6">
                                                                    <div><span class="place">Doha (DOH)</span></div>
                                                                    <div><small class="airport">Doha Hamad International Airport</small></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-1">
                                                            <i class="glyphicon glyphicon-arrow-right"></i>
                                                        </div>
                                                        <div class="col-sm-4">
                                                            <div class="row">
                                                                <div class="col-sm-4">
                                                                    <div><big class="time">02:55</big></div>
                                                                    <div><small class="date">30 Apr 2017</small></div>
                                                                </div>
                                                                <div class="col-sm-6">
                                                                    <div><span class="place">Abu Dhabi (AUH)</span></div>
                                                                    <div><small class="airport">Abu Dhabi Intl</small></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-3 text-right">
                                                            <label class="control-label">Duration:</label>
                                                            <div><strong class="time">2h 5m</strong></div>
                                                        </div>
                                                    </div>
                                                </li> -->
                                            </ul>
                                        </div>
                                        <div id="flight-price-tab" class="tab-pane fade">
                                            <h5>
                                                <strong class="airline"><?php echo $row->airways_id ?></strong>
                                                <p><span class="flight-class"><?php echo $flight_class ?></span></p>
                                            </h5>
                                            <ul class="list-group">
                                                <li class="list-group-item">
                                                    <div class="pull-left">
                                                        <strong>Passengers Fare (x<?php echo $total ?>)</strong>
                                                    </div>
                                                    <div class="pull-right">
                                                        <strong> tiền </strong>
                                                    </div>
                                                    <div class="clearfix"></div>
                                                </li>
                                                <li class="list-group-item">
                                                    <div class="pull-left">
                                                        <span>Tax</span>
                                                    </div>
                                                    <div class="pull-right">
                                                        <span>Included</span>
                                                    </div>
                                                    <div class="clearfix"></div>
                                                </li>
                                                <li class="list-group-item list-group-item-info">
                                                    <div class="pull-left">
                                                        <strong>You Pay</strong>
                                                    </div>
                                                    <div class="pull-right">
                                                        <strong>IDR <?php echo ($row->flight_price*$total) ?></strong>
                                                    </div>
                                                    <div class="clearfix"></div>
                                                </li>
                                            </ul>
                                        </div>

                                        <!-- hiển thị passenger -->
                                        <div id="flight-passenger-tab" class="tab-pane fade">
                                            <ul class="list-group">
                                                <li class="list-group-item">
                                                    <div class="pull-left">
                                                        <strong>Passengers Fare (x<?php echo $total ?>)</strong>
                                                    </div>
                                                    <div class="clearfix"></div>
                                                </li>
                                                @foreach($passenger as $row)
                                                <li class="list-group-item list-group-item-info">
                                                
                                                    <div class="pull-left">
                                                        <strong> {{ $row->passenger_title . " " .  $row->passenger_first_name . " " . $row->passenger_last_name }} </strong>
                                                    </div>
                                                    <div class="pull-right">
                                                        <strong> <a href="{{ URL::route('getPassenger',  $row->passenger_id) }}"> <i class='fas fa-edit' style='font-size:18px;color:red'></i> Edit </a> </strong>
                                                    </div>
                                                    <div class="clearfix"></div>
                                                
                                                </li>
                                                @endforeach
                                            </ul>
                                        </div>

                                        <!-- // passenger -->

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </article>
            </section>
        </div>
        <?php } ?>
    </main>
  @endsection