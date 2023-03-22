<?php 

include("includes/header.php"); 


// print all $_SESSION
// echo '<pre>' . print_r($_SESSION, TRUE) . '</pre>';
?>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Add Product</h4>
                    </div>
                    <div class="card-body">
                        <form action="code.php" method="POST" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-md-12">
                                        <select class="form-select" name="category_id">
                                            <option selected>Category_id</option>
                                            <?php
                                                $query_categories = getAll("categories");
                                                    if(mysqli_num_rows($query_categories) > 0){

                                                        foreach($query_categories as $item){                                       
                                            ?>
                                                            <option value="<?= $item["id"]; ?>"><?= $item["name"]; ?></option>
                                            <?php
                                                        }
                                                    }else {
                                                        echo "Not categories available";
                                                    }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="">Name</label>
                                        <input type="text" name="name" placeholder="Enter Category Name" class="form-control">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="">Slug</label>
                                        <input type="text" name="slug" placeholder="Enter Category slug" class="form-control">
                                    </div>
                                    <div class="col-md-12">
                                        <label for="">Small Description</label>
                                        <textarea rows="3" name="small_description" placeholder="Enter Small Description" class="form-control"></textarea>
                                    </div>
                                    <div class="col-md-12">
                                        <label for="">Description</label>
                                        <textarea rows="3" name="description" placeholder="Enter Description" class="form-control"></textarea>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="">Original price</label>
                                        <input type="number" name="original_price" class="form-control">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="">Selling price</label>
                                        <input type="number" name="selling_price" class="form-control">
                                    </div>
                                    <div class="col-md-12">
                                        <label for="">Upload Image</label>
                                        <input type="file" name="image" class="form-control">
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label for="">Quantity</label>
                                            <input type="number" name="qty" class="form-control">
                                        </div>
                                        <div class="col-md-4">
                                            <label for="">Status</label>
                                            <input type="checkbox" name="status">
                                        </div>
                                        <div class="col-md-4">
                                            <label for="">Trending</label>
                                            <input type="checkbox" name="trending">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <label for="">Meta Title</label>
                                        <input type="text" name="meta_title" placeholder="Enter meta title" class="form-control">
                                    </div>
                                    <div class="col-md-12">
                                        <label for="">Meta Keywords</label>
                                        <textarea rows="3" name="meta_keywords" placeholder="Enter meta keywords" class="form-control"></textarea>
                                    </div>
                                    <div class="col-md-12">
                                        <label for="">Meta Description</label>
                                        <textarea rows="3" name="meta_description" placeholder="Enter meta description" class="form-control"></textarea>
                                    </div>
                                    <div class="col-md-12">
                                        <button type="submit" class="btn btn-primary" name="add_product_btn">Save</button>
                                    </div>
                                </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php include("includes/footer.php"); ?>
