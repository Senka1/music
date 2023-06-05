<?php
    session_start();
    $conn = mysqli_connect("localhost", "root", "", "larkov");
    if (!$conn) {die("Connection failed: ".mysqli_connect_error());}
    if(isset($_POST['logout'])) {session_destroy();
        header('Location: index.php');}?>
<html>
<head>
    <title>Список песен</title>
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
                <li><a href="./library.php "id="active"><b>Каталог</b></a></li>
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

    /* Style the heading */
    h1 {
        color: #333;
        font-size: 36px;
        font-weight: bold;
        margin-bottom: 20px;
        text-align: center;
    }

    /* Remove default list styles and padding */
    ul {
        list-style: none;
        padding: 0;
    }

    /* Style each list item */
    li {
        margin-bottom: 20px;
    }

    /* Style the link */
    a {
        color: #41b6ff;
        text-decoration: none;
        transition: color 0.3s;
    }

    /* Change the link color on hover */
    a:hover {
        color: #1890d8;
    }

    /* Style the product container */
    .products {
        display: flex;
        flex-wrap: wrap;
        justify-content: space-between;
    }

    /* Style the product */
    .product {
        width: 100%;
        margin-bottom: 20px;
        background-color: #fff;
        border-radius: 4px;
        padding: 10px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    /* Style the audio player */
    audio {
        width: 100%;
        margin-bottom: 10px;
    }

    /* Style the detail container */
    .detail {
        padding: 10px;
    }

    /* Style the name and description */
    .name,
    .desc {
        font-size: 18px;
        font-weight: bold;
        margin-bottom: 5px;
    }

    /* Style the description */
    .desc {
        color: #666;
    }
</style>
</head>

<body>
    <h1>Список песен</h1>
    <ul>
        <?php
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
        $sql = "SELECT * FROM music_files";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $file_name = $row['file_name'];
                $file_desc = $row['file_desc'];
                echo '<div class="products">';
                echo '<div class="product">';
                echo '<audio controls>';
                echo '<source src="../uploads/' . $file_name . '" type="audio/mpeg">';
                echo '</audio>';
                echo '<div class="detail">';
                echo '<div class="name">' . $file_name . '</div>';
                echo '<div class="desc">' . $file_desc . '</div>';
                echo '</div>';
                echo '</div>';
                echo '</div>';
            }
        } else {
            echo "Нет загруженных песен.";
        }

        $conn->close();
        ?>
    </ul>
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
