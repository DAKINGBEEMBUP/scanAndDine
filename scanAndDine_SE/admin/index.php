<?php include('partials/admin-header.php'); ?>

    <!-- main content section starts here -->
    <div class="main-content">
        <div class="wrapper">
            <h1>Choose Your Restaurant</h1>
            <br><br>

            <?php
                if(isset($_SESSION['login'])){
                    echo $_SESSION['login'];
                    unset($_SESSION['login']);
                }
            ?>
            <br><br>

            <div class="col-4 text-center">
                <h1>Gyukaki</h1>
            </div>

            <div class="col-4 text-center">
                <h1>Hadi Lao</h1>
            </div>

            <div class="col-4 text-center">
                <h1>Pancius</h1>
            </div>

            <div class="col-4 text-center">
                <h1>Sushi Thei</h1>
            </div>

            <div class="clearfix"></div>
        </div>
    </div>
    <!-- main content section ends here -->

<?php include('partials/admin-footer.php'); ?>