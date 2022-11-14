<!DOCTYPE html>
<?php
ob_start();
session_start();
if(!isset($_SESSION['emailuser']))
{
    header("location:login.php");
}
?>


<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WISATA</title>
<head>
<body>
<?php include "header.php"; ?>

    <div class="jumbotron jumbotron-fluid">
        <div class="container">
            <h1 class="display-4">DAHBOARD ADMIN</h1>
        </div>
    </div>
<?php include "footer.php"; ?>

</body>
<?php 
// hapus mysqli_close($connection);
ob_end_flush();
?>
</html>