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