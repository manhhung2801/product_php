<?php 
include("functions/userfunctions.php");
include("includes/header.php"); 

if(isset($_GET["category"])){
    $category_slug = $_GET["category"];
    $category_data = getSlugActive("categories", $category_slug);
    $category = mysqli_fetch_array($category_data);
    $cid = $category["id"];

?>
        <div class="py-3 bg-primary">
            <div class="container">
                    <h6 class="text-white">
                        <a class="text-white" href="categories.php">
                            Home /
                        </a>
                        
                        <a class="text-white" href="categories.php">
                            Collections /
                        </a>
                        <?= $category["name"]; ?></h6>
            </div>
        </div>

    <div class="py-5">
            <div class="container">
                    <div class="row justify-content-center">
                            <div class="col-md-12">
                                        <h4>Our Collections</h4>
                                        <hr>
                                        <div class="row">
                                            <?php
                                                $products = getProByCategory($cid);

                                                if(mysqli_num_rows($products) > 0){
                                                        foreach($products as $item){

                                                    ?>
                                                        <div class="col-md-3 mb-2">
                                                            <a href="product-view.php?product=<?= $item["slug"]; ?>">
                                                                <div class="card shadow">
                                                                    <div class="card-body">
                                                                        <img src="uploads/<?= $item["image"]; ?>" alt="Products Image" class="w-100" height="300px">
                                                                        <h4 class="text-center"></h4><?= $item["name"]; ?></h4>
                                                                    </div>
                                                                </div>
                                                            </a>
                                                        </div>
                                                    
                                                    <?php
                                                        }

                                                }
                                            ?>
                                        </div>
                            </div>
                    </div>
            </div>
    </div>

<!-- Optional JavaScript; choose one of the two! -->
<?php 
}else {
    "Something went wrong";
}
include("./includes/footer.php.php"); 
?>