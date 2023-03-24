$(document).ready(function() {
$('.delete_product_btn').click(function (e) { 
    e.preventDefault();
    var id = $(this).val();
    swal({
        title: "Are you sure?",
        text: "Once deleted, you will not be able to recover this imaginary file!",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    })
    .then((willDelete) => {
        if (willDelete) {
            $.ajax({
                method: "POST",
                url: "http://localhost/phpecom/admin/code.php",
                data: {
                    'product_id': id,
                    'delete_product_btn': true
                },
                success: function (response) {
                    if(response == 200){
                        swal("Success", "Product deleted Successfully", "success");
                        $("#products_table").load(location.href + " #products_table");
                    }else if(response == 500){
                        swal("Error!", "Something went wrong", "error");
                    }
                }
        });
        }
    });
});
});