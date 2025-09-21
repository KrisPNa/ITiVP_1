<?php
require_once 'config.php';

// Проверяем, передан ли ID
if (isset($_GET['id'])) {
    $id = (int)$_GET['id'];

    // Подготовленный запрос для безопасного удаления
    $stmt = $pdo->prepare("DELETE FROM workout_logs WHERE id = ?");
    $stmt->execute([$id]);
}

// Перенаправляем обратно на главную страницу
header('Location: index.php');
exit();
?>