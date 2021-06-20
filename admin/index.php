<?php include('partials/admin-header.php'); ?>

    <!-- main content section starts here -->
    <div class="main-content">
        <div class="wrapper">
            <h1>Welcome Admin</h1>
            <br><br>

            <?php
                if(isset($_SESSION['login'])){
                    echo $_SESSION['login'];
                    unset($_SESSION['login']);
                }
            ?>
        </div>
    </div>
    <!-- main content section ends here -->

<?php include('partials/admin-footer.php'); ?>