$(document).ready(function(){
    $.ajaxSetup({
        headers : {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    var codetable = $('#file_datatable').DataTable({
            processing : true,
            serverSide : true,
            bStateSave: true,
            pageLength: 25,
            ajax : {
                type : "GET",
                url : filelist,
            },
            columns : [
                { data : 'id', name:'id'},
                { data : 'uploaded_file_name', name:'uploaded_file_name'},
                { data : 'codes_imported'},
                { data : 'username', name:'users.first_name'},
                { data : 'created_at',name:'created_at',
                render: function(data, type, row) {
                    var formattedDate = moment(data).format('D-M-Y h:mm A');
                    return formattedDate;
                }
            },            
            { "data": 'id',
                sortable: false,
                render: function(_,_, full){
                    var codeid = full['id'];
                    var file_url = full['file_url'];
                    var file_name = full['uploaded_file_name'];
                    if(codeid)
                    {
                        var actions='<a href="'+ file_url + '" download="'+ file_name + '" class="btn btn-info btn-sm" title="Download"><i class="mdi mdi-download"></i></a><a class="btn btn-danger btn-sm delete-file m-1" data-id="'+ codeid + '"><i class="mdi mdi-delete"></i></a>';
                        return actions;
                    }
                    return '';
                } 
            },
        ],
    });

    $('#file_datatable').on('click', '.download-file', function (e) 
    {
        e.preventDefault();
        var fileId = $(this).data('id');        
        $.ajax({
            url: downloadfile,
            data : {id : fileId},
            type: 'POST',
            dataType: 'json',
            success: function(result) {
                toastr.success(result.message);                
            },
            error: function(xhr) 
            {
                toastr.error(xhr.responseJSON.error);
            }
        });
    });

    $('body').on('click','.delete-file',function()
    {       
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
            if (result.isConfirmed) 
            {
                // User confirmed the action, proceed with the deletion
                $.ajax({
                    url: deletefile,
                    data : {id : id},
                    type: 'POST',
                    dataType: 'json',
                    success: function(result) {
                        toastr.success(result.message);
                        $('#file_datatable').DataTable().ajax.reload();
                    },
                    error: function(xhr) 
                    {
                        toastr.error(xhr.responseJSON.error);
                    }
                });
            } 
            else 
            {
                // User canceled the action, do nothing
                toastr.info('Deletion canceled.');
            }
        });

    });

    function hidealert(){
        window.setTimeout(function() {
            $(".alert").fadeOut();
        }, 10000);
    } 
});