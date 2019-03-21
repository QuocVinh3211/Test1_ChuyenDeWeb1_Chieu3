// validate
function validateForm_2() {
    //& validateTime()
        if (validateCity() & validateTime() & validateKm()) {
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
    // validate số km
    function validateKm() {
        var distance = $('#distance').val();

        if((distance === ''))
        {
            alert("Khoảng cách không được để trống");         
            return false;
        }
        else if(isNaN(distance) == true)
        {
            alert("Nhập khoảng cách không hợp lệ, vui lòng nhập lại");         
            return false;
        }

        else if(distance <= 0) {
            alert("Nhập khoảng cách phải lớn hơn 0");         
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
