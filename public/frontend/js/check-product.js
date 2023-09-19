$(document).ready(function(){
    $.ajaxSetup({
        headers : {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    
    $('#verify-product').on('submit', function(e){
        
        e.preventDefault();
        $this = $(this);
        $('.message-box').empty();
        $('#standard-modal').find('.message-box').removeClass('message-box red').addClass('message-box green');
        $.ajax({
            type : "POST",
            url : checkproduct,
            data : $("#verify-product").serialize(),
            cache : false,
            async : false,

           success : function(result){
                
                if(result.status == true){
                    $this[0].reset();
                    grecaptcha.reset();
                    if(result.checktime == "first"){
                        var html = `<p>Your product is <span>legit</span> </p>`;
                        $('.message-box').append(html);
                        $('#standard-modal').modal('show');
                    }else if(result.checktime == "second"){
                        var checkdate = moment(result.data.code_checked_on).format('D.M.Y h.mm A');
                        var html = `<p>Your product is <span>legit</span> and has been checked on ${checkdate} </p>`;
                        $('.message-box').append(html);
                        $('#standard-modal').modal('show');
                    }
                    else if(result.data == 'notfound'){

                    var html = `<p>Your product is <span>not legit</span> </p>`;
                    $('#standard-modal').find('.message-box').removeClass('message-box green').addClass('message-box red');
                    $('.message-box').append(html);
                    $('#standard-modal').modal('show');
                    }
                }
                else{
                    grecaptcha.reset();
                    var errorMessage = "";
                    $.each(result.error, function(key, value){
                        errorMessage += value +"<br>"; 
                    })
                    $.NotificationApp.send(
                        "These filed required!",
                        errorMessage,
                        "top-right",
                        "rgba(0,0,0,0.2)",
                        "error"
                    );
                    
                }
           },
        });
    });

});