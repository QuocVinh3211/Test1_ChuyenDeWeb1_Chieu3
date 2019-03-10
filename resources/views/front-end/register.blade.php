@extends('front-end.masterpage.master')
@section('content')

<main>
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-md-push-3">
                    <h2>Join as a Wordskills Travel Member</h2>
                    <div class="panel panel-default">
                        <div class="panel-body">
                        <!-- //onsubmit="return validateForm();" -->
                        <form method="POST" action="{{ route('register') }}">
                            @csrf
                            <div class="form-group">
                                    <label class="control-label">{{ __('Name') }}:</label>
                                    <div class="">
                                    <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus>

                                        @if ($errors->has('name'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('name') }}</strong>
                                            </span>
                                        @endif
                                        <span class="help-block"></span>
                                    </div>

                                </div>
                                <div class="form-group">
                                <div> 
                                    <label class="control-label">{{ __('E-Mail Address') }}:</label>
                                    <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>

                                        @if ($errors->has('email'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('email') }}</strong>
                                            </span>
                                        @endif
                                    <span class="help-block"></span>
                                </div>
                                </div>
                                <div class="form-group">
                                <div>
                                    <label class="control-label">{{ __('Password') }}:</label>
                                    <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                                        @if ($errors->has('password'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('password') }}</strong>
                                            </span>
                                        @endif
                                     <span class="help-block"></span>
                                </div>
                                </div>
                                 <div class="form-group">
                                    <label class="control-label">{{ __('Confirm Password') }}:</label>
                                    <div class="">
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                                        <span class="help-block"></span>
                                     </div>
                                </div>
                                <!-- <div class="form-group">
                                    <div class=""> 
                                        <label class="control-label">Phone Number:</label>
                                        <input type="tel" name="phone" id="phone" class="form-control" placeholder="Enter your phone number" onkeyup="validatePhone()">
                                         <span class="help-block"></span>
                                    </div>
                                </div> -->
                                <div class="text-right">
                                    <button type="submit" name="btn_submit" class="btn btn-primary">{{ __('Register') }}</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection