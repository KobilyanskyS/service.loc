<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h2>Регистрация</h2>
    <form method="POST" action="reg_handler.php">
        <label for="username">Логин:</label>
        <input type="text" name="username" required><br>
        <label for="password">Пароль:</label>
        <input type="password" name="password" required><br>
        <input type="submit" value="Зарегистрироваться">
    </form>
</body>
</html>