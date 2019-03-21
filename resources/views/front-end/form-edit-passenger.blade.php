@extends('front-end.masterpage.master')
@section('content')
    <main>
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-md-push-3">
                    <h2>Edit Passenger</h2>
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <form role="form" action="{{ route('postEditPassenger') }}" method="post">
                            <!-- hiển thị thông báo sửa thành công -->
                            @if (session('status'))
                                <div class="alert alert-success">
                                    {{ session('status') }}
                                </div>
                            @endif
                            <input type="hidden" name="passenger_id" class="form-control" value="{{ $passenger->passenger_id }}">
                            @csrf
                                <div class="form-group">
                                <label class="control-label">Title:</label>
                                <select class="form-control" name='passenger_title'>
                                    <option value="Mr">Mr.</option>
                                    <option value="Ms">Mrs.</option>
                                </select>
                                </div>
                                <div class="form-group">
                                    <label class="control-label">First Name:</label>
                                    <input type="text" class="form-control" name ="firstName" value="{{ $passenger->passenger_first_name }}" placeholder="Enter your name">
                                </div>
                                <div class="form-group">
                                    <label class="control-label">Last Name:</label>
                                    <input type="tel" class="form-control" name ="lastName" value="{{ $passenger->passenger_last_name }}" placeholder="Enter your phone number">
                                </div>
                                <div class="text-right">
                                    <button type="submit" class="btn btn-primary">Edit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    @endsection