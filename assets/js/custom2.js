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

        alert(prod_id);

        $.ajax({
            method: "POST",
            url: "functions/handlecart.php",
            data: {
                "prod_id" : prod_id,
                "prod_qty": qty,
                "scope": "add"
            },
            dataType: "dataType",
            success: function (response) {
                    if(response == 401) {
                        alert("Login to continue");
                    }
            }
        });
    });
});