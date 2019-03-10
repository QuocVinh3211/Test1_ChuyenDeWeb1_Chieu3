<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Flights - Worldskills Travel</title>
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('public/assets/bootstrap/css/bootstrap.css')}}">
  
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('public/assets/style.css')}}">

    <style>
        .invalid-feedback {
            color: red;
        }

        .btn-submit {
            padding-left: 1150px ;
        }

        .info_card {
            display: none;
        }

        .alert {
            color: red;
        }
    </style>


<script type="text/javascript">

(function() {
  var datepicker = $('input.datepicker');

  if (datepicker.length > 0) {
    datepicker.datepicker({
      format: "mm/dd/yyyy",
      startDate: new Date()
    });
  }
});
    // payment 
    function displayCard() {
    var x = document.getElementById("payment").value;
    if(x == "credit_card") {
        document.getElementById("info_card").style.display = "block";
    }
    else {
        document.getElementById("info_card").style.display = "none";
    }
    }


    function BookFunction1() {
    
    var checkbox =  document.getElementsByName("BlockInBound");
    for (var i = 0; i < checkbox.length; i++){
        if (checkbox[i].checked === true){
            document.getElementById("btn_choose").innerHTML = "Delay";
            document.getElementById("btn_choose").style.backgroundColor = "red";
            document.getElementById("choose").style.backgroundColor = "red";
        }
    }

    }


function change() {
    document.getElementById("firstName").value=""; 
    document.getElementById("lastName").value=""; 
    document.getElementById("phone").value=""; 
    document.getElementById("email").value=""; 
}

Date.prototype.today = function () { 
    return ((this.getDate() < 10)?"0":"") + this.getDate() +"-"+(((this.getMonth()+1) < 10)?"0":"") + (this.getMonth()+1) +"-"+ this.getFullYear();
}

// ẩn hiện 1 thẻ html
function myFunction() {
    
    document.getElementById("hide").style.display = "block";
    var newDate = new Date();
    var datetime = newDate.today();
    //var str = datetime.toDateString("yyyy-MM-dd");
    var str = "2019-03-06";

    document.getElementById("return").value = str;
}
function myFunction1() {
    document.getElementById("hide").style.display = "none";
    document.getElementById("return").value = "";
}

// validate
 function validateForm() {
    //& validateTime()
        if (validateCity() & validateTime()) {
            return true;
        }
        else {
            return false;
        }
    }

function validateCity() {
        var form = $('#from').val();
        var to = $('#to').val();

        if(form == to)
        {
          alert("Điểm khởi hành phải khác điểm đến, xin chọn lại!");         
          return false;
        }
        else
        {
            return true;
        }          
    }
    //departure
    function validateTime() {
        var time_departure = $('#departure').val();
        var time_return = $('#return').val();

        var re = new Date(time_return);

        var date = new Date(time_departure);
        var d = new Date();

        // lấy ngày, tháng năm để so sánh ( lấy từ 0 - 30 đối với ngày...)
        if(date.getDate() < d.getDate() || date.getMonth() < d.getMonth() || date.getFullYear() < d.getFullYear())
        {
            alert("Ngày khởi hành phải lớn hơn hoặc bằng ngày hiện tại, xin chọn lại!");           
            return false;
        }
        else if(re.getDate() < d.getDate() || re.getMonth() < d.getMonth() || re.getFullYear() < d.getFullYear())
        {
            alert("Ngày khứ hồi phải lớn hơn hoặc bằng ngày hiện tại, xin chọn lại!");           
            return false;
        }
        else
        {                            
            return true;
        }          
    }
</script>
   
</head>
<body>
<div class="wrapper">
    <header>
        <nav class="navbar-default navbar-static-top">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#main-navbar">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a href="{{ route('home') }}" class="navbar-brand">Worldskills Travel</a>
                </div>
                <div class="collapse navbar-collapse" id="main-navbar">
                    <ul class="nav navbar-nav navbar-right">
                         <!-- Authentication Links -->
                        
                         @guest
                         <li><a href="">Welcom message</a></li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    Welcome {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                        <li><a href="{{ url('/') }}">Flights</a></li>
                       <?php
                            if(Auth::check())
                            {                            
                        ?>
                            <li><a href="{{ url('getEdit') }}">Profile</a></li>
                            <?php } ?>
                       
                    </ul>
                </div>
            </div>
        </nav>
    </header>