
CREATE DATABASE IF NOT EXISTS task_manager;
USE task_manager;

CREATE TABLE IF NOT EXISTS workout_logs (
    id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    exercise_type VARCHAR(255) NOT NULL,
    duration INT(11) NOT NULL,
    title VARCHAR(255) NOT NULL,
    description TEXT NULL,
    status ENUM('не выполнена', 'выполнена') DEFAULT 'не выполнена',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);