$(document).ready(function(){
   $.ajaxSetup({
        headers : {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    var producttargettable = $('#producttarget_datatable').DataTable({
        processing : true,
        serverSide : true,
        bStateSave: true,
        pageLength: 25,
        ajax : {
            type : "GET",
            url : producttargetList,
        },
        columns : [
            /*{ data : 'id', name : 'id'},*/
            { data : 'name', name: 'name'},                        
            { data: 'action', name: 'action', orderable: false }            
        ],        
    });

    $('#add_producttarget').submit(function(event) 
    {
        event.preventDefault();
        $('.error').html("");
            $('#add_producttarget input').each(function(index,value){
                $(this).removeClass('is-invalid');
            });
            $('#add_producttarget .error').show();

        var $this = $(this);
        var dataString = new FormData($('#add_producttarget')[0]);

        $.ajax({
           
            type : "POST",
            url : createproducttarget,
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
                    $('#addproducttarget').modal('hide');                    
                    $('#producttarget_datatable').DataTable().ajax.reload();
                    
                }                
                else 
                {                
                    first_input = "";
                    $('.error').html("");
                    $.each(result.error, function(key) {
                        if(first_input=="") first_input=key;
                        $('#'+key).closest('.form-input').find('.error').html(result.error[key]);
                    });
                    $('#add_producttarget').find("#"+first_input).focus();
                }
            },
            error: function(error) 
            {
                $($this).find('button[type="submit"]').prop('disabled', false);
                alert('Something went wrong!', 'error');
            }
        });
    });

     $('#addproducttarget').on('hidden.bs.modal',function(e){
        $('#add_producttarget')[0].reset();
        $('#add_producttarget .error').html("");
        $('#add_producttarget input').each(function(index,value){
            $(this).removeClass('is-invalid');
        });
        $('.product-target-id').val("");
        $('#addproducttarget').find('button[type="submit"]').html("Save");
        $('#addproducttarget').find('#exampleModalLabel').html("Add Product Target");
    });



    $('body').on('click','.edit-producttarget',function()
    {
        var id = $(this).data('id');    
        $(".product-target-id").val(id); 

        $.ajax({
            type : "POST",
            url : getproducttarget,
            data : {id : id},
            dataType : 'json',
            success : function(data){
                $('#addproducttarget').modal('show');
                $('#name').val(data.name);
                $('#addproducttarget').find('button[type="submit"]').html("Update");
                $('#addproducttarget').find('#exampleModalLabel').html("Edit Product Target");
            }
        });
    });

    $('body').on('click','.delete-producttarget',function()
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
                    url: deleteproducttarget,
                    data : {id : id},
                    type: 'POST',
                    dataType: 'json',
                    success: function(result) {
                        toastr.success(result.message);
                        $('#producttarget_datatable').DataTable().ajax.reload();
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