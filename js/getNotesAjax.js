var notesJsonData = null;
var machinesJsonData = null;

$(document).ready(function () {
    $(window).on("load", function () {
        var notes_server = "get_notes_handler.php";
        var machines_server = "get_active_machines_handler.php";

        $.getJSON(machines_server).done(function (data) {
            machinesJsonData = data; // Сохранить данные в глобальной переменной
            updateSelect(); // Обновить таблицу при загрузке страницы
        });

        // Загрузить JSON данные при загрузке страницы
        $.getJSON(notes_server).done(function (data) {
            notesJsonData = data; // Сохранить данные в глобальной переменной
            updateTable(); // Обновить таблицу при загрузке страницы
        });


        $('.select').on('change', function () {
            updateTable();
        });

        function updateSelect(){
            if (machinesJsonData === null) {
                return; // Ничего не делать, если данные еще не загружены
            }

            const select = document.querySelector('.select'); 

            let Result = '';
        
            // Создать строки HTML и вставить их в таблицу
            machinesJsonData.forEach(item => {
                Result += `<option value="${item.id}">${item.name}</option>`;
            });
        
            select.innerHTML = Result;
        }

        function updateTable() {
            if (notesJsonData === null) {
                return; // Ничего не делать, если данные еще не загружены
            }

            var selectedMachine = parseInt($('.select').val());

            const filteredData = notesJsonData.filter(item => selectedMachine === 0 || item.machine_id === selectedMachine);

            const dates = filteredData.map(item => {
                const date = moment(item.date);

                return {
                    day: date.format('YYYY-MM-DD'),
                    hour: date.format('HH:mm'),
                }
            });

            const today = moment();
            let uniqueDates = [];
            for (let i = 0; i < 7; i++) {
                uniqueDates.push(moment(today).add(i, 'days').format('YYYY-MM-DD'));
            }

            let theadHTML = '<thead><tr>';
            let tbodyHTML = '';

            uniqueDates.forEach(date => {
                theadHTML += `<th scope="col">${moment(date).format('DD.MM.YYYY')}</th>`;
            });

            theadHTML += '</tr></thead>';

            for (let hour = 9; hour <= 23; hour++) {
                const hourStr = hour.toString().padStart(2, '0') + ":00";
                tbodyHTML += '<tr>';

                uniqueDates.forEach(date => {
                    const isDisabled = dates.find(d => d.day === date && d.hour === hourStr) ? true : false;
                    const btnClass = isDisabled ? 'btn-secondary' : 'btn-primary';
                    const disabledAttr = isDisabled ? 'disabled' : '';
                    const valueAttr = !isDisabled ? `value="${date} ${hourStr}:00"` : '';
                    const modalAttr = !isDisabled ? `data-bs-target="#exampleModalToggle" data-bs-toggle="modal"` : '';
                    tbodyHTML += `<td><button type="button" class="btn ${btnClass}" ${disabledAttr} ${valueAttr} ${modalAttr} onclick="getDateTime(this)">${hourStr}</button></td>`;
                });

                tbodyHTML += '</tr>';
            }

            tbodyHTML = `<tbody>${tbodyHTML}</tbody>`;

            document.querySelector('.tb').innerHTML = `${theadHTML}${tbodyHTML}`;
        }
        updateSelect();
        updateTable();
    });
});
