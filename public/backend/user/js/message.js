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
            url : messagelist,
        },
        columns : [
            { data : 'topic'},
            { data : 'title'},
            { data : 'created_at',
                render: function (data, type, row) 
                {                        
                    var createdAt = new Date(data);
                    return createdAt.toLocaleString();
                }
            },
            { data: 'action', name: 'action'}            
        ],
    });


  });