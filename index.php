<?php
if (isset($_COOKIE["role"])) {
    ?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Запись</title>
        <link href="css/bootstrap.min.css" rel="stylesheet">
    </head>

    <body>
        <div class="container">


            <?php include 'config.php';
            include 'header.php'; ?>

            <div class="d-grid gap-2 d-md-flex justify-content-md-start">
                <a href="create_note.php" class="btn btn-primary btn-lg fl-end">Создать запись</a>
            </div>

            <h2>Мои записи</h2>
            <div class="row my_notes">

            </div>


        </div>

        <script src="js/bootstrap.bundle.min.js"></script>
        <script src="js/myNotesAjax.js"></script>

    </body>

    </html>

<?php } else {
    header('Location: login.php');
} ?>