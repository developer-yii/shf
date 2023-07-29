$(document).ready(function() 
{
    getNotification();

    $.ajaxSetup({
        headers : {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    
    function markMessagesAsRead() 
    {    
        var chatIdArray = [];
        var msgId='';
        $('.conversation-list .font-weight-bold').each(function() 
        {        
            var chatId = $(this).attr('data_id');
            //var senderId = $(this).data('sender-id');
            //var userId = $(this).data('user-id');
            msgId = $(this).data('message-id');
            chatIdArray.push(chatId);
            
            /*if(senderId != userId) 
            { */                          
               
            // }
        });

         $.ajax({
            url: chatstatus,
            type: 'POST',
            data : {id : chatIdArray, msgid : msgId },
            success: function(response) 
            {                      
                $(this).removeClass('font-weight-bold');
                getNotification();
            }
        });
    }

     $('#chat-form').submit(function(event) 
     {   
        event.preventDefault();
        $('.error').html("");
        $('#chat-form .error').show();
        var $this = $(this);
        var insert = new FormData($('#chat-form')[0]);
        $('.conversation-list .simplebar-content li').removeClass('font-weight-bold');
        $.ajax({
            url: chatUrl,
            type: 'POST',
            data: insert,
            dataType: 'json',
            contentType: false,
            processData: false,
            cache : false,
            async : false,
            beforeSend: function() 
            {
                $($this).find('button[type="submit"]').prop('disabled', true);
            },
            success: function(result) 
            {
                $($this).find('button[type="submit"]').prop('disabled', false);
                if (result.status == true) 
                {
                    $this[0].reset();
                    $('.error').html("");
                    $("#last_message_id").val(result.data.id);

                    $('.conversation-list .simplebar-content').append('<li class="clearfix odd"><div class="chat-avatar"><img src="'+result.data.image+'" style="height: 40px; width: 40px;" class="rounded" alt=""></div><div class="conversation-text"><div class="ctext-wrap"><i style="font-size: 15px;">'+result.data.user_name+'</i><p style="font-size: 15px;">'+result.data.chat_message+'</p><p style="color: #927c8f">'+result.data.created_date+'</p></div></div></li>');
                    $('.conversation-list .simplebar-content-wrapper').animate({scrollTop: $('.conversation-list .simplebar-content-wrapper').prop("scrollHeight")}, 500);                    
                    
                } 
                else 
                {
                    first_input = "";
                    $('.error').html("");
                    
                    $.each(result.message, function(key) {
                        if(first_input=="") first_input=key;
                        $('#chat-form .error-'+key).html(result.message[key]);
                    });

                    $('#chat-form').find("."+first_input).focus();
                }
            },
            error: function(error) {
                $($this).find('button[type="submit"]').prop('disabled', false);
                alert('Something went wrong!', 'error');
            }
        });
    });
             
 setInterval(function()
 {    
    getNotification();
    var message_id= $('#message_id').val();
    var lastid=$('#last_message_id').val();
    
    if(message_id != undefined && lastid != undefined)
    {
        $.ajax({
          url: fetchData,
          data: {'id' : message_id,'lastid':lastid},
          type:'GET',
              success: function(result) 
              {            
                if (result.status==true) 
                {
                    if (result.data.length>0) 
                    {

                        $('.conversation-list .simplebar-content li').removeClass('font-weight-bold');
                         $.each(result.data, function(key,value) 
                         { 
                            if(value.sender_id!=result.modal.auth_id)
                            {
                                $("#last_message_id").val(value.id);
                                $('.conversation-list .simplebar-content').append('<li class="font-weight-bold clearfix" data_id="'+value.id+'" data-sender-id="'+value.sender_id+'" data-user-id="'+result.modal.auth_id+'" data-message-id="'+result.modal.id+'"><div class="chat-avatar"><img src="'+value.image+'" style="height: 40px; width: 40px;" class="rounded" alt=""></div><div class="conversation-text"><div class="ctext-wrap"><i style="font-size: 15px;">'+value.user_name+'</i><p style="font-size: 15px;">'+value.chat_message+'</p><p style="color: #927c8f">'+value.created_date+'</p></div></div></li>');
                                $('.conversation-list .simplebar-content-wrapper').animate({scrollTop: $('.conversation-list .simplebar-content-wrapper').prop("scrollHeight")}, 500);                   
                                markMessagesAsRead();
                            }
                          
                        });

                    }
                }
              }
            });
    }
    },10000);
    
    function getNotification() 
    {       
        $.ajax({
            url: getNotificationUrl,
            type: "GET",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function (response) 
            { 
                $('#clear_noti').html('<small>'+response.readlink+'</small>');
                $('#clear_noti').attr('href', readAllUrl);                          
                $('#notify-item').attr('href', viewAllUrl);                          
                $('#notify-item').html(response.button_value);                           
                $('#notificationContainer').html(response.notification_html);
                if(response.notifications_count>0)
                {
                    $('#noti_count').html('<span class="noti-icon-badge"></span>');                 
                    sscroll();                                         
                    $('body .dropdown-menu .slimScrollDiv').height("283px");
                }
                else
                {
                    $('#noti_count').html('');                 
                    $('body .dropdown-menu .slimScrollDiv').height("0px");                           
                    
                }

            },
            error: function (error) 
            {
               // alert('Something went wrong!', 'error');
            }
        });
        
    }

    function sscroll()
    {
        $('#notificationContainer').slimScroll({
            marginLeft: '100px',
            height: '283px',
            alwaysVisible: true,
            color: '#000',
            size: '5px',
            railVisible: true,
            railColor: '#f3f3f3',
            railOpacity: 1,
        });
    }   
 markMessagesAsRead();            
});

 $(window).on('load', function() {
    $('.conversation-list .simplebar-content-wrapper').animate({scrollTop: $('.conversation-list .simplebar-content-wrapper').prop("scrollHeight")}, 500);
});

