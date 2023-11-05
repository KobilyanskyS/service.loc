<?php
if (isset($_COOKIE["username"])) {
    if ($_COOKIE["role"] == "admin") {
        ?>
        <!DOCTYPE html>
        <html>

        <head>
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <link href="css/bootstrap.min.css" rel="stylesheet">
            <title>Админ-панель</title>
            <style>
                .page-item{
                    cursor: pointer;
                }
            </style>
        </head>

        <body>
            <?php include 'header.php'; ?>

            <div class="container">
                <div class="row">
                    <div class="col-xl-4 col-xxl-4">
                        <h2>Добавление пользователей</h2>
                        <div class="form border p-2 rounded">
                            <div class="mb-3">
                                <label for="InputName" class="form-label">Имя</label>
                                <input type="text" class="form-control" id="InputName">
                            </div>
                            <div class="mb-3">
                                <label for="InputSurname" class="form-label">Фамилия</label>
                                <input type="text" class="form-control" id="InputSurname">
                            </div>
                            <div class="mb-3">
                                <label for="InputRoom" class="form-label">Номер комнаты</label>
                                <input type="text" class="form-control" id="InputRoom">
                            </div>
                            <div class="mb-3">
                                <label for="InputLogin" class="form-label">Логин</label>
                                <input type="text" class="form-control" id="InputLogin">
                            </div>
                            <div class="mb-3">
                                <label for="InputPassword" class="form-label">Пароль</label>
                                <input type="text" class="form-control" id="InputPassword">
                            </div>
                            <div class="mb-3">
                                <label for="InputRole" class="form-label">Роль</label>
                                <select type="text" class="form-control" id="InputRole">
                                    <option value="user">Пользователь</option>
                                    <option value="admin">Администратор</option>
                                </select>
                            </div>

                            <button type="submit" class="btn btn-primary mb-3" id="createUser">Добавить пользователя</button>

                            <div class="alert alert-success" id="alertSuccess" role="alert" style="display: none;">
                                <span>Пользователь добавлен</span>
                            </div>

                            <div class="alert alert-warning" id="alertWarning" role="alert" style="display: none;">
                                <span>Пользователь с таким логином уже существует</span>
                            </div>

                            <div class="alert alert-danger" id="alertDanger" role="alert" style="display: none;">
                                <span>Что-то пошло не так :<< /span>
                            </div>
                        </div>
                    </div>


                    <div class="col-xl-8 col-xxl-8">
                        <h2>Список</br>пользователей</h2>
                        <div class="user_list border p-2 rounded">
                            <table class="table border p-2 rounded">
                                <h5>Найти пользователей</h5>
                                <thead>
                                    <tr>
                                        <th><input class="form-control" type="text" placeholder="По логину"></th>
                                        <th><input class="form-control" type="text" placeholder="По комнате"></th>
                                    </tr>
                                </thead>
                            </table>
                            <table class="table border table-hover">
                                <thead>
                                    <tr>
                                        <th scope="col">Id</th>
                                        <th scope="col">Логин</th>
                                        <th scope="col">Комната</th>
                                    </tr>
                                </thead>
                                <tbody id="users_table">
                                    <!-- Data From Server -->
                                </tbody>
                            </table>

                            <div class="pagination_container">
                                <!-- Pagination buttons -->
                            </div>

                        </div>
                    </div>

                </div>

                <div class="row mt-4 mb-4">
                    <div class="col-xl-4 col-xxl-4">
                        <h2>Состояние машинок</h2>
                        <div class="machines_status border p-2 rounded">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th scope="col">Машинка</th>
                                        <th scope="col">Состояние</th>
                                    </tr>
                                </thead>
                                <tbody id="machines_table">
                                    <!-- Data From Server -->
                                </tbody>
                            </table>

                            <button class="btn btn-primary mb-3" id="machinesBtn">Сохранить</button>

                            <div class="alert alert-success" id="alertSuccessMach" role="alert" style="display: none;">
                                <span>Состояние машинок обновлено</span>
                            </div>

                            <div class="alert alert-danger" id="alertDangerMach" role="alert" style="display: none;">
                                <span>Что-то пошло не так :<< /span>
                            </div>

                        </div>
                    </div>
                </div>


            </div>

            <script src="js/adminPanel.js"></script>
            <script src="js/bootstrap.bundle.min.js"></script>
            <script src="js/pagination.min.js"></script>
        </body>

        </html>

    <?php } else {
        header('HTTP/1.0 403 Forbidden');
    }
} else {
    header('Location: login.php');
} ?>