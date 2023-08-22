$(document).ready(function(){
   $.ajaxSetup({
        headers : {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

   var action_status = false;
    if(usertype == 1){
        action_status = true;
    }

    var producttargettable = $('#product_datatable').DataTable({
        processing : true,
        serverSide : true,
        pageLength: 25,         
        ajax : {
            type : "GET",
            url : productList,
        },
        columns : [
            {
                data: 'image',
                render: function(data, type, row, meta) 
                {
                    return '<img src="' + data + '" class="img-thumbnail" width="75" height="75"/>';
                },
                orderable: false
            },
            { data : 'name', name: 'name'},
            { data : 'price', name: 'price'},
            { data : 'quantity', name: 'quantity'},            
            {
            searchable:false,
            orderable:false,
            data:'action',
            name:'action',
            visible:action_status,
            render: function(data, type, full, meta) {
                return data; // The HTML content of the action buttons
            }
        },
        ],        
    });

    $('#add_product').submit(function(event) 
    {
        event.preventDefault();
        $('.error').html("");
        $('#add_product input').each(function(index,value){
            $(this).removeClass('is-invalid');
        });
        $('#add_product .error').show();

        var $this = $(this);
        var dataString = new FormData($('#add_product')[0]);

        $.ajax({
           
            type : "POST",
            url : createproduct,
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
                    $('#addproduct').modal('hide');                    
                    $('#product_datatable').DataTable().ajax.reload();                    
                }                
                else 
                {                
                    first_input = "";
                    $('.error').html("");
                    $.each(result.error, function(key) {
                        if(first_input=="") first_input=key;
                        $('#'+key).closest('.form-input').find('.error').html(result.error[key]);
                    });
                    $('#add_product').find("#"+first_input).focus();
                }
            },
            error: function(error) 
            {
                $($this).find('button[type="submit"]').prop('disabled', false);
                alert('Something went wrong!', 'error');
            }
        });
    });

     $('#addproduct').on('hidden.bs.modal',function(e){
        $('#add_product')[0].reset();
        $('#product_arts').val(null).trigger('change');
        $('#product_target').val(null).trigger('change');
        $('#add_product .error').html("");
        $('#add_product input').each(function(index,value){
            $(this).removeClass('is-invalid');
        });
        $('#product-id').val("");
        $('#addproduct').find('button[type="submit"]').html("Save");
        $('#addproduct').find('#exampleModalLabel').html("Add Product");
    });

    $('body').on('click','.edit-product',function()
    {
        var id = $(this).data('id');    
        $(".product-id").val(id); 

        $.ajax({
            type : "POST",
            url : getproduct,
            data : {id : id},
            dataType : 'json',
            success : function(data){
                
                $('#addproduct').modal('show');
                $('#name').val(data.name);
                $('#price').val(data.price); // Assuming you have an input field with id 'price'
                $('#volume').val(data.total_volume); // Assuming you have an input field with id 'volume'
                $('#tension').val(data.tension); // Assuming you have an input field with id 'tension'
                $('#quantity').val(data.quantity);
                $('#hidden_image').val(data.image);
                

                var selectedArts = data.arts.map(function(art) {
                    return art.id;
                });

                $('#product_arts').val(selectedArts).trigger('change');

                var selectedTargets = data.targets.map(function(target) {
                    return target.id;
                });

                $('#product_target').val(selectedTargets).trigger('change');

                var use_id=data.product_use_id;
                $('#product_use_id').val(use_id);
                $('#product_use_id option[value="' + use_id + '"]').prop('selected', true);

                $('#addproduct').find('button[type="submit"]').html("Update");
                $('#addproduct').find('#exampleModalLabel').html("Edit Product");
            }
        });
    });

    $('body').on('click','.delete-product',function()
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
                    url: deleteproduct,
                    data : {id : id},
                    type: 'POST',
                    dataType: 'json',
                    success: function(result) {
                        toastr.success(result.message);
                        $('#product_datatable').DataTable().ajax.reload();
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