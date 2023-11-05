let usersData = null;
let machinesData = null;

let Users = "get_users_handler.php";
let Machines = "get_machines_handler.php";

function getUsers() {
    $.getJSON(Users).done(function (data) {
        usersData = data;
        updateUsersTable();
    });
}

function getMachines() {
    $.getJSON(Machines).done(function (data) {
        machinesData = data;
        updateMachinesTable();
    });
}

function getStatusText(isActive) {
    return isActive === 1 ? 'Работает' : 'Не работает';
}

function getStatusClass(isActive) {
    return isActive === 1 ? 'btn-outline-success' : 'btn-outline-danger';
}


let updateStatusData = new Map();
function change_status(e) {
    if (e.innerHTML == "Работает") {
        e.innerHTML = "Не работает";
        e.classList.remove("btn-outline-success");
        e.classList.add("btn-outline-danger");
        e.value = '0';
        updateStatusData.set(e.id, e.value);
    } else if (e.innerHTML == "Не работает") {
        e.innerHTML = "Работает";
        e.classList.remove("btn-outline-danger");
        e.classList.add("btn-outline-success");
        e.value = '1';
        updateStatusData.set(e.id, e.value);
    }
}

function template(data) {
    let Result = '';

    // Создать строки HTML и вставить их в таблицу
    data.forEach(item => {
        Result += `
        <tr>
            <td>${item.id}</td>
            <td><a class="text-primary" href="user.php?id=${item.id}">${item.login}</a></td>
            <td>${item.room}</td>
        </tr>`;
    });

    return Result;
}

function updateUsersTable() {
    if (usersData === null) {
        return; // Ничего не делать, если данные еще не загружены
    }

    $('.pagination_container').pagination({
        dataSource: usersData,
        callback: function (data, pagination) {
            var html = template(data);
            $('#users_table').html(html);
            // Находим ul и добавляем класс "pagination" и "justify-content-center"
            const ulElement = document.querySelector('.pagination_container .paginationjs-pages ul');
            ulElement.classList.add('pagination', 'justify-content-center');

            // Находим все li элементы и добавляем класс "page-item"
            const liElements = document.querySelectorAll('.pagination_container .paginationjs-pages li');
            liElements.forEach((li) => {
                li.classList.add('page-item');
            });

            // Находим все a элементы внутри li элементов и добавляем класс "page-link"
            const aElements = document.querySelectorAll('.pagination_container .paginationjs-pages li a');
            aElements.forEach((a) => {
                a.classList.add('page-link');
            });
        }
    })
}

function updateMachinesTable() {
    if (machinesData === null) {
        return; // Ничего не делать, если данные еще не загружены
    }

    const Machinestable = document.getElementById('machines_table');

    let Result = '';

    // Создать строки HTML и вставить их в таблицу
    machinesData.forEach(item => {

        updateStatusData.set(item.id.toString(), item.is_active.toString());

        Result += `
        <tr>
        <td>${item.name}</td>
        <td class="text-success">
            <button id="${item.id}" value="${item.is_active}" onclick="change_status(this)" class="btn ${getStatusClass(item.is_active)}">${getStatusText(item.is_active)}</button>
        </td>
    </tr>`;
    });

    Machinestable.innerHTML = Result;

}

$(document).ready(function () {
    $(window).on("load",
        function () {

            getUsers();
            getMachines();

            updateUsersTable();
            updateMachinesTable();

        });

    $("#createUser").click(
        function () {
            var NameValue = $('#InputName').val();
            var SurnameValue = $('#InputSurname').val();
            var RoomValue = $('#InputRoom').val();
            var LoginValue = $('#InputLogin').val();
            var PasswordValue = $('#InputPassword').val();
            var RoleValue = $('#InputRole').val();

            document.querySelector("#createUser").setAttribute("disabled", "disabled");
            $("#createUser").html('<span class="spinner-border spinner-border-sm" aria-hidden="true"></span><span role="status"> Создание пользователя...</span>');


            $.ajax({
                url: "create_user_handler.php",
                type: "POST",
                data: {
                    name: NameValue,
                    surname: SurnameValue,
                    room: RoomValue,
                    login: LoginValue,
                    password: PasswordValue,
                    role: RoleValue
                }
            }).done(function (dataResult) {
                console.log(dataResult);
                if (dataResult == "ok") {
                    $('#alertSuccess').show();

                    $('#InputName').val('');
                    $('#InputSurname').val('');
                    $('#InputRoom').val('');
                    $('#InputLogin').val('');
                    $('#InputPassword').val('');
                    $('#InputRole').val('');

                    document.querySelector("#createUser").removeAttribute("disabled");
                    $("#createUser").html("Добавить пользователя");

                    getUsers();
                    updateUsersTable();

                    setTimeout(function () {
                        $('#alertSuccess').hide();
                    }, 2000);

                } else if (dataResult == "loginExistsError") {
                    $('#alertWarning').show();
                    document.querySelector("#createUser").removeAttribute("disabled");
                    $("#createUser").html("Добавить пользователя");
                } else {
                    $('#alertDanger').show();
                    document.querySelector("#createUser").removeAttribute("disabled");
                    $("#createUser").html("Добавить пользователя");
                }
            });
        }
    );

    $("#machinesBtn").click(
        function () {
            const jsonArray = Array.from(updateStatusData, ([id, is_active]) => ({ id, is_active }));
            document.querySelector("#machinesBtn").setAttribute("disabled", "disabled");
            $("#machinesBtn").html('<span class="spinner-border spinner-border-sm" aria-hidden="true"></span><span role="status"> Сохранение...</span>');

            $.ajax({
                url: "update_machines_status_handler.php",
                type: "POST",
                data: JSON.stringify(jsonArray),
                contentType: "application/json; charset=utf-8"
            }).done(function (dataResult) {
                if (dataResult == "ok") {
                    $('#alertSuccessMach').show();
                    document.querySelector("#machinesBtn").removeAttribute("disabled");
                    $("#machinesBtn").html("Сохранить");
                    setTimeout(function () {
                        $('#alertSuccessMach').hide();
                    }, 2000);
                } else {
                    $('#alertDangerMach').show();
                    document.querySelector("#machinesBtn").removeAttribute("disabled");
                    $("#machinesBtn").html("Сохранить");
                    setTimeout(function () {
                        $('#alertDangerMach').hide();
                    }, 2000);
                }
            })
        }
    );
})