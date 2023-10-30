<?php
include 'config.php';
// Текущая дата
$user_id = $_COOKIE["id"];

$current_date = date("Y-m-d");

// Дата, на которую нужно вывести записи (текущий день + 6 дней)
$end_date = date("Y-m-d", strtotime("+6 days", strtotime($current_date)));

// SQL-запрос для выборки занятых записей в заданном диапазоне дат
$sql = "SELECT n.date, m.name
FROM notes AS n
JOIN machines AS m ON n.machine_id = m.id WHERE n.user_id = :user_id and n.date BETWEEN :current_date AND :end_date ORDER BY n.date ASC";
$stmt = $pdo->prepare($sql);
$stmt->bindParam(':current_date', $current_date);
$stmt->bindParam(':end_date', $end_date);
$stmt->bindParam(':user_id', $user_id);
$stmt->execute();
$occupied_dates = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Преобразование данных в формат JSON
$json_data = json_encode($occupied_dates);

// Установка заголовков для JSON-ответа
header('Content-Type: application/json');

// Отправка JSON-данных на клиентскую сторону
echo $json_data;
?>