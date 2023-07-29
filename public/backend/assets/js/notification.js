$(document).ready(function()
{ 
    getNotification();
    setInterval(function () {
        getNotification();           
    }, 5 * 1000);

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

});