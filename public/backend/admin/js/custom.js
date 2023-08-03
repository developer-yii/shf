   $.ajaxSetup({
        headers : {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });


$('#update_profile').submit(function(event) 
{
    event.preventDefault();
    var $this = $(this);
    var dataString = new FormData($('#update_profile')[0]);
    $.ajax({
        url: updateprofile,
        type: 'POST',
        data: dataString,
        processData: false,
        contentType: false,
        beforeSend: function() {
            $($this).find('button[type="submit"]').prop('disabled', true);
        },
        success: function(result) 
        {
            $($this).find('button[type="submit"]').prop('disabled', false);
            if (result.status == true) 
            {
                toastr.success(result.message);
                $('.error').html("");
                window.location.href = redirectroute;
            }

            else if(result.status == false && result.validationError == true)
            {
                toastr.error(result.message);
            }
            else 
            {
                first_input = "";
                $('.error').html("");
                $.each(result.message, function(key) {
                    if(first_input=="") first_input=key;
                    $($this).find('#'+key).closest('.form-input').find('.error').html(result.message[key]);
                });

                $('#update_profile').find("#"+first_input).focus();

            }
        },
        error: function(error) {
            $($this).find('button[type="submit"]').prop('disabled', false);
            alert('Something want wrong!', 'error');
            location.reload();
        }
    });
});
