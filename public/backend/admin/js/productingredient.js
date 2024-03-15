$(document).ready(function(){
   $.ajaxSetup({
        headers : {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    var productingredienttable = $('#productingredient_datatable').DataTable({
        processing : true,
        serverSide : true,
        bStateSave: true,
        pageLength: 25,
        ajax : {
            type : "GET",
            url : productingredientList,
        },
        columns : [
            /*{ data : 'id', name : 'id'},*/
            { data : 'ingredient_name', name: 'ingredient_name'},
            { data: 'action', name: 'action', orderable: false }
        ],
    });

    $('#add_productingredient').submit(function(event)
    {
        event.preventDefault();
        $('.error').html("");
            $('#add_productingredient input').each(function(index,value){
                $(this).removeClass('is-invalid');
            });
            $('#add_productingredient .error').show();

        var $this = $(this);
        var dataString = new FormData($('#add_productingredient')[0]);

        $.ajax({

            type : "POST",
            url : createproductingredient,
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
                    $('#addproductingredient').modal('hide');
                    $('#productingredient_datatable').DataTable().ajax.reload();

                }
                else
                {
                    first_input = "";
                    $('.error').html("");
                    $.each(result.error, function(key) {
                        if(first_input=="") first_input=key;
                        $('#'+key).closest('.form-input').find('.error').html(result.error[key]);
                    });
                    $('#add_productingredient').find("#"+first_input).focus();
                }
            },
            error: function(error)
            {
                $($this).find('button[type="submit"]').prop('disabled', false);
                alert('Something went wrong!', 'error');
            }
        });
    });

     $('#addproductingredient').on('hidden.bs.modal',function(e){
        $('#add_productingredient')[0].reset();
        $('#add_productingredient .error').html("");
        $('#add_productingredient input').each(function(index,value){
            $(this).removeClass('is-invalid');
        });
        $('.product-ingredient-id').val("");
        $('#addproductingredient').find('button[type="submit"]').html("Save");
        $('#addproductingredient').find('#exampleModalLabel').html("Add Product Ingredient");
    });



    $('body').on('click','.edit-productingredient',function()
    {
        var id = $(this).data('id');
        $(".product-ingredient-id").val(id);

        $.ajax({
            type : "POST",
            url : getproductingredient,
            data : {id : id},
            dataType : 'json',
            success : function(data){
                $('#addproductingredient').modal('show');
                $('#name').val(data.ingredient_name);
                $('#addproductingredient').find('button[type="submit"]').html("Update");
                $('#addproductingredient').find('#exampleModalLabel').html("Edit Product Ingredient");
            }
        });
    });

    $('body').on('click','.delete-productingredient',function()
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
                    url: deleteproductingredient,
                    data : {id : id},
                    type: 'POST',
                    dataType: 'json',
                    success: function(result) {
                        toastr.success(result.message);
                        $('#productingredient_datatable').DataTable().ajax.reload();
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