   $.ajaxSetup({
        headers : {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    var usertable = $('#contact_datatable').DataTable({
        processing : true,
        serverSide : true,
        bStateSave: true,
        pageLength: 25,
        ajax : {
            type : "GET",
            url : contactusList,
        },
        columns : [            
            {
                data: function(row) {                    
                    return row.first_name + ' ' + row.last_name;
                },
                name: 'first_name'
            },                                            
            { data : 'email'},                   
            { data : 'country'},                   
            {
            data: 'message',
                render: function (data, type, row) {
                    
                    return '<pre style="white-space: pre-wrap;">' + data + '</pre>';
                }
            },
            { data: 'action', name: 'action', orderable: false }            
        ],        
    });



$('body').on('click', '.delete-contact', function(e) {
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
                url: contactusdelete + '?id=' + id,
                type: 'POST',
                dataType: 'json',
                success: function(result) {
                    toastr.success(result.message);
                    $('#contact_datatable').DataTable().ajax.reload();
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