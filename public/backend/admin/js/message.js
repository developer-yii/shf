$(document).ready(function()
{
   $.ajaxSetup({
        headers : {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    var messagetable = $('#message_datatable').DataTable({
        processing : true,
        serverSide : true,
        bStateSave: true,
        pageLength: 25,
        ajax : {
            type : "GET",
            url : adminmessagelist,
        },
        columns : [
            { data : 'user_name'},
            { data : 'topic'},
            { data : 'title'},
            { data : 'created_at',
                render: function (data, type, row) 
                {                        
                    var createdAt = new Date(data);
                    return createdAt.toLocaleString();
                }
            },
            { data: 'status', name: 'status' },
            { data: 'action', name: 'action', orderable: false }            
        ],        
    });

    $('body').on('change','.message_status', function(event) {
        var status = $(this).val();
        var id = $(this).attr('data-id');
        var user_id = $(this).attr('data-user');

        $.ajax({
            url: changeStatusUrl,
            type: 'POST',
            dataType: 'json',
            data: { 'id': id, 'user_id': user_id, 'status': status },
            success: function(result) {
                toastr.success(result.message);
                $('#ticket').DataTable().ajax.reload();
            }
        });
    });


  });