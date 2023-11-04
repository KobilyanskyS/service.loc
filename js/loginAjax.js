$(document).ready(function () {
    $("#sendBtn").click(
        function () {
            $("#sendBtn").html(`<span class="spinner-border spinner-border-sm"></span><span role="status">Вход...</span>`);
            $("#sendBtn").attr('disabled');
            var loginValue = $('#exampleInputEmail1').val();
            var passwordValue = $('#exampleInputPassword1').val();

            $.ajax({
                url: "login_handler.php",
                type: "POST",
                data: {
                    username: loginValue,
                    password: passwordValue
                }
            })
                .done(function (dataResult) {
                    if (dataResult == "ok") {
                        $(".modal-body").html(`<div class="alert alert-success d-flex align-items-center" role="alert">
                                                <div>
                                                    <h4>Вы успешно зашли!</h4>
                                                    <p>Вы отправляетесь на главную страницу</p>
                                                </div>
                                            </div>`);
                        $("#sendBtn").hide();
                        setTimeout(function () {
                            window.location.href = "index.php";
                        }, 2000);
                    }
                    else if (dataResult == "fail") {
                        $(".modal-body").html(`<div class="alert alert-danger d-flex align-items-center" role="alert">
                                                <div>
                                                    <h4>Что-то пошло не так</h4>
                                                    <p>Проверьте свой логин и пароль</p>
                                                </div>
                                            </div>`);
                        $("#sendBtn").hide();
                        setTimeout(function () {
                            $(".modal-body").html(`<div class="mb-3">
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
                                                    </div>`);
                            $("#sendBtn").show();
                            $("#sendBtn").html("Войти");
                        }, 2000);
                    }
                });

        });
});