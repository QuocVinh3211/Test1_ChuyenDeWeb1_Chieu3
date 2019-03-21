@extends('front-end.masterpage.master')
@section('content')

@if($data == null)
    <h2 class="alert alert-success">
        Chưa có chuyến bay nào 
    </h2>
@endif

 <!-- thông báo xóa thành công -->
@if (session('status'))
     <div class="alert alert-success">
        {{ session('status') }}
    </div>
@endif

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
       <div class="container">
     
       @foreach($flight as $row)
       @csrf
                <section>
                    <h2> {{ $data['get_city_from']->city_name . "(" . $data['get_city_from']->city_code . ")"  }}  <i class="glyphicon glyphicon-arrow-right"></i> 
                    {{ $data['get_city_to']->city_name . "(" . $data['get_city_to']->city_code . ")" }}</h2>
           
                    <article>
                        <div class="panel panel-default">
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <h4><strong><a href="flight-detail.html"> {{ $row->airways_name }} </a></strong></h4>
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <label class="control-label">From:</label>
                                                <?php
                                                    $date = $row->flight_time_from;
                                                    $d    = strtotime($date);
                                                    $date_to = $row->flight_time_to;
                                                    $d2    = strtotime($date_to);
                                                 ?>
                                                <div><big class="time"> <?php echo date("h:i", $d);  ?> </big></div>
                                                <div><span class="place"> {{ $data['get_city_from']->city_name . "(" . $data['get_city_from']->city_code . ")"  }}    </span></div>
                                            </div>
                                            <div class="col-sm-3">
                                                <label class="control-label">To:</label>
                                                <div><big class="time"> <?php echo date("h:i", $d2);  ?> </big></div>

                                
                                                <div><span class="place">{{ $data['get_city_to']->city_name . "(" . $data['get_city_to']->city_code . ")" }}</span></div>
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
                                            <!-- tính giá tiền theo ngày đặt vé -->
                          
                                                <h3 class="price text-danger"><strong><?php echo number_format($row->total_price);   ?> VNĐ</strong></h3>
                 
                                                <div>
                                                <a href="{{ route('getDetailBook') }}" class="btn btn-link">See Detail</a>
                                                <a onclick=" return window.confirm('Bạn có chắc muốn hủy chuyến bay không?'); "
                                                 href="{{ URL::route('deleteBooked', $row->booking_id) }}">
                                                <div class="btn btn-danger btn-mini">Delete</div></a>
                                     
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
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
    </main>
  @endsection
