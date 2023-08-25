<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['file']) && isset($_POST['review'])) {
    $file = $_FILES['file'];
    $uploadDir = 'uploads/';
    $fileHash = sha1_file($file['tmp_name']); // Генерируем хеш файла

    // Перемещаем файл в папку с использованием хеша в качестве имени файла
    $filePath = $uploadDir . $fileHash;
    if (move_uploaded_file($file['tmp_name'], $filePath)) {
        // Файл успешно загружен

        // Добавляем информацию о комментарии в базу данных
        $review = json_decode($_POST['review'], true);
        $reviewType = $review['reviewType'];
        $nameOrCompany = $review['nameOrCompany'];
        $comment = $review['comment'];
        $userId = $review['userId'];

        // Подключение к базе данных и выполнение запроса на добавление комментария
        $servername = 'localhost';
        $username = 'cu98932_recrut';
        $password = 'j5sTiPdL';
        $dbname = "cu98932_recrut";
        
        $conn = new mysqli($servername, $username, $password, $dbname);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $dateTime = date('Y-m-d H:i:s'); // Текущая дата и время
        $sql = "INSERT INTO comments (reviewType, nameOrCompany, comment, fileHash, userId, dateTime) 
                VALUES ('$reviewType', '$nameOrCompany', '$comment', '$fileHash', '$userId', '$dateTime')";

        if ($conn->query($sql) === TRUE) {
            echo json_encode(array('status' => 'success', 'message' => 'Комментарий и файл успешно добавлены.'));
        } else {
            echo json_encode(array('status' => 'error', 'message' => 'Ошибка добавления комментария и файла.'));
        }

        $conn->close();
        exit;
    } else {
        echo json_encode(array('status' => 'error', 'message' => 'Ошибка загрузки файла.'));
    }
}
