function changeAirLine(){
    $from_city_id = $("#from").val();

    alert(from_city_id);
    // $.post("url", from_city_id,
    //     function (data, textStatus, jqXHR) {
            
    //     },
    //     "dataType"
    // );
}


function XacNhanXoa(msg)
{
	if(window.confirm(msg))
	{
		return true;
	}
	return false;
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
    var time_return    = $('#return').val();
    var addR           = $('#date_return').val();
    
    var re             = new Date(time_return);
    var date           = new Date(time_departure);
    var d              = new Date();
    var addRe          = new Date(addR);

    // lấy ngày, tháng năm để so sánh ( lấy từ 0 - 30 đối với ngày...)
    if(date.getDate() < d.getDate() || date.getMonth() < d.getMonth() || date.getFullYear() < d.getFullYear())
    {
        alert("Ngày khởi hành phải lớn hơn hoặc bằng ngày hiện tại, xin chọn lại!");           
        return false;
    }
    else if(re.getDate() < d.getDate() || re.getMonth() < d.getMonth() || re.getFullYear() < d.getFullYear())
    {
        alert("Ngày khứ hồi phải lớn hơn hoặc bằng ngày đi, xin chọn lại!");           
        return false;
    }
    else if(addRe.getDate() < date.getDate() || addRe.getMonth() < date.getMonth() || addRe.getFullYear() < date.getFullYear())
    {
        alert("Ngày đến phải lớn hơn hoặc bằng ngày đi, xin chọn lại!");           
        return false;
    }
    else
    {                            
        return true;
    }          
}


// chọn 2 vé
function BookFunction() {
    
    var x = document.getElementById("choose").value;
    
    var y = $( "input" ).data("flightID");
    var active = $( "input" ).data("active");


    if(x == "Choose")
    {
        document.getElementById("choose").innerHTML = "Delay";
        document.getElementById("choose").style.backgroundColor = "red";
        y = 1;
    }
    else {
        document.getElementById("choose").innerHTML = "Choose";
        document.getElementById("choose").style.backgroundColor = "#337ab7";
    }
    
}

(function ($) {
    $(document).ready(function(){
  
      $("#edit-time-start").on("change paste keyup", function() {
        alert($(this).val()); 
      });
  
    });
  })(jQuery);

// payment 
function payment() {
    var x = document.getElementById("payment").value;
    if(x == "credit_card"){
        document.getElementById("info_card").style.display = "block";
    }
    else {
        document.getElementById("info_card").style.display = "none";
    }
}