<?php 
    require __DIR__ . "/vendor/autoload.php";

    $dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
    $dotenv->load();

    $pdo = new PDO(sprintf('mysql:host=%s;dbname=%s', $_ENV["DATABASE_HOSTNAME"], $_ENV["DATABASE_NAME"]) ,$_ENV["DATABASE_USERNAME"], $_ENV["DATABASE_PASSWORD"]);

?>