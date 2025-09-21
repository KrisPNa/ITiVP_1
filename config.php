<?php
 $host = 'mysql-8.0'; // Ваш хост (обычно localhost)
 $dbname = 'task_manager'; // Название вашей базы данных
 $username = 'root'; // Ваше имя пользователя для базы данных
 $password = ''; // Ваш пароль для базы данных
try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Ошибка подключения к базе данных: " . $e->getMessage());
}
?>