<?php
// Подключение к базе данных
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = $_POST["username"];
    $password = password_hash($_POST["password"], PASSWORD_BCRYPT);
    $role = "admin";

    // Проверка, не существует ли пользователь с таким именем
    $check_user_sql = "SELECT id FROM users WHERE login = :username";
    $stmt = $pdo->prepare($check_user_sql);
    $stmt->bindParam(':username', $username);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        echo "Пользователь с таким именем уже существует. Пожалуйста, выберите другое имя.";
    } else {
        // Регистрация пользователя
        $insert_user_sql = "INSERT INTO users (login, hashed_password, role) VALUES (:username, :password, :role)";
        $insert_stmt = $pdo->prepare($insert_user_sql);
        $insert_stmt->bindParam(':username', $username);
        $insert_stmt->bindParam(':password', $password);
        $insert_stmt->bindParam(':role', $role);
        $insert_stmt->execute();

        setcookie("username", $username, time() + 3600, "/");
        setcookie("role", $role, time() + 3600, "/");

        echo "Регистрация прошла успешно. <a href='login.php'>Войдите</a> с вашими учетными данными.";
    }
}
?>