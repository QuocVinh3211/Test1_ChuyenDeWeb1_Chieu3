@extends('front-end.masterpage.master')
@section('content')
<main>
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-md-push-3">
                    <h2>Welcom {{ Auth::user()->name }}</h2>
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <form action="{{ asset('/postEdit') }}" method="POST" >
                            @csrf
                                <div class="form-group">
                                    <label class="control-label">Email</label>
                                    <div class="">
                                        <input type="text"  name="email" class="form-control" placeholder="Enter your name" value="{{ Auth::user()->email }}">
                                        <span class="help-block"></span>
                                    </div>

                                </div>
                                                    
                                <div class="form-group">
                                    <label class="control-label">Name:</label>
                                    <div class="">
                                        <input type="text" id="fullname" name="name" class="form-control" placeholder="Enter your name" value="{{ Auth::user()->name }}">
                                        <span class="help-block"></span>
                                    </div>

                                </div>
                                    <div class="form-group">
                                    <label class="control-label">Password:</label>
                                    <input type="password" id="password" name="password" class="form-control" placeholder="Enter your password">
                                     <span class="help-block"></span>
                                </div>    
                                <div class="form-group">
                                    <label class="control-label">Phone Number:</label>
                                    <input type="tel" name="phone" id="phone" class="form-control" placeholder="Enter your phone number" value="{{ Auth::user()->user_phone }}">
                                </div>
                                 <div class="form-group">
                                    <label class="control-label">Gender:</label>
                                    <select name="gender" class="form-control">
                                            <option value="1">Male</option>
                                            <option value="2">FeMale</option>                                
                                        </select>
                                </div>
                                  <div class="form-group">
                                    <label class="control-label">Bird:</label>
                                    <input type="date"  name="bird" id="date" class="form-control" placeholder="Enter your phone number" value="{{ Auth::user()->user_bird }}">
                                </div>

                                 <div class="form-group">                                                                                                                                                                                                                                                                                                                                                                                                               
                                    <label class="control-label">Adress:</label>
                                    <input type="tel" name="address" id="adress" class="form-control" placeholder="Enter your adress" value="{{ Auth::user()->adress }}">
                                </div>
                                
                                <div class="text-right">
                                    <button type="submit" class="btn btn-primary">Update</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

@endsection