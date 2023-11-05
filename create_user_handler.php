<?php
if (isset($_COOKIE["username"])) {
    if ($_COOKIE["role"] == "admin") {
        // Подключение к базе данных
        include 'config.php';

        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $name = $_POST["name"];
            $surname = $_POST["surname"];
            $room = $_POST["room"];
            $login = $_POST["login"];
            $password = password_hash($_POST["password"], PASSWORD_BCRYPT);
            $role = $_POST["role"];

            // Проверка, не существует ли пользователь с таким именем
            $check_user_sql = "SELECT id FROM users WHERE login = :login";
            $stmt = $pdo->prepare($check_user_sql);
            $stmt->bindParam(':login', $login);
            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                echo "loginExistsError";
            } else {
                // Создание пользователя
                $insert_user_sql = "INSERT INTO users (login, hashed_password, name, surname, room, role) VALUES (:login, :password, :name, :surname, :room, :role)";
                $insert_stmt = $pdo->prepare($insert_user_sql);
                $insert_stmt->bindParam(':login', $login);
                $insert_stmt->bindParam(':password', $password);
                $insert_stmt->bindParam(':name', $name);
                $insert_stmt->bindParam(':surname', $surname);
                $insert_stmt->bindParam(':room', $room);
                $insert_stmt->bindParam(':role', $role);
                $insert_stmt->execute();

                echo "ok";
            }
        }
    } else {
        header('HTTP/1.0 403 Forbidden');
    }
} else {
    header('Location: login.php');
}
?>