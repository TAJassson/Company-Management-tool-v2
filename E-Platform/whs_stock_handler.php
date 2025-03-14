<?php
include_once 'db.php';
include_once('./whs_header.php');

//all post method come from m_product.php
if (isset($_POST["action"]) && !empty($_POST["action"])) {
    $action = $_POST['action'];

    //add new product
    if (strcmp($action,"Add Product") == 0) {
        ?>
        <div id="pricing" class="container-fluid">
            <table class="table table-bordered table-striped text-center">
                <h1>Add New Product stock:</h1><br>
                <form action="" method="GET">
                    <input type='hidden' name='action' value='Add Product_done'>
                    <input type='hidden' name='p_id' value=''>
                    product image link:<input type="text" name="img" value="" required><br>
                    product name:<input type="text" name="name" value="" required><br>
                    product stock:<input type="text" name="stock" value="" required><br>
                    product category:<input type="text" name="category" value="" required><br>
                    state:<select name="state" id="p_state">
                        <option value="enable">enable</option>
                        <option value="disable">disable</option>
                    </select>
                    <br><br>

                    <input type="submit" name="submit">
                </form>
            </table>
        </div>
        <?php
    }

    if(isset($_POST['p_id']) && !empty($_POST['p_id'])) {
        $p_id = $_POST['p_id'];
        $p_img = isset($_POST['p_img']) ? $_POST['p_img'] : '';
        $p_name = isset($_POST['p_name']) ? $_POST['p_name'] : '';
        $p_stock = isset($_POST['p_stock']) ? $_POST['p_stock'] : '';
        $p_category = isset($_POST['p_category']) ? $_POST['p_category'] : '';
        $p_state = isset($_POST['p_state']) ? $_POST['p_state'] : '';
    }

    //edit product
    if (strcmp($action,"edit") == 0) {
        ?>
        <div id="pricing" class="container-fluid">
        <table class="table table-bordered table-striped text-center">
            <td>
        <form action="" method="GET" >
            <h1 class="mx-auto-text-center">Form</h1>
            <input type='hidden' name='action' value='edit_done'>
            <input type='hidden' name='p_id' value='<?=$p_id?>'>
            <br>
            product image link:<input type="text" name="img" value="<?=$p_img?>" required><br>
            product name:<input type="text" name="name" value="<?=$p_name?>" required><br>
            product category:<input type="text" name="category" value="<?=$p_category?>" required><br>
            product stock:<input type="text" name="stock" value="<?=$p_stock?>" required><br>
            state:<select name="state" id="p_state" >
                <option value="enable">enable</option>
                <option value="disable">disable</option>
                </select>
                <br><br>
            <input type="submit" name="submit" class="btn btn-primary">
            </td>
        </form>
        </table>
        </div>
        <?php

    //delete
    } else if (strcmp($action,"delete") == 0) {
        $cart = "DELETE FROM stock_info WHERE p_id = '$p_id'";
        $result = mysqli_query($conn, $cart);

        $p_info = "DELETE FROM stock_info WHERE p_id = '$p_id'";
        $result = mysqli_query($conn, $p_info);
        header("Location: ./whs_stockmanagement.php");

    }

//all get action come from this php file
} else if (isset($_GET["action"]) && !empty($_GET["action"])) {
    $np_id = $_GET['p_id'];
    $n_action = $_GET['action'];
    $np_img = $_GET['img'];
    $np_name = $_GET['name'];
    $np_category = $_GET['category'];
    $np_stockt = $_GET['stock'];
    $np_state = $_GET['state'];

    //edit product, enter to database
    if (strcmp($_GET['action'],"edit_done") == 0 ) {

        $sql = "UPDATE stock_info SET p_name='$np_name',p_category='$np_category',p_stock='$np_stockt',p_img='$np_img', p_state='$np_state'WHERE p_id = '$np_id'";
        $result = mysqli_query($conn, $sql);
        //$numOfRecord = mysqli_num_rows($result);
        header("Location: ./whs_stockmanagement.php");

    //add product, enter to database
    }else if (strcmp($_GET['action'],"Add Product_done") == 0) {
        //(`p_id`, `p_name`, `p_description`, `p_category`, `p_cashpoint`, `p_img`, `p_state`)

        $sql = "INSERT INTO stock_info (p_id, p_name, p_category, p_stock, p_img, p_state) VALUES ('', '$np_name', '$np_category', '$np_stockt', '$np_img', '$np_state')";
        $result = mysqli_query($conn, $sql);
        header("Location: ./whs_stockmanagement.php");
    }

}
