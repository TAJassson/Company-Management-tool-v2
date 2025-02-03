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
<form class="row w-50 p-3 form-horizontal" action="conactUs_handler.php" method="post">
    <h1>Contact Us</h1>
    <div class="col-md-9">
        <label for="inputName" class="form-label">Name:</label>
        <input type="text" class="form-control" id="inputName" name="name" required>
    </div>
    <div class="col-9">
        <label for="inputPhone" class="form-label">Phone:</label>
        <input type="text" class="form-control" id="inputPhone" name="phone" required>
    </div>
    <div class="col-md-9">
        <label for="inputEmail" class="form-label">Email:</label>
        <input type="email" class="form-control" id="inputEmail" name="email" required>
    </div>
    <div class="mb-3">
        <label for="textarea" class="form-label">Textarea:</label>
        <textarea class="form-control" id="textarea" rows="5" name="textarea" required></textarea>
    </div>
    <br>
    <div class="col-12">
        <button type="submit" class="btn btn-primary">Contact Us</button>
    </div>
</form>
</body>
</html>



