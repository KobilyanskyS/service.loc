async function getDateTime(e) {
    let datetimeValue = e.getAttribute('value');
    let machineIdValue = document.querySelector("select").value;


    const dateObj = new Date(datetimeValue);

    // Получение даты в формате "29 ноября"
    const options = { day: "numeric", month: "long" };
    const date = dateObj.toLocaleDateString("ru-RU", options);

    // Получение времени в формате "15:00"
    const time = dateObj.toLocaleTimeString("ru-RU", { hour: "2-digit", minute: "2-digit" });

    // Устанавливаем значение для input и span
    let inputElement = document.querySelector('input[name=date]');
    let dateSpan = document.querySelector('.date');
    let timeSpan = document.querySelector('.time');
    let machineSpan = document.querySelector('.machine');

    inputElement.setAttribute('value', datetimeValue);
    dateSpan.innerHTML = date;
    timeSpan.innerHTML = time;
    machineSpan.innerHTML = machineIdValue;
};