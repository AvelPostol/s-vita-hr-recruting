
<?php
$servername = '5.23.51.104'; // Адрес вашего MySQL-сервера
$username = 'cu98932_bgbi';
$password = '3324Avel';
$database = 'cu98932_bgbi';

// Создание подключения
$conn = new mysqli($servername, $username, $password, $database);

// Проверка подключения
if ($conn->connect_error) {
    die('Ошибка подключения к базе данных: ' . $conn->connect_error);
}

echo 'Успешное подключение к базе данных';

// Закрытие подключения
$conn->close();
?>