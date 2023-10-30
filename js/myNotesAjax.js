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
    
                            // Получение даты в формате "29 ноября"
                            const options = { day: "numeric", month: "long" };
                            const date = dateObj.toLocaleDateString("ru-RU", options);
    
                            // Получение времени в формате "15:00"
                            const time = dateObj.toLocaleTimeString("ru-RU", { hour: "2-digit", minute: "2-digit" });

                            let card = ` <div class="col-sm-6 mb-3">
                                            <div class="card">
                                                <h5 class="card-header">${MachineName}</h5>
                                                <div class="card-body">
                                                    <p class="card-text">Дата: ${date}</p>
                                                    <p class="card-text">Время: ${time}</p>
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