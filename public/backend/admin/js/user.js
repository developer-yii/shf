   $.ajaxSetup({
        headers : {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    var usertable = $('#user_datatable').DataTable({
        processing : true,
        serverSide : true,
        bStateSave: true,
        pageLength: 25,
        ajax : {
            type : "GET",
            url : userList,
        },
        columns : [
            { data : 'user_name', name: 'first_name'},
            { data : 'email'},
            { data : 'phone_number'},
            { data: 'role_lable', name: 'role'},            
            { data: 'email_verified', name: 'email_verified_at'},            
            {
                name : 'is_active',
                data : 'status',
                sortable: true,
                render: function(_,_, full) {
                    if(full['is_active']==1){
                        return '<span class="badge badge-success-lighten">'+full['status']+'</span>';
                    }else{
                        return '<span class="badge badge-danger-lighten">'+full['status']+'</span>';
                    }
                },
            },           
            { data: 'action', name: 'action', orderable: false }            
        ],        
    });

$('#update_user_form').submit(function(event) 
{
    event.preventDefault();
    var $this = $(this);
    var dataString = new FormData($('#update_user_form')[0]);
    $.ajax({
        url: userupdate,
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

                $('#edit-form').find("#"+first_input).focus();

            }
        },
        error: function(error) {
            $($this).find('button[type="submit"]').prop('disabled', false);
            alert('Something want wrong!', 'error');
            location.reload();
        }
    });
});



$('body').on('click', '.delete-user', function(e) {
    e.preventDefault();
    var id = $(this).attr('data-id');

    // Show SweetAlert confirmation dialog
    Swal.fire({
        title: 'Are you sure want to delete?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ok, got it!',
        cancelButtonText: 'Nope, cancel it.'
    }).then((result) => {
        if (result.isConfirmed) {
            // User confirmed the action, proceed with the deletion
            $.ajax({
                url: userdelete + '?id=' + id,
                type: 'POST',
                dataType: 'json',
                success: function(result) {
                    toastr.success(result.message);
                    $('#user_datatable').DataTable().ajax.reload();
                },
                error: function(error) {
                    toastr.error('An error occurred while deleting the user.');
                }
            });
        } else {
            // User canceled the action, do nothing
            toastr.info('Deletion canceled.');
        }
    });
});