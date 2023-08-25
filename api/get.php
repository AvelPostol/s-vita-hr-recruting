<?php
$servername = 'localhost';
$username = 'cu98932_recrut';
$password = 'j5sTiPdL';
$dbname = 'cu98932_recrut';

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Получаем список комментариев с информацией о файлах
    $stmt = $conn->prepare("SELECT c.*, f.file_name FROM comments c LEFT JOIN files f ON c.file_id = f.id");
    $stmt->execute();
    $comments = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode($comments);

} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
$conn = null;
?>