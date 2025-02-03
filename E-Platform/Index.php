<?php include_once('./header.php'); ?>
<html>
    <head>
        <meta charset="utf-8">
        <script src="jquery.js"></script>
        <title>Login @ GBM</title>
        <style>
            .form-horizontal{
                display:block;
                width:50%;
                margin:0 auto;
            }
        </style>
    </head>
    <body>
    <?php if (isset($_SESSION["id"]) && !empty($_SESSION["id"])) { ?>
        <div class="alert alert-danger">
            <a href="Profile.php" class="alert-link">Login already!</a>
        </div>
        <script>
            if(<?=isset($_SESSION["id"]) && !empty($_SESSION["id"])?>) {
                window.setTimeout(function(){
                    window.location.href = "productList.php";
                }, 100);
            }
        </script>
    <?php }else {?>
    <form class="row w-50 p-3 form-horizontal" action="login_handler.php" method="post">
        <h1>Customer Login</h1>
        <div class="col-md-6">
            <label for="inputName" class="form-label">Customer ID:</label>
            <input type="text" class="form-control" id="inputName" name="username" required>
        </div>
        <div class="col-md-6">
            <label for="inputPassword" class="form-label">Password:</label>
            <input type="password" class="form-control" id="inputPassword" name="password" required>
        </div>
        <br>
        <div class="col-12">
            <button type="submit" class="btn btn-primary">Sign in</button>
            <a href='sign.php'>Create customer ID</a>
        </div>
    </form>
    <?php } ?>
    </body>
</html>
