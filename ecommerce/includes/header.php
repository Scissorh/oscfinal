<nav class="navbar navbar-expand-lg bg-dark">
    <div class="container-fluid">
        <!-- <a class="navbar-brand" href="">
                    <img src="./images/logo.jpg" alt="logo" class="logo">
                </a> -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mb-2 mb-lg-0">
                <li class="nav-item ">
                    <a class="nav-link text-white active" aria-current="page" href="index.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="display_all.php">Products</a>
                </li>
                <?php
                if (isset($_SESSION['username'])) {
                    echo "
                    <li class='nav-item'>
                    <a class='nav-link text-white' href='./profile.php'>My Account</a>
                    </li>
                    ";
                } else {
                    echo "
                    <li class='nav-item'>
                    <a class='nav-link text-white' href='./users/user_register.php'>Registration</a>
                    </li>
                    ";
                }
                ?>

                <li class="nav-item">
                    <a class="nav-link text-white" href="#">Contact</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="./cart.php"><i class="fa-solid fa-cart-shopping"></i><sup><?php cart_item();  ?></sup></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="#">Total Price: <?php total_cart_price();  ?>/-</a>
                </li>
            </ul>
            <form class="d-flex" action="search_product.php" method="get" style="margin-left: 520px;">
                <input class="form-control m-2" type="search" placeholder="Search" aria-label="Search" name="search_data">
                <!-- <button class="btn btn-outline-success" type="submit">Search</button> -->
                <input type="submit" value="search" class="btn border border-white text-white py-0" name="search_data_product">
            </form>
        </div>
    </div>
</nav>
<nav class="navbar navbar-expand-lg navbar-dark bg-secondary">
    <ul class="navbar-nav me-auto">

        <?php
        if (!isset($_SESSION['username'])) {
            echo
            "<li class='nav-item'>
                    <a class='nav-link' href='#'>Welcome guest</a>
                </li>";
        } else {
            echo
            "<li class='nav-item'>
                        <a class='nav-link' href=''>Welcome " . $_SESSION['username'] . "</a>
                        </li>";
        }
        if (!isset($_SESSION['username'])) {
            echo
            "<li class='nav-item'>
                        <a class='nav-link' href='./users/user_login.php'>Login</a>
                        </li>";
        } else {
            echo
            "<li class='nav-item'>
                        <a class='nav-link' href='./users/logout.php'>Logout</a>
                        </li>";
        }
        ?>
    </ul>
</nav>