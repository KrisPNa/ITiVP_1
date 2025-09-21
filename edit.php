<?php
require_once 'config.php';

// Проверяем, передан ли ID в запросе
if (!isset($_GET['id'])) {
    header('Location: index.php');
    exit();
}

$id = (int)$_GET['id']; // Приводим к integer для защиты

// Загружаем данные существующей записи
$stmt = $pdo->prepare("SELECT * FROM workout_logs WHERE id = ?");
$stmt->execute([$id]);
$log = $stmt->fetch(PDO::FETCH_ASSOC);

// Если запись с таким ID не найдена
if (!$log) {
    header('Location: index.php');
    exit();
}

// Обработка формы обновления
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $exercise_type = htmlspecialchars(trim($_POST['exercise_type']));
    $duration = (int)$_POST['duration'];
    $title = htmlspecialchars(trim($_POST['title']));
    $description = htmlspecialchars(trim($_POST['description']));
    $status = htmlspecialchars(trim($_POST['status']));

    if (!empty($exercise_type) && !empty($duration) && !empty($title)) {
        $sql = "UPDATE workout_logs SET exercise_type = ?, duration = ?, title = ?, description = ?, status = ? WHERE id = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$exercise_type, $duration, $title, $description, $status, $id]);

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
    <title>Редактировать запись</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2>Редактировать запись о тренировке</h2>
        <?php if (isset($error)): ?>
            <div class="alert alert-danger"><?= $error ?></div>
        <?php endif; ?>

        <form method="post">
            <div class="mb-3">
                <label for="exercise_type" class="form-label">Тип упражнения *</label>
                <input type="text" class="form-control" id="exercise_type" name="exercise_type" required value="<?= htmlspecialchars($log['exercise_type']) ?>">
            </div>
            <div class="mb-3">
                <label for="duration" class="form-label">Длительность (минут) *</label>
                <input type="number" class="form-control" id="duration" name="duration" min="1" required value="<?= htmlspecialchars($log['duration']) ?>">
            </div>
            <div class="mb-3">
                <label for="title" class="form-label">Название/Описание *</label>
                <input type="text" class="form-control" id="title" name="title" required value="<?= htmlspecialchars($log['title']) ?>">
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Подробные заметки</label>
                <textarea class="form-control" id="description" name="description" rows="3"><?= htmlspecialchars($log['description']) ?></textarea>
            </div>
            <div class="mb-3">
                <label for="status" class="form-label">Статус</label>
                <select class="form-select" id="status" name="status">
                    <option value="не выполнена" <?= $log['status'] == 'не выполнена' ? 'selected' : '' ?>>Не выполнена</option>
                    <option value="выполнена" <?= $log['status'] == 'выполнена' ? 'selected' : '' ?>>Выполнена</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Сохранить изменения</button>
            <a href="index.php" class="btn btn-secondary">Отмена</a>
        </form>
    </div>
</body>
</html>