<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Calendar</title>

    <link href="css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container">
        <?php include 'header.php'; ?>

        <select class="form-select mb-4 select" aria-label="Default select example"
            aria-placeholder="Выберите машинку">
            <option value="1">Машинка 1</option>
            <option value="2">Машинка 2</option>
            <option value="3">Машинка 3</option>
            <option value="4">Машинка 4</option>
        </select>
        <!-- Таблица, в которую мы загружаем данные -->
        <div class="overflow-y-scroll">
            <table class="table table-bordered tb"></table>
        </div>

        <div class="modal fade" id="exampleModalToggle" aria-hidden="true" aria-labelledby="exampleModalToggleLabel"
            tabindex="-1">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalToggleLabel">Создать запись</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body notification">
                        <p>Машинка: <span class="machine"></span></p>
                        <p>Дата: <span class="date"></span></p>
                        <p>Время: <span class="time"></span></p>
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" id="date" name="date" value="">
                        <button type="submit" class="btn btn-primary" id="sendBtn">Создать запись</button>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <script src="js/moment.min.js"></script>
    <script src="js/jquery.min.js"></script>
    <script src="js/jquery.cookie.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/getNotesAjax.js"></script>
    <script src="js/createNoteAjax.js"></script>
    <script src="js/buttonsHandler.js"></script>
</body>

</html>