  $.ajaxSetup({
        headers : {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

$('.product').each(function() 
{
        var addBtn = $(this).find('.add-to-cart-btn');
        var updateInput = $(this).find('.update-cart');
        
        if (updateInput.val() > 0) {
            addBtn.hide();
            updateInput.show();
        } else {
            addBtn.show();
            updateInput.hide();
        }
    });

$('.add-to-cart-btn').click(function(e) 
{
    e.preventDefault();    
    //var productId = $(this).data('product-id');
      
    var addToCartButton = $(this);
    var productId = addToCartButton.data('product-id');
    var quantityInput = addToCartButton.closest('.product').find('.quantity');
    var buyNowBtn = addToCartButton.closest('.product').find('.buy-now');
    
    $.ajax({
        url: addToCart,
        data:{id : productId},
        type: 'GET',
        dataType: 'json',
        success: function(response) 
        {   
            if (!response.inCart) 
            {                
                addToCartButton.hide(); 
                quantityInput.show();   
                buyNowBtn.show();             
                var product = response.cart[productId];
                if (product) 
                {
                    var productQuantity = product.quantity;                    
                    quantityInput.val(productQuantity);
                }
            }
            $('#cartsection').html(response.cartHtml);
            toastr.success(response.message);

        },

        error: function(xhr) {
            console.log(xhr.responseText);
        }
    });
});

$(".update-qty").change(function (e) 
{
    e.preventDefault();

    var ele = $(this);

    var productId = ele.attr("data-product-id");
    var newQuantity = ele.val();
    
    $.ajax({
        url: updateCart,
        method: "patch",
        data: {
            
            id: productId, 
            quantity: newQuantity
        },
        success: function (response) {
           
            $('#cartsection').html(response.cartHtml);
            toastr.success(response.message);
        }
    });
});


$(".update-cart").change(function (e) 
{
    e.preventDefault();

    var ele = $(this);

    var productId = ele.attr("data-product-id");
    var newQuantity = ele.val();
    
    $.ajax({
        url: updateCart,
        method: "patch",
        data: {
            
            id: productId, 
            quantity: newQuantity
        },
        success: function (response) 
        {
            toastr.success(response.message);
           window.location.reload();
        }
    });
});

$(".remove-from-cart").click(function (e) {
    e.preventDefault();
    var ele = $(this);

    if(confirm("Are you sure want to remove?")) {
        $.ajax({
            url: removeCartItem,
            method: "DELETE",
            data: {
               
                id: ele.parents("tr").attr("data-id")
            },
            success: function (response) {
                window.location.reload();
            }
        });
    }
});
