<?php
session_start();

include("../config/dbcon.php");

include("../functions/myfunctions.php");



if(isset($_POST["add_category_btn"])) {
    $name = $_POST["name"];
    $slug = $_POST["slug"];
    $description = $_POST["description"];
    $meta_title = $_POST["meta_title"];
    $meta_description = $_POST["meta_description"];
    $meta_keywords = $_POST["meta_keywords"];
    $status = isset($_POST["status"]) ? '1' : '0';
    $popular = isset($_POST["popular"]) ? '1' : '0';


    // Note : Enable permission on a folder to allow file upload.
    // Need to run the command chmod -Rf 777 FOLDER_PATH
    // FLODER_PATH is name = uploads

    $image = $_FILES["image"]["name"];

    $path = "../uploads";

    $image_ext = pathinfo($image, PATHINFO_EXTENSION);
    $filename = time().'.'.$image_ext;

    $query = "INSERT INTO categories 
    (name, slug, description, meta_title, meta_description, meta_keywords, status, popular, image)
    VALUES ('$name', '$slug', '$description', '$meta_title', '$meta_description', '$meta_keywords', '$status', '$popular', '$filename')";

    $cate_query_run = mysqli_query($conn, $query);

    if($cate_query_run){
        move_uploaded_file($_FILES["image"]["tmp_name"], $path .'/'.$filename);
        redirect("http://localhost/phpecom/admin/add-category.php", "Category Added Successfuly");
    }else{
        redirect("http://localhost/phpecom/admin/add-category.php", "Something went wrong");
    }

}else if(isset($_POST["update_category_btn"])) {

    $category_id = $_POST['category_id'];
    $name = $_POST["name"];
    $slug = $_POST["slug"];
    $description = $_POST["description"];
    $meta_title = $_POST["meta_title"];
    $meta_description = $_POST["meta_description"];
    $meta_keywords = $_POST["meta_keywords"];
    $status = isset($_POST["status"]) ? '1' : '0';
    $popular = isset($_POST["popular"]) ? '1' : '0';

    $new_image = $_FILES["image"]["name"];
    
    $old_image = $_POST["old_image"];

    // var_dump($new_image);
    // var_dump($old_image);

    if($new_image != "") {
        //$update_filename  = $new_image;
        $image_ext = pathinfo($new_image, PATHINFO_EXTENSION);
        $update_filename = time().'.'.$image_ext;
    }else {
        $update_filename  = $old_image;
    }

    $path = "../uploads";

    $update_query = "UPDATE categories SET name='$name', slug='$lug', description='$description',
    meta_title='$meta_title',  meta_description='$meta_description', meta_keywords='$meta_keywords', 
    status='$status', popular='$popular', image='$update_filename' WHERE id='$category_id' ";

    $update_query_run = mysqli_query($conn, $update_query);
    if($update_query_run){
        if($_FILES["image"]["name"] != ""){
            move_uploaded_file($_FILES["image"]["tmp_name"],   $path.'/'.$update_filename);
            if(file_exists("../uploads/".$old_image)){
                unlink("../uploads/".$old_image);
            }
        }
        redirect("http://localhost/phpecom/admin/edit-category.php?id=$category_id", "Category Updated successfuly");
    }else {
        redirect("http://localhost/phpecom/admin/edit-category.php?id=$category_id", "Something Went wrong");
    }
}else if(isset($_POST["delete_category_btn"])){
    $category_id = mysqli_real_escape_string($conn, $_POST["category_id"]);

    // delete img in the folder uploads then delete
    $category_query = "SELECT * FROM categories WHERE id='$category_id' ";
    $category_query_run = mysqli_query($conn, $category_query);
    $category_data = mysqli_fetch_array($category_query_run);
    $image = $category_data["image"];
  

    $delete_query = "DELETE FROM categories WHERE id='$category_id' ";
    $delete_query_run = mysqli_query($conn, $delete_query);

    if($delete_query_run){
        if(file_exists("../uploads/".$image)){
            unlink("../uploads/".$image);
        }
        redirect("http://localhost/phpecom/admin/category.php", "Category deleted Successfully");
    }else {
        redirect("http://localhost/phpecom/admin/category.php", "Something went wrong");
    }
}else if(isset($_POST["add_product_btn"])){
    $category_id = $_POST["category_id"];
    $name = $_POST["name"];
    $slug = $_POST["slug"];
    $small_description = $_POST["small_description"];
    $description = $_POST["description"];
    $original_price = $_POST["original_price"];
    $selling_price = $_POST["selling_price"];
    $image = $_FILES["image"]["name"];
    $qty = $_POST["qty"];
    $status = isset($_POST["status"]) ? "1" : "0";
    $trending = isset($_POST["trending"]) ? "1" : "0";
    $meta_title = $_POST["meta_title"];
    $meta_keywords = $_POST["meta_keywords"];
    $meta_description = $_POST["meta_description"];

    // folder uploads image
    $folder_upload = "../uploads";

    $image_ext = pathinfo($image, PATHINFO_EXTENSION);

    $filename = time().'.'.$image_ext;


    $products_querry = "INSERT INTO products(category_id, name, slug, small_description, 
    description, original_price, selling_price, image, qty, status, trending, 
    meta_title, meta_keywords, meta_description) 
    VALUES('$category_id', ' $name', '$slug', 
    '$small_description', '$description', ' $original_price', 
    '$selling_price', '$filename', '$qty', '$status', '$trending', '$meta_title', '$meta_keywords', '$meta_description')";

    $products_querry_run = mysqli_query($conn, $products_querry);

    if($name != "" && $slug != "" && $description != ""){
        if($products_querry_run){
            // Hàm move_uploaded_file() di chuyển tệp đã tải lên đến đích mới.
            // move_uploaded_file(file, dest) file : Yêu cầu. Chỉ định tên tệp của tệp đã tải lên, dest: Yêu cầu. Chỉ định vị trí mới cho tệp
            move_uploaded_file($_FILES["image"]["tmp_name"], $folder_upload .'/'.$filename);
            redirect("http://localhost/phpecom/admin/add-products.php", "Add product successfuly");
        }else {
            redirect("http://localhost/phpecom/admin/add-products.php", "Something went wrong");
        }
    }else {
        redirect("http://localhost/phpecom/admin/add-products.php", "All fields are madatory");
    }
}else if(isset($_POST["update_product_btn"])){

    $product_id = $_POST["product_id"];

    $category_id = $_POST["category_id"];
    $name = $_POST["name"];
    $slug = $_POST["slug"];
    $small_description = $_POST["small_description"];
    $description = $_POST["description"];
    $original_price = $_POST["original_price"];
    $selling_price = $_POST["selling_price"];
    
    $qty = $_POST["qty"];
    $status = isset($_POST["status"]) ? "1" : "0";
    $trending = isset($_POST["trending"]) ? "1" : "0";
    $meta_title = $_POST["meta_title"];
    $meta_keywords = $_POST["meta_keywords"];
    $meta_description = $_POST["meta_description"];

    //folder uploads image
    $path = "../uploads";

    $new_image = $_FILES["image"]["name"];
    
    $old_image = $_POST["old_image"];


    if($new_image != "") {
        //$update_filename  = $new_image;
        $image_ext = pathinfo($new_image, PATHINFO_EXTENSION);
        $update_filename = time().'.'.$image_ext;
    }else {
        $update_filename  = $old_image;
    }

    $update_product_query = "UPDATE products SET category_id='$category_id',
        name='$name', slug='$slug', small_description='$small_description', description='$description', 
        original_price='$original_price', selling_price='$selling_price', image='$update_filename', qty='$qty',
        status='$status', trending='$trending', meta_title='$meta_title', meta_keywords='$meta_keywords', meta_description='$meta_description' WHERE id='$product_id'";

    $update_product_query_run = mysqli_query($conn, $update_product_query);

    if($update_product_query_run){
        if($_FILES["image"]["name"] != ""){
            move_uploaded_file($_FILES["image"]["tmp_name"],   $path.'/'.$update_filename);
            if(file_exists("../uploads/".$old_image)){
                unlink("../uploads/".$old_image);
            }
        }
        redirect("http://localhost/phpecom/admin/edit-product.php?id=$product_id", "product Updated successfuly");
    }else {
        redirect("http://localhost/phpecom/admin/edit-product.php?id=$product_id", "Something Went wrong");
    }

}else if(isset($_POST["delete_product_btn"])){
    $product_id = mysqli_real_escape_string($conn, $_POST["product_id"]);

    // delete img in the folder uploads then delete
    $product_query = "SELECT * FROM products WHERE id='$product_id' ";
    $product_query_run = mysqli_query($conn, $product_query);
    $product_data = mysqli_fetch_array($product_query_run);
    $image = $product_data["image"];
  

    $delete_query = "DELETE FROM products WHERE id='$product_id' ";
    $delete_query_run = mysqli_query($conn, $delete_query);

    if($delete_query_run){
        if(file_exists("../uploads/".$image)){
            unlink("../uploads/".$image);
        }
        //redirect("http://localhost/phpecom/admin/products.php", "products deleted Successfully");
        echo 200;
    }else {
        // redirect("http://localhost/phpecom/admin/products.php", "Something went wrong");
        echo 500;
    }
}else {
    header("Location: http://localhost/phpecom/admin/index.php");
}
?>