
<?php
// Подключение к базе данных
$host = '10.0.3.49';
$user = 'phpmyadmin';
$password = 'G@&5$@pJe87VxmS2KKSs';
$database = 'b_bg_bi';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$database", $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo 'Ошибка подключения к базе данных: ' . $e->getMessage();
    exit();
}

// Получение списка
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    try {
        $stmt = $pdo->query("SELECT * FROM bg_tasks_control");
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($rows);
    } catch (PDOException $e) {
        http_response_code(500);
        echo 'Произошла ошибка при получении данных';
    }
    exit();
}

// Обновление данных
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);
    $delay = $data['delay'];
    $transfer = $data['transfer'];
    $report = $data['report'];
    $id = $data['ID'];

    try {
        $stmt = $pdo->prepare("UPDATE bg_tasks_control SET delay = ?, transfer = ?, report = ? WHERE ID = ?");
        $stmt->execute([$delay, $transfer, $report, $id]);
        http_response_code(200);
        echo 'Успех';
    } catch (PDOException $e) {
        http_response_code(500);
        echo 'Ошибка при обновлении данных';
    }
    exit();
}

// Если запрос не соответствует ни одному маршруту
http_response_code(404);
echo 'Страница не найдена';


{ text: 'ID', key: 'ID' },
{ text: 'ID задачи', key: 'id_task' },
{ text: 'Роль', key: 'role' },
{ text: 'Пользователь', key: 'user' },
{ text: 'Просрочки', key: 'delay' },
{ text: 'Переносы', key: 'transfer' },
{ text: 'Учет', key: 'report' },
{ text: 'Править', key: 'actions' }