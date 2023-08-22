$(document).ready(function(){
   $.ajaxSetup({
        headers : {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

   var action_status = false;
    if(usertype == 1 || usertype == 2){
        action_status = true;
    }

    var ordertable = $('#order_datatable').DataTable({
        processing : true,
        serverSide : true,        
        pageLength: 25,        
        order: [[0, 'desc']], 
        ajax : {
            type : "GET",
            url : orderList,
        },
        columns : [
            {
                data: 'order_id',
                render: function(data) {
                    return 'Order-' + data;
                }
            },
            { data : 'order_created_date'},
            { data : 'username'},
            {
                data: 'total_amount',
                render: function(data) {
                    return '<i class="mdi mdi-currency-eur"></i>' + data; 
                }
            },
            /*{ data : 'total_amount'},*/
            { data : 'status_label', name : 'status'},
            {
            searchable:false,
            orderable:false,
            data:'username',
            name:'username',            
            render: function(_,_, full) {
                var contactId = full['order_id'];
                if(contactId)
                {   
                    actions = '<td><a href="' + detailOrder + '?id=' + contactId + '" view-id="'+ contactId +'" class="view-order btn btn-info mr-1"><i class="mdi mdi-eye"></i></a>';                  
                    return actions; 
                }
                return "";
            }
        },        
        ],        
    });
   
    $('body').on('change','.order_status', function(event) {
        var status = $(this).val();
        var id = $(this).attr('data-id');

        $.ajax({
            url: changeStatusUrl,
            type: 'POST',
            dataType: 'json',
            data: { 'id': id, 'status': status },
            success: function(result) {
                toastr.success(result.message);
                $('#order_datatable').DataTable().ajax.reload();
            }
        });
    });

});