@extends('front-end.masterpage.master')
@section('content')
<main>
        <div class="container">
            <section>
                <h3>Add Flight</h3>              
                @if(isset($mess))
                    <p class="alert"> {{$mess}}  </p>
                @endif              
                <div class="panel panel-default">
                    <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                        <form role="form" method="POST" action="{{ route('postFlight') }}" onsubmit="return validateForm_2();" >
                      @csrf
                            <div class="row">
                                <div class="col-sm-4">
                                    <h4 class="form-heading">1. Flight Destination</h4>
                                    <div class="form-group">
                                        <label class="control-label">From: </label>
										<select class="form-control" name="from" id="from" onchange="changeAirLine()">
                                        <?php 
                                            foreach ($flight as $row) {
                                         ?>
											<option value="<?php echo $row->city_id  ?>"> <?php echo $row->city_name . " (". $row['city_code'].")"  ?>
                                                     
                                            </option>
										<?php } ?>
										</select>                                       
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label">To: </label>
                                        <select class="form-control" name="to" id="to">
											 <?php 
                                            foreach ($flight as $row) {
                                         ?>
                                            <option value="<?php echo $row->city_id  ?>"> <?php echo $row->city_name . " (". $row['city_code'].")"  ?>
                                                     
                                            </option>
                                        <?php } ?>
										</select>       
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label">Distance (Km): </label>
                                        <input  type="text" name="km" id="distance" class="form-control" placeholder="please enter distance (km)" >
										    
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <h4 class="form-heading">2. Date of Flight</h4>
                                    <div class="form-group">
                                        <label class="control-label">Departure: </label>
                                         <?php $date_now = date('Y-m-d\TH:i');
                                          ?>
                                        <input  type="datetime-local" name="departure" id="departure" value="<?php echo $date_now ?>" class="form-control"  class="datepicker">
                                    </div>
                            
                                    <div class="form-group" id="hide">
                                        <label class="control-label">Arrival date: </label>
                                        <input type="datetime-local" name="return" id="date_return" value="<?php echo $date_now?>" class="form-control">
                                    </div>

                                </div>
                                <div class="col-sm-4">
                                    <h4 class="form-heading">3. Airline</h4>
                                    <div class="form-group">
                                        <label class="control-label">Airline Name: </label>
                                        <select name="airline" class="form-control">
                                            @foreach($airline as $row)
                                                <option value="{{ $row->airways_id }}"> {{ $row->airways_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label">Transit: </label>
                                        <select name="transit" class="form-control">

                                            <option value="0">0</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                           
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" name="btn_submit" class="btn btn-primary btn-block">Add Flights</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </section>
        </div>
</main>
@endsection