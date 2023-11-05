$(document).ready(function () {
    $(window).on("load",
        function () {
            $.ajax({
                url: "my_notes_handler.php",
                type: "GET",
                success: function (dataResult) {
                    let mynotes = document.querySelector('.my_notes');
                    if (dataResult.length === 0){
                        mynotes.innerHTML = ` <div class="col-sm-6 mb-3">
                        <div class="card">
                            <div class="card-body">
                                <p class="card-text">Ближайших записей нет</p>
                            </div>
                        </div>
                    </div>`;
                    } else{
                        dataResult.forEach(function (element) {
                            const dateObj = new Date(element.date);
                            const MachineName = element.name;
                            const MachineStatus = element.is_active;
    
                            // Получение даты в формате "29 ноября"
                            const options = { day: "numeric", month: "long" };
                            const date = dateObj.toLocaleDateString("ru-RU", options);
    
                            // Получение времени в формате "15:00"
                            const time = dateObj.toLocaleTimeString("ru-RU", { hour: "2-digit", minute: "2-digit" });

                            let card = ` <div class="col-sm-6 mb-3">
                                            <div class="card">
                                                <div class="card-header">
                                                    <h5>${MachineName}</h5>
                                                </div>
                                                <div class="card-body">
                                                    <p class="card-text">Дата: ${date}</p>
                                                    <p class="card-text">Время: ${time}</p>
                                                    ${MachineStatus == '0' ? '<p class="card-text text-danger">Машинка не работает. Вы можете перенести запись на другую машинку</p>' : ""}
                                                </div>
                                            </div>
                                        </div>`;
    
                            mynotes.innerHTML += card;
                        });
                    }
                }
            });
        });
});