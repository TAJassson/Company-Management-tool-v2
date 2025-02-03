<?php include_once('./header.php'); ?>
<html>
<head>
        <style>
            .form-horizontal{
                display:block;
                width:50%;
                margin:0 auto;
            }
        </style>
    <meta charset="utf-8">
</head>
<body>
<form class="row w-50 p-3 form-horizontal" action="sign_handler.php" method="post">
    <h1>Sign in</h1>
    <div class="col-md-9">
        <label for="inputName" class="form-label">User name:</label>
        <input type="text" class="form-control" id="inputName" name="username" required>
    </div>
    <div class="col-md-9">
        <label for="inputPassword" class="form-label">Password:</label>
        <input type="password" class="form-control" id="inputPassword" name="password" required>
    </div>
    <div class="col-9">
        <label for="input_cof_pass" class="form-label">Confirm password:</label>
        <input type="paswword" class="form-control" id="input_cof_pass" name="cof_Password" required>
    </div>
    <div class="col-9">
        <label for="inputPhone" class="form-label">Company Phone:</label>
        <input type="text" class="form-control" id="inputPhone" name="phone" required>
    </div>
    <div class="col-md-9">
        <label for="inputEmail" class="form-label">Company Email:</label>
        <input type="email" class="form-control" id="inputEmail" name="email" required>
    </div>

    <br>
    <h2>Business infomation</h2>
    <div class="col-md-9">
        <label for="inputAdd1" class="form-label">Legal company name</label>
        <input type="text" class="form-control" id="inputAdd1" name="add1" required>
    </div>
    <div class="col-md-9">
        <label for="br" class="form-label">Business registration number</label>
        <input type="text" class="form-control" id="br" name="br" required>
    </div>
    <div class="col-md-9">
        <label for="bank" class="form-label">Bank account</label>
        <input type="text" class="form-control" id="bank" name="bank" required>
    </div>
    <div class="col-md-9">
        <label for="inputAdd2" class="form-label">Unit, Floor, Building:</label>
        <input type="text" class="form-control" id="inputAdd2" name="add2" required>
    </div>
    <div class="col-md-9">
        <label for="inputAdd3" class="form-label">Estate, Street,  Street No:</label>
        <input type="text" class="form-control" id="inputAdd3" name="add3" required>
    </div>
    <div class="col-md-9">
        <label for="inputAdd4" class="form-label">District, Region OR Area</label>
        <input type="text" class="form-control" id="inputAdd4" name="add4" required>
    </div>
    <div class="col-md-9">
        <label for="inputAdd4" class="form-label">City or Country</label>
        <input type="text" class="form-control" id="inputAdd4" name="add5" value="Hong Kong" disabled>
    </div>
    <br><br>
    <div class="col-12">
        <button type="submit" class="btn btn-primary">Sign in</button>
    </div>

</form>
</body>
</html>
