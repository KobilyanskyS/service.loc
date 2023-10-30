<?php
// Подключение к базе данных
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Поиск пользователя с введенным именем
    $check_user_sql = "SELECT id, hashed_password, role FROM users WHERE login = :username";
    $stmt = $pdo->prepare($check_user_sql);
    $stmt->bindParam(':username', $username);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        $row = $stmt->fetch();
        $id = $row['id'];
        $hashed_password = $row["hashed_password"];
        $user_role = $row["role"];

        // Проверка пароля
        if (password_verify($password, $hashed_password)) {
            // Успешная авторизация
            // Создание cookie с информацией о пользователе
            echo "ok";
            setcookie("username", $username, time() + 60 * 60 * 24 * 14, "/");
            setcookie("role", $user_role, time() + 60 * 60 * 24 * 14, "/");
            setcookie("id", $id, time() + 60 * 60 * 24 * 14, "/");
        } else {
            echo "fail";
        }
    } else {
        echo "fail";
    }
}
?>