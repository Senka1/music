<?php
    session_start();
    $conn = mysqli_connect("localhost", "root", "", "larkov");
    if (!$conn) {die("Connection failed: ".mysqli_connect_error());}
    if(isset($_POST['logout'])) {session_destroy();
        header('Location: index.php');}?>
<html>
<head>
    <title>Загрузка музыки</title>
    <link rel="stylesheet" type="text/css" href="../css/common-style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css">
    <link rel="icon" type="image/png" href="./images/favicon.png">
</head>
<body>
    <div class="wrapper">
        <div class="header">
            <a href="index.php"><img src="../images/logo.png" alt="logo" class="logo"></a>
            <?php
                if(!isset($_SESSION['usern'])) {echo "<a href='login.php' class='login'>Вход</a>";}
                else { echo "
                    <form action='index.php' method='post'>
                        <input type='submit' name='logout' method='post' class='logout' value='Выход'/>
                    </form>
                    <a href='upload.php' class='cart'>Загрузить<u class='count'></u></a>
                    <a href='profile.php' class='cart'>Профиль </a>
                    <span class='welcome'>Добро пожаловать <b>".$_SESSION['usern']."</b>!</span>";
                    if($_SESSION['usern'] == 'admin') {echo "<a href='panel.php' class='panel'>Админ панель</a>";}}?>
        </div>
        <nav>
            <ul class="nav-links">
                <li><a href="./index.php"><b>Главная</b></a></li>
                <li><a href="./library.php"><b>Каталог</b></a></li>
                <li><a href="./about.php"><b>О нас</b></a></li>
                <li><a href="./contact.php"><b>Контакты</b></a></li>
            </ul>
        </nav>
        
    <style>
    body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 20px;
    }
    h1 {
        display: flex;
        justify-content: center;
        margin: 10%;
        color: #333;
    }
    .upload-form {
        display: flex;
        justify-content: center;
        margin-bottom: 190px;
        padding: 10px;
        margin: 20px;
    }
    .message {
        display: flex;
        justify-content: center;
        margin-top: 10px;
    }
    input[type="file"] {
        display: none;
    }
    .custom-file-upload {
        display: inline-block;
        padding: 10px 20px;
        cursor: pointer;
        background-color: #41b6ff;
        color: white;
        border-radius: 4px;
        border: none;
    }
    .custom-file-upload:hover {
        background-color: steelblue; 
    }
    .custom-file-upload:active {
        background-color: skyblue;
    }
</style>
</head>

<body>
    <div class="zero"></div>
    <h1>Загрузка музыки</h1>
    <form class="upload-form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post"
        enctype="multipart/form-data">
        <label for="musicFile" class="custom-file-upload">Выберите файл</label>
        <input type="file" name="musicFile" id="musicFile">
        <input type="submit" value="Загрузить">
    </form>
    <div class="message"></div>
    <script>
        $(document).ready(function () {
            $('#uploadForm').submit(function (e) {
                e.preventDefault();
                var formData = new FormData($(this)[0]);
                $.ajax({
                    url: '<?php echo $_SERVER['PHP_SELF']; ?>',
                    type: 'POST',
                    data: formData,
                    contentType: false,
                    processData: false,
                    xhr: function () {
                        var xhr = new window.XMLHttpRequest();
                        xhr.upload.addEventListener("progress", function (evt) {
                            if (evt.lengthComputable) {
                                var percentComplete = evt.loaded / evt.total;
                                $('#progress').text('Загрузка: ' + Math.round(percentComplete * 100) + '%');
                            }
                        }, false);
                        return xhr;
                    },
                    success: function (response) {
                        $('#message').html(response);
                    }
                });
            });
        });
    </script>
    <?php
    if (isset($_FILES['musicFile'])) {
        $file_name = $_FILES['musicFile']['name'];
        $file_size = $_FILES['musicFile']['size'];
        $file_tmp = $_FILES['musicFile']['tmp_name'];
        $file_type = $_FILES['musicFile']['type'];

        move_uploaded_file($file_tmp, 'uploads/' . $file_name);

        
        // Подключение к базе данных
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "larkov";

        $conn = new mysqli($servername, $username, $password, $dbname);

        // Проверка соединения
        if ($conn->connect_error) {
            die("Ошибка соединения: " . $conn->connect_error);
        }

        // Подготовка SQL-запроса для вставки данных
        $sql = "INSERT INTO music_files (file_name, file_size, file_type) VALUES ('$file_name', $file_size, '$file_type')";

        if ($conn->query($sql) === TRUE) {
            echo 'Файл успешно загружен!';
        } else {
            echo 'Ошибка при загрузке файла: ' . $conn->error;
        }

        $conn->close();
    }
    ?>
    <div class="zero"></div>
</body>
    <footer>
        <div class="sections">
            <div class="about-info">
                <h2>Информация</h2>
                <p>Наша интернет-площадка специализируется на представлении и загрузки высококачественных аудио файлов. Мы предлагаем широкий выбор современных Композиций и подкастов от ведущих исполнителей, гарантирующих стабильную и высокую скорость работы.</p>
            </div>
            <div class="about-shipping">
                <h2>плеер</h2>
                <p>Веб-сервис использует классический и удобный плеер с высокой репутацией и доверием, и вы спокойно можете пользоваться им совершенно бесплатно.</p>
            </div>
        </div>
        <div class="copyright">&copy;2023 &bull; Все права защищены &bull; дизайн by <b>Семён Ларьков</b></div>
    </footer>
</body>
</html>
</html>
