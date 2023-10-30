<?php
include 'config.php';

$desired_datetime = $_POST['date'];
$user_id = $_POST['user_id'];
$machine_id = $_POST['machine_id'];

// Текущая дата
$current_date = date("Y-m-d");

// Проверка количества записей пользователя на текущей неделе
$sql = "SELECT COUNT(*) FROM notes WHERE user_id = :user_id AND YEARWEEK(date, 1) = YEARWEEK(:current_date, 1)";
$stmt = $pdo->prepare($sql);
$stmt->bindParam(':user_id', $user_id);
$stmt->bindParam(':current_date', $current_date);
$stmt->execute();
$count = $stmt->fetchColumn();

$max_appointments_per_week = 2;

if ($count < $max_appointments_per_week) {
    // Проверяем свободна ли запись
    $sql2 = "SELECT COUNT(*) FROM notes WHERE date = :desired_datetime";
    $stmt2 = $pdo->prepare($sql2);
    $stmt2->bindParam(':desired_datetime', $desired_datetime);
    $stmt2->execute();
    $count2 = $stmt2->fetchColumn();
    if ($count2 > 0) {
        echo "occupied";
    } else {
        // Все проверки пройдены, создаём запись
        $insert_sql = "INSERT INTO notes (user_id, machine_id, date) VALUES (:user_id, :machine_id, :desired_datetime)";
        $insert_stmt = $pdo->prepare($insert_sql);
        $insert_stmt->bindParam(':user_id', $user_id);
        $insert_stmt->bindParam(':machine_id', $machine_id);
        $insert_stmt->bindParam(':desired_datetime', $desired_datetime);
        $insert_stmt->execute();
        echo 'ok';
    }
} else {
    echo "fail";
}
?>