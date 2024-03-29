<?php
if (isset($_COOKIE["username"])) {
    if ($_COOKIE["role"] == "admin") {
        include 'config.php';

        $sql = "SELECT * FROM machines";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $machines = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Преобразование данных в формат JSON
        $json_data = json_encode($machines);

        // Установка заголовков для JSON-ответа
        header('Content-Type: application/json');

        // Отправка JSON-данных на клиентскую сторону
        echo $json_data;
    } else {
        header('HTTP/1.0 403 Forbidden');
    }
} else {
    header('Location: login.php');
}
?>