<?php
require_once 'config.php';

// Инициализируем переменные пустыми значениями по умолчанию
$exercise_type = '';
$duration = '';
$title = '';
$description = '';
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Валидация и получение данных из формы
    $exercise_type = isset($_POST['exercise_type']) ? htmlspecialchars(trim($_POST['exercise_type'])) : '';
    $duration = isset($_POST['duration']) ? (int)$_POST['duration'] : 0;
    $title = isset($_POST['title']) ? htmlspecialchars(trim($_POST['title'])) : '';
    $description = isset($_POST['description']) ? htmlspecialchars(trim($_POST['description'])) : '';
    $status = 'не выполнена';

    // Простая проверка на заполненность обязательных полей
    if (!empty($exercise_type) && !empty($duration) && !empty($title)) {
        $sql = "INSERT INTO workout_logs (exercise_type, duration, title, description, status) VALUES (?, ?, ?, ?, ?)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$exercise_type, $duration, $title, $description, $status]);

        // Перенаправляем на главную после добавления
        header('Location: index.php');
        exit();
    } else {
        $error = "Пожалуйста, заполните все обязательные поля.";
    }
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Добавить тренировку</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2>Добавить запись о тренировке</h2>
        <?php if (!empty($error)): ?>
            <div class="alert alert-danger"><?= $error ?></div>
        <?php endif; ?>

        <form method="post">
            <div class="mb-3">
                <label for="exercise_type" class="form-label">Тип упражнения *</label>
                <input type="text" class="form-control" id="exercise_type" name="exercise_type" required 
                       value="<?= htmlspecialchars($exercise_type) ?>">
            </div>
            <div class="mb-3">
                <label for="duration" class="form-label">Длительность (минут) *</label>
                <input type="number" class="form-control" id="duration" name="duration" min="1" required 
                       value="<?= htmlspecialchars($duration) ?>">
            </div>
            <div class="mb-3">
                <label for="title" class="form-label">Название/Описание *</label>
                <input type="text" class="form-control" id="title" name="title" required 
                       value="<?= htmlspecialchars($title) ?>">
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Подробные заметки</label>
                <textarea class="form-control" id="description" name="description" rows="3"><?= htmlspecialchars($description) ?></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Добавить</button>
            <a href="index.php" class="btn btn-secondary">Отмена</a>
        </form>
    </div>
</body>
</html>