$(document).ready(function(){
   $.ajaxSetup({
        headers : {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    var producttargettable = $('#productuse_datatable').DataTable({
        processing : true,
        serverSide : true,
        bStateSave: true,
        pageLength: 25,
        ajax : {
            type : "GET",
            url : productuseList,
        },
        columns : [
            /*{ data : 'id', name : 'id'},*/
            { data : 'use', name: 'use'},                        
            { data: 'action', name: 'action', orderable: false }            
        ],        
    });

    $('#add_productuse').submit(function(event) 
    {
        event.preventDefault();
        $('.error').html("");
        $('#add_productuse input').each(function(index,value){
            $(this).removeClass('is-invalid');
        });
        $('#add_productuse .error').show();

        var $this = $(this);
        var dataString = new FormData($('#add_productuse')[0]);

        $.ajax({
           
            type : "POST",
            url : createproductuse,
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
                    $('#addproductuse').modal('hide');                    
                    $('#productuse_datatable').DataTable().ajax.reload();                    
                }                
                else 
                {                
                    first_input = "";
                    $('.error').html("");
                    $.each(result.error, function(key) {
                        if(first_input=="") first_input=key;
                        $('#'+key).closest('.form-input').find('.error').html(result.error[key]);
                    });
                    $('#add_productuse').find("#"+first_input).focus();
                }
            },
            error: function(error) 
            {
                $($this).find('button[type="submit"]').prop('disabled', false);
                alert('Something went wrong!', 'error');
            }
        });
    });

     $('#addproductuse').on('hidden.bs.modal',function(e){
        $('#add_productuse')[0].reset();
        $('#add_productuse .error').html("");
        $('#add_productuse input').each(function(index,value){
            $(this).removeClass('is-invalid');
        });
        $('.product-target-id').val("");
        $('#addproductuse').find('button[type="submit"]').html("Save");
        $('#addproductuse').find('#exampleModalLabel').html("Add Product Use");
    });



    $('body').on('click','.edit-productuse',function()
    {
        var id = $(this).data('id');    
        $(".product-use-id").val(id); 

        $.ajax({
            type : "POST",
            url : getproductuse,
            data : {id : id},
            dataType : 'json',
            success : function(data){
                $('#addproductuse').modal('show');
                $('#use').val(data.use);
                $('#addproductuse').find('button[type="submit"]').html("Update");
                $('#addproductuse').find('#exampleModalLabel').html("Edit Product Use");
            }
        });
    });

    $('body').on('click','.delete-productuse',function()
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
                    url: deleteproductuse,
                    data : {id : id},
                    type: 'POST',
                    dataType: 'json',
                    success: function(result) {
                        toastr.success(result.message);
                        $('#productuse_datatable').DataTable().ajax.reload();
                    },
                    error: function(error) {
                        toastr.error('An error occurred while deleting the user.');
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
});