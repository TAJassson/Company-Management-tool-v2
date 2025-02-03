<?php include_once('./m_header.php'); ?>
<?php
include_once 'db.php';
session_destroy();

?>
<div class="alert alert-success">
    <a href="Index.php" class="alert-link">Logging out...</a>
</div>
<script>
        window.setTimeout(function(){
            window.location.href = "Index.php";
        }, 100);
</script>
