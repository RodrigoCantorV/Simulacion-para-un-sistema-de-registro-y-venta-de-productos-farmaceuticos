if(response != error)
{
    var info = JSON.parse(response);
    if(info.cod == '00')
    {
        $('.alertChangePass').html('<p style="color:green;">'+info.msg+'</p>');
        $('#frmChangePass')[0].reset();
    }else{
      $('.alertChangePass').html('<p style="color:red;">'+info.msg+'</p>');
    }
    $('.alertChangePass').slideDown(); 
}