<?php 

include("includes/header.php"); 


// print all $_SESSION
// echo '<pre>' . print_r($_SESSION, TRUE) . '</pre>';
?>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <?php 
                    if(isset($_GET["id"])){
                        $id = $_GET["id"];
                        $product = getByID("products", $id);

                        if(mysqli_num_rows($product) > 0){

                                $data = mysqli_fetch_array($product);
                ?>
                                <div class="card">
                                    <div class="card-header">
                                        <h4>Edit Product
                                            <a href="products.php" class="btn btn-primary float-end">Back</a>
                                        </h4>
                                    </div>
                                    <div class="card-body">
                                        <form action="code.php" method="POST" enctype="multipart/form-data">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <select class="form-select" name="category_id">
                                                            <option selected>Select</option>
                                                            <?php
                                                                $query_categories = getAll("categories");
                                                                    if(mysqli_num_rows($query_categories) > 0){

                                                                        foreach($query_categories as $item){                                       
                                                            ?>
                                                                            <option value="<?= $item["id"]; ?>"  <?=$data["category_id"] == $item["id"] ? 'selected':'' ?>><?= $item["name"]; ?></option>
                                                            <?php
                                                                        }
                                                                    }else {
                                                                        echo "Not categories available";
                                                                    }
                                                            ?>
                                                        </select>
                                                    </div>
                                                    <input type="hidden" name="product_id" value="<?= $data["id"]; ?>">
                                                    <div class="col-md-6">
                                                        <label for="">Name</label>
                                                        <input type="text" name="name" value="<?= $data["name"]; ?>" placeholder="Enter Category Name" class="form-control">
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label for="">Slug</label>
                                                        <input type="text" name="slug" value="<?= $data["slug"]; ?>" placeholder="Enter Category slug" class="form-control">
                                                    </div>
                                                    <div class="col-md-12">
                                                        <label for="">Small Description</label>
                                                        <textarea rows="3" name="small_description"placeholder="Enter Small Description" class="form-control"><?= $data["small_description"]; ?></textarea>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <label for="">Description</label>
                                                        <textarea rows="3" name="description" placeholder="Enter Description" class="form-control"><?= $data["description"]; ?></textarea>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label for="">Original price</label>
                                                        <input type="number" name="original_price" value="<?= $data["original_price"]; ?>" class="form-control">
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label for="">Selling price</label>
                                                        <input type="number" name="selling_price" value="<?= $data["selling_price"]; ?>" class="form-control">
                                                    </div>
                                                    <div class="col-md-12">
                                                        <input type="hidden" name="old_image" value="<?= $data["image"]; ?>">
                                                        <label for="mb-0">Upload Image</label>
                                                        <input type="file" name="image" class="form-control">
                                                        <label for="mb-0">Current Image</label>
                                                        <img src="../uploads/<?= $data["image"]; ?>" alt="Product Image" height="50px" width="50px">
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <label for="">Quantity</label>
                                                            <input type="number" name="qty" value="<?= $data["qty"]; ?>" class="form-control">
                                                        </div>
                                                        <div class="col-md-4">
                                                            <label for="">Status</label>
                                                            <input type="checkbox" <?= $data["status"] == '0' ? "": "checked" ; ?> name="status">
                                                        </div>
                                                        <div class="col-md-4">
                                                            <label for="">Trending</label>
                                                            <input type="checkbox"   <?= $data["trending"]  == '0' ? "": "checked" ; ?>  name="trending">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <label for="">Meta Title</label>
                                                        <input type="text" name="meta_title" value="<?= $data["meta_title"]; ?>" placeholder="Enter meta title" class="form-control">
                                                    </div>
                                                    <div class="col-md-12">
                                                        <label for="">Meta Keywords</label>
                                                        <textarea rows="3" name="meta_keywords" placeholder="Enter meta keywords" class="form-control"><?= $data["meta_keywords"]; ?></textarea>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <label for="">Meta Description</label>
                                                        <textarea rows="3" name="meta_description" placeholder="Enter meta description" class="form-control"><?= $data["meta_description"]; ?></textarea>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <button type="submit" class="btn btn-primary" name="update_product_btn">Update</button>
                                                    </div>
                                                </div>
                                        </form>
                                    </div>
                                </div>
                <?php
                        }else{
                        echo "Product Not found for given id";
                        }

                    }else{
                        echo "Id missing from url";
                    }
                ?>
            </div>
        </div>
    </div>
<?php include("includes/footer.php"); ?>
