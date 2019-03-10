@extends('front-end.masterpage.master')
@section('content')

<main>
        <div class="container">
            <section>
                <h3>Flight Booking</h3>
                <div class="panel panel-default">
                    <div class="panel-body">
                        <form role="form" action="{{ route('search') }}" onsubmit="return validateForm();" >
                      
                            <div class="row">
                                <div class="col-sm-4">
                                    <h4 class="form-heading">1. Flight Destination</h4>
                                    <div class="form-group">
                                        <label class="control-label">From: </label>
										<select class="form-control" name="from" id="from">
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
                                </div>
                                <div class="col-sm-4">
                                    <h4 class="form-heading">2. Date of Flight</h4>
                                    <div class="form-group">
                                        <label class="control-label">Departure: </label>
                                         <?php $date_now = date('Y-m-d'); ?>
                                        <input  type="date" name="departure" id="departure" value="<?php echo $date_now ?>" class="form-control"  class="datepicker">
                                    </div>
                                    <div class="form-group">
                                        <div class="radio">
                                            <label><input type="radio" id="one" name="flight_type" checked value="one-way"onclick="if(this.checked){myFunction1()}">One Way</label>
                                            <label>
                                              <input type="radio" id="re" name="flight_type" value="return" onclick="if(this.checked){myFunction()}">Return
                                            </label>
                                        </div>
                                    </div> 


                                    <div class="form-group" id="hide" style="display: none;">
                                        <label class="control-label">Return: </label>
                                        <input type="date" id="return" name="return" id="return" class="form-control" placeholder="Choose Return Date">
                                    </div>

                                </div>
                                <div class="col-sm-4">
                                    <h4 class="form-heading">3. Search Flights</h4>
                                    <div class="form-group">
                                        <label class="control-label">Total Person: </label>
                                        <select name="total" class="form-control">
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                            <option value="6">6</option>
                                            <option value="7">7</option>
                                            <option value="8">8</option>
                                            <option value="9">9</option>
                                            <option value="10">10</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label">Flight Class: </label>
                                        <select name="flight_class" class="form-control">
                                            <option value="Economy">Economy</option>
                                            <option value="Business">Business</option>
                                            <option value="Premium-Economy">Premium Economy</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" name="btn_submit" class="btn btn-primary btn-block">Search Flights</button>
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