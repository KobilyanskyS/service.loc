<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Войти в профиль</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <nav id="target" class="navbar navbar-expand-lg navbar-light mb-2">
        <div class="container border-bottom pb-3">
            <a class="navbar-brand" href="#">
                Записи
            </a>
        </div>
    </nav>





    <div class="container">
        <div class="modal fade show" id="exampleModalCenter" tabindex="-1" aria-labelledby="exampleModalCenterTitle"
            style="display: block;" aria-modal="true" role="dialog">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalCenterTitle">Войти в учетную запись</h1>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Логин</label>
                            <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                                name="username">
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label">Пароль</label>
                            <input type="password" class="form-control" id="exampleInputPassword1" name="password">
                        </div>
                        <div class="mb-3 form-check">
                            <input type="checkbox" class="form-check-input" id="exampleCheck1">
                            <label class="form-check-label" for="exampleCheck1">Показать пароль</label>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-primary centered" id="sendBtn" type="submit">Войти</button>
                    </div>

                </div>

            </div>
        </div>



        <script src="js/jquery.min.js"></script>
        <script src="js/loginAjax.js"></script>
    </div>

    <script src="js/bootstrap.bundle.min.js"></script>
</body>

</html>