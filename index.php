<?php 
session_start();
include("includes/header.php"); 
// echo '<pre>' . print_r($_SESSION, TRUE) . '</pre>';
?>
<div class="py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6"></div>
                <?php if(isset($_SESSION["message"])) { ?>
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        <strong>Hey! </strong> <?php echo $_SESSION['message']; ?> 
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php
                            unset($_SESSION['message']);
                        }
                ?>
            </div>
        </div>
    </div>
</div>
<h1>Hello, world! <i class="fa fa-user"></i></h1>
<button class="btn btn-primary">Testing</button>

<!-- Optional JavaScript; choose one of the two! -->
<?php include("includes/footer.php.php"); ?>