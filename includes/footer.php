     <!-- ALERTIFY JS-->
     <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>
<script>

        alertify.set('notifier','position', 'top-right');
        <?php 
        if(isset($_SESSION["message"])) {  
            ?>
                
                alertify.success('<?=  $_SESSION["message"]; ?>');
    <?php
            unset($_SESSION['message']);
        }
    ?>
    
</script>
</body>
</html>