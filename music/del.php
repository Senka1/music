<!DOCTYPE html>
<html>
<head> 
    <title>Удаление музыки</title>
    <link rel="stylesheet" type="text/css" href="../css/home-style.css">
    <link rel="stylesheet" type="text/css" href="../css/common-style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css">
    <link rel="icon" type="image/png" href="./images/favicon.png">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f0f0f0;
        }
        h1 {
            text-align: center;
        }
        
        .song {
            margin-bottom: 10px;
            background-color: #fff;
            padding: 10px;
            border-radius: 5px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .song a {
            color: #ff0000;
            text-decoration: none;
        }
        
        .song a:hover {
            text-decoration: underline;
        }
        
        .button {
            display: inline-block;
            padding: 10px 20px;
            background-color: #41b6ff;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <h1>Удаление музыки</h1>
    <?php
    // Подключение к базе данных
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "larkov";
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Проверка соединения
    if ($conn->connect_error) {
        die("Ошибка соединения: " . $conn->connect_error);}
    if (isset($_GET['delete'])) {
        $file_name = $_GET['delete'];
        // Удаление записи из базы данных
        $sql = "DELETE FROM music_files WHERE file_name = '$file_name'";
        if ($conn->query($sql) === TRUE) {
            // Успешно удалено
            echo "Песня успешно удалена.";
        } else {
            echo "Ошибка удаления песни: " . $conn->error;}}
    // Получение списка песен из базы данных
    $sql = "SELECT * FROM music_files";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        // Вывод песен и кнопок удаления
        while($row = $result->fetch_assoc()) {
            $file_name = $row['file_name'];
            echo '<div class="song">'.$file_name.' <a href="?delete='.$file_name.'">Удалить</a></div>';}} 
            else {echo "Нет загруженных песен.";}?>
    <button class="button" onclick="goBack()">Открыть предыдущую страницу</button>
    <script>
        // JavaScript код для удаления песни
        function deleteSong(fileName) {
            var confirmation = confirm("Вы действительно хотите удалить эту песню?");
            if (confirmation) {
                window.location.href = "?delete=" + fileName;}}
        function goBack() {
            window.history.back();}
    </script>
</body>
</html>
