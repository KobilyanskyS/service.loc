<?php
// Удаление кук
setcookie("username", "", time() + 60 * 60 * 24 * 14, "/");
setcookie("role", "", time() + 60 * 60 * 24 * 14, "/");
setcookie("id", "", time() + 60 * 60 * 24 * 14, "/");

// Перенаправление пользователя на страницу входа или другую страницу по вашему выбору
header('Location: login.php');
exit;
?>
