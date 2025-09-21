// PhpMyAdmin
<?php
 $host = 'mysql-8.0';
 $dbname = 'task_manager'; 
 $username = ''; // Ваше имя пользователя для базы данных
 $password = ''; // Ваш пароль для базы данных
try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Ошибка подключения к базе данных: " . $e->getMessage());
}

?>
