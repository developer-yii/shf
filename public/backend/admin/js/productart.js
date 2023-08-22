$(document).ready(function(){
   $.ajaxSetup({
        headers : {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    var productarttable = $('#productart_datatable').DataTable({
        processing : true,
        serverSide : true,
        bStateSave: true,
        pageLength: 25,
        ajax : {
            type : "GET",
            url : productartList,
        },
        columns : [
            /*{ data : 'id', name : 'id'},*/
            { data : 'name', name: 'name'},                        
            { data: 'action', name: 'action', orderable: false }            
        ],        
    });

    $('#add_productart').submit(function(event) 
    {
        event.preventDefault();
        $('.error').html("");
        $('#add_productart input').each(function(index,value){
            $(this).removeClass('is-invalid');
        });
        $('#add_productart .error').show();

        var $this = $(this);
        var dataString = new FormData($('#add_productart')[0]);

        $.ajax({
           
            type : "POST",
            url : createproductart,
            data : dataString,
            contentType : false,
            processData : false,
            cache : false,
            async : false,
            beforeSend: function() 
            {
                $($this).find('button[type="submit"]').prop('disabled', true);
            },
            success: function(result) 
            {
                $($this).find('button[type="submit"]').prop('disabled',false);
                if(result.status == true)
                {
                    $this[0].reset();
                    toastr.success(result.message);
                    $('#addproductart').modal('hide');
                    $('#productart_datatable').DataTable().ajax.reload();
                    
                }                
                else 
                {                
                    first_input = "";
                    $('.error').html("");
                    $.each(result.error, function(key) {
                        if(first_input=="") first_input=key;
                        $('#'+key).closest('.form-input').find('.error').html(result.error[key]);
                    });
                    $('#add_productart').find("#"+first_input).focus();
                }
            },
            error: function(error) 
            {
                $($this).find('button[type="submit"]').prop('disabled', false);
                alert('Something went wrong!', 'error');
            }
        });
    });

     $('#addproductart').on('hidden.bs.modal',function(e){
        $('#add_productart')[0].reset();
        $('#add_productart .error').html("");
        $('#add_productart input').each(function(index,value){
            $(this).removeClass('is-invalid');
        });
        $('.product-art-id').val("");
        $('#addproductart').find('button[type="submit"]').html("Save");
        $('#addproductart').find('#exampleModalLabel').html("Add Product Art");
    });



    $('body').on('click','.edit-productart',function()
    {
        var id = $(this).data('id');    
        $(".product-art-id").val(id); 

        $.ajax({
            type : "POST",
            url : getproductart,
            data : {id : id},
            dataType : 'json',
            success : function(data){
                $('#addproductart').modal('show');
                $('#name').val(data.name);
                $('#addproductart').find('button[type="submit"]').html("Update");
                $('#addproductart').find('#exampleModalLabel').html("Edit Product Art");
            }
        });
    });

    $('body').on('click','.delete-productart',function()
    {
        var id = $(this).attr('data-id');

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
                    url: deleteproductart,
                    data : {id : id},
                    type: 'POST',
                    dataType: 'json',
                    success: function(result) {
                        toastr.success(result.message);
                        $('#productart_datatable').DataTable().ajax.reload();
                    },
                    error: function(error) {
                        toastr.error('An error occurred while deleting the user.');
                    }
                });
            } 
            else 
            {
                toastr.info('Deletion canceled.');
            }
        });
    });
});