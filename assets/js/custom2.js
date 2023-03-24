$(document).ready(function () {
    
    $('.increment-btn').click(function (e) { 
        e.preventDefault();

        var qty = $(this).closest('.product_data').find('.input-qty').val();
        
        var value = parseInt(qty, 10);

        value = isNaN(value) ? 0 : value;
        
        if(value < 10) {
            value++;
        
            $(this).closest('.product_data').find('.input-qty').val(value);
        }
    });

    $('.decrement-btn').click(function (e) { 
        e.preventDefault();

        var qty = $(this).closest('.product_data').find('.input-qty').val();
        
        var value = parseInt(qty, 10);

        value = isNaN(value) ? 0 : value;
        
        if(value > 1) {
            value--;
        
            $(this).closest('.product_data').find('.input-qty').val(value);
        }
    });
    
    $('.addToCartBtn').click(function (e) { 
        e.preventDefault();
        var qty = $(this).closest('.product_data').find('.input-qty').val();
        
        var prod_id = $(this).val();

        $.ajax({
            method: "POST",
            url: "http://localhost/phpecom/functions/handlecart.php",
            data: {
                "prod_id" : prod_id,
                "prod_qty": qty,
                "scope": "add"
            },
            dataType: "dataType",
            success: function (response) {
                    if(response == 201) {
                        alertify.success("Product added to cart");
                    }else if(response == "existing"){
                        alertify.success("Product already in cart");
                    }
                    else if(response == 401) {
                        alertify.success("Login to continue");
                    }
                    else if(response == 500) {
                        alertify.success("Something went wrong");
                    }
            }
        });
    });

    
    $(document).on('click','.updateQty', function(){
    
        var qty = $(this).closest('.product_data').find('.input-qty').val();
        
        var qrod_id = $(this).closest('.product_data').find('.prodId').val();

        
        $.ajax({
            method: "POST",
            url: "http://localhost/phpecom/functions/handlecart.php",
            data: {
                "prod_id" : qrod_id,
                "prod_qty": qty,
                "scope": "update"
            },
            success: function (response) {
                // alert(response);
            }
        });

    });

    $(document).on('click', '.deleteItem', function () {
        var cart_id = $(this).val();


        //alert(cart_id);
        $.ajax({
            method: "POST",
            url: "http://localhost/phpecom/functions/handlecart.php",
            data: {
                "cart_id" : cart_id,
                "scope": "delete"
            },
            success: function (response) {
                if(response == 200){
                    $("#mycart").load(location.href + " #mycart");
                }
            }
        });
    });
});