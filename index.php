<?php
require_once 'config.php';

$stmt = $pdo->query("SELECT * FROM workout_logs ORDER BY created_at DESC");
$logs = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Журнал тренировок</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center mb-4">Мой журнал тренировок</h1>
        <a href="add.php" class="btn btn-success mb-3">+ Добавить новую тренировку</a>

        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th>Тип упражнения</th>
                    <th>Длительность (мин.)</th>
                    <th>Название</th>
                    <th>Статус</th>
                    <th>Дата добавления</th>
                    <th>Действия</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($logs): ?>
                    <?php foreach ($logs as $log): ?>
                        <tr>
                            <td><?= htmlspecialchars($log['exercise_type']) ?></td>
                            <td><?= htmlspecialchars($log['duration']) ?></td>
                            <td><?= htmlspecialchars($log['title']) ?></td>
                            <td>
                                <span class="badge bg-<?= $log['status'] == 'выполнена' ? 'success' : 'warning' ?>">
                                    <?= htmlspecialchars($log['status']) ?>
                                </span>
                            </td>
                            <td><?= (new DateTime($log['created_at']))->format('d.m.Y H:i') ?></td>
                            <td>
                                <?php if ($log['status'] != 'выполнена'): ?>
                                    <a href="update_status.php?id=<?= $log['id'] ?>&status=выполнена" class="btn btn-sm btn-outline-success">Выполнено</a>
                                <?php endif; ?>
                                <a href="edit.php?id=<?= $log['id'] ?>" class="btn btn-sm btn-outline-primary">Изменить</a>
                                <a href="delete.php?id=<?= $log['id'] ?>" class="btn btn-sm btn-outline-danger" onclick="return confirm('Удалить эту запись?')">Удалить</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="6" class="text-center">Записей о тренировках пока нет.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</body>
</html>