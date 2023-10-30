$(document).ready(function () {
    $("#sendBtn").click(
        function () {
            var dateValue = $('#date').val();
            var userIdValue = $.cookie("id");
            var machineIdValue = $('.select').val();
            $("#sendBtn").attr('disabled');
            $("#sendBtn").html('<span class="spinner-border spinner-border-sm" aria-hidden="true"></span><span role="status">Создание записи...</span>');


            $.ajax({
                url: "create_note_handler.php",
                type: "POST",
                data: {
                    date: dateValue,
                    user_id: userIdValue,
                    machine_id: machineIdValue
                }
            })
                .done(function (dataResult) {
                    console.log(dataResult);
                    if (dataResult == "ok"){
                        $(".notification").html(`<div class="alert alert-success d-flex align-items-center" role="alert">
                        <div>
                            <h4>Запись создана!</h4>
                            <p>Вы отправляетесь на главную страницу</p> 
                        </div>
                    </div>`);
                    $("#sendBtn").hide();
                    
                    
                    setTimeout(function(){
                        window.location.href = "index.php";
                      }, 2000);
                    } else if (dataResult == "fail") {
                        $(".notification").html(`<div class="alert alert-warning d-flex align-items-center" role="alert">
                        <div>
                            <h4>Превышено количество записей!</h4>
                            <p>У вас максимальное количество записей на этой неделе. Вы можете записаться только в понедельник следующей недели.</p> 
                        </div>
                        </div>`);
                        $("#sendBtn").hide();
                        setTimeout(function(){
                            window.location.href = "index.php";
                          }, 5000);
                    } else if (dataResult == "occupied") {
                        $(".notification").html(`<div class="alert alert-warning d-flex align-items-center" role="alert">
                        <div>
                            <h4>Запись на это время уже заняли :<</h4>
                            <p>Запишитесь на другое время</p> 
                        </div>
                        </div>`);
                        $("#sendBtn").hide();
                        setTimeout(function(){
                            window.location.href = "index.php";
                          }, 5000);
                    }
                });
        });
});