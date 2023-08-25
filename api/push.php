<?php
$servername = 'localhost';
$username = 'cu98932_recrut';
$password = 'j5sTiPdL';
$dbname = 'cu98932_recrut';

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $reviewType = $_POST['reviewType'];
    $nameOrCompany = $_POST['nameOrCompany'];
    $comment = $_POST['comment'];

    if(!$nameOrCompany){
        return false;
    }
    if(!$comment){
        return false;
    }

    $fileId = null;
    if (!empty($_FILES['file']['name'])) {
        $targetDir = 'uploads/'; // Путь к папке для загрузки файлов
        $fileName = uniqid() . '_' . $_FILES['file']['name'];
        $targetPath = $targetDir . $fileName;
        move_uploaded_file($_FILES['file']['tmp_name'], $targetPath);

        $stmt = $conn->prepare("INSERT INTO files (file_name) VALUES (?)");
        $stmt->execute([$fileName]);
        $fileId = $conn->lastInsertId();
    }

    $stmt = $conn->prepare("INSERT INTO comments (review_type, name_or_company, comment, file_id) VALUES (?, ?, ?, ?)");
    $stmt->execute([$reviewType, $nameOrCompany, $comment, $fileId]);

    $newCommentId = $conn->lastInsertId();
    $stmt = $conn->prepare("SELECT c.*, f.file_name FROM comments c LEFT JOIN files f ON c.file_id = f.id WHERE c.id = ?");
    $stmt->execute([$newCommentId]);
    $newComment = $stmt->fetch(PDO::FETCH_ASSOC);

    echo json_encode($newComment);

} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
$conn = null;
?>
