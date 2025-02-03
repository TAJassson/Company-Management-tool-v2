<?php include_once('./header.php'); ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Our Product</title>
    <script src="jquery.js"></script>

</head>
<h2 align='center'></h2>
<body class="body">

<form method="GET" align='center'>
<label for="search">Type of search:</label>
<select id="search" name="search" class="search" >
    <option name="c_search" value="-1">Default</option>
    <option name="c_search" value="c_search">category search</option>
    <option name="k_search" value="k_search" >keyword search</option>
    <option name="p_search" value="p_search">point range search</option>
</select>
    <input type="text" id="2" name="min" placeholder="min range">
    <input type="text" id="3" name="max" placeholder="max range">
    <input type="text" name="s_text" id="s_text" class="text" >
    <input type="submit" value="Search">
</select>
</form>

<script>
    $(document).ready(function(){
        //hide all input area
        $(".text").hide();
        $("#2").hide();
        $("#3").hide();
        $(".search").change(function(){
            var conceptName = $('#search :selected').val();
            //hide input text, show point range area
            if (conceptName == "p_search") {
                $(".text").hide();
                $("#2").show();
                $("#3").show();
            //hide all area
            }else if (conceptName == "-1"){
                $(".text").hide();
                $("#2").hide();
                $("#3").hide();
            //show input text, hide point range area
            }else {
                $(".text").show();
                $("#2").hide();
                $("#3").hide();
            }
        });
    });
</script><br><br>


<?php
    include_once 'db.php';

    if (isset($_GET["search"]) && !empty($_GET["search"])) {
        $search = $_GET["search"];
        //category search statement
        if ($_GET["search"] == "c_search") {
            $s_text = $_GET["s_text"];
            $sql = "SELECT * FROM product_info WHERE p_state='enable' and p_category LIKE \"%$s_text%\"";
            $result=mysqli_query($conn,$sql);

        // point range search statement
        }else if ($_GET["search"] == "p_search") {
            $min_range = $_GET["min"];
            $max_range = $_GET["max"];
            $sql = "SELECT * FROM product_info WHERE p_state='enable' and p_cashpoint BETWEEN $min_range AND $max_range";
            $result=mysqli_query($conn,$sql);

        //keyword search statement
        }else if ($_GET["search"] == "k_search") {
            $s_text = $_GET["s_text"];
            $sql = "SELECT * FROM product_info WHERE p_state='enable' and p_name LIKE \"%$s_text%\"";
            $result=mysqli_query($conn,$sql);//result is a PHP array
            $num_rows=mysqli_num_rows($result);
        //default search statement
        }else {
            $sql = "SELECT * FROM product_info WHERE p_state='enable'";
            $result = mysqli_query($conn, $sql);//result is a PHP array
            $num_rows = mysqli_num_rows($result);
        }
    //default search statement
    }else {
        $sql = "SELECT * FROM product_info WHERE p_state='enable'";
        $result=mysqli_query($conn,$sql);//result is a PHP array
        $num_rows=mysqli_num_rows($result);
    }


    echo '<div class="row row-cols-3 row-cols-md-2 g-4 ">';
    while ($row = mysqli_fetch_assoc($result)){
        $p_id = $row["p_id"];
        $p_name = $row["p_name"];
        $p_description = $row["p_description"];
        $p_category = $row["p_category"];
        $p_cashpoint = $row["p_cashpoint"];
        $p_img = $row["p_img"];
        ?>
 <div class="card mx-auto" style="width: 19rem;">
    <form method='post' action='addCart.php'>
    <img src="<?=$p_img?>" class="card-img-top" alt="...">
    <div class="card-body ">
        <input type='hidden' name='action' value='add'>
        <input type='hidden' name='p_id' value='<?=$p_id?>' id='p_id'>
        <h5 class="card-title"><?=$p_name?></h5>
        <p class="card-text"><?=$p_description?></p>
        <h6 class="card-text"><?=$p_cashpoint?> $HKD</h6>
        Quantity: <input id='quantity' type='number' name='quantity' value='1' min='1' max='10000'><br><br>
        <input name='submit' class="btn btn-primary" type='submit' value='Add to Cart'>
    </form>
    </div>
</div>
<?php

    }
    echo '</div>';
    mysqli_close($conn);
    ?>
</body>
</html>


