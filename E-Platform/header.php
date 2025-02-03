<!-- CSS only -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>

<?php session_start(); ?>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="https://localhost">
            E-shop @ GBM
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarText">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link" href="https://localhost">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="productList.php">Product</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="user_profile.php">Profile</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="view_order.php">Order</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="shoppingCart.php">Cart</a>
                </li>
            </ul>
            <?php if (isset($_SESSION["id"]) && !empty($_SESSION["id"])) {
                ?>
                <a class="btn btn-outline-success" href='logout.php'>Logout</a>
            <?php }else { ?>
                <a class="btn btn-outline-success" href='index.php'>Login</a>
            <?php } ?>
        </div>
    </div>
</nav>


