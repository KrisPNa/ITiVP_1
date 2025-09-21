<?php
require_once 'config.php';

// Проверяем, передан ли ID и новый статус
if (isset($_GET['id']) && isset($_GET['status'])) {
    $id = (int)$_GET['id'];
    $status = $_GET['status'] == 'выполнена' ? 'выполнена' : 'не выполнена'; // Простая валидация

    // Обновляем только статус
    $stmt = $pdo->prepare("UPDATE workout_logs SET status = ? WHERE id = ?");
    $stmt->execute([$status, $id]);
}

// Перенаправляем обратно на главную страницу
header('Location: index.php');
exit();
?>