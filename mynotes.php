<?php 
    if (isset($_COOKIE["username"])) {
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <title>Мои записи</title>

</head>

<body>
    <?php include 'header.php';?>
    <div class="container">
        <h1>Мои записи</h1>
        <div class="my_notes">

        </div>
    </div>



<script src="js/bootstrap.bundle.js"></script>
<script src="js/jquery.min.js"></script>
<script src="js/myNotesAjax.js"></script>
</body>

</html>
<?php } else { header('Location: login.php'); }?>