<?php
include 'config.php';

$sql = "SELECT * FROM machines WHERE is_active = 1";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$machines = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Преобразование данных в формат JSON
$json_data = json_encode($machines);

// Установка заголовков для JSON-ответа
header('Content-Type: application/json');

// Отправка JSON-данных на клиентскую сторону
echo $json_data;
?>