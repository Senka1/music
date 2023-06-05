<?php
session_start();
$conn = mysqli_connect("localhost", "root", "", "larkov");
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
if (isset($_POST['logout'])) {
    session_destroy();
    header('Location: index.php');
}
if (!isset($_SESSION['usern'])) {
    header('Location: login.php');
}

$usern = $_SESSION['usern'];

$user_query = "SELECT * FROM users WHERE login = '$usern'";
$user_result = mysqli_query($conn, $user_query);
$user_row = mysqli_fetch_assoc($user_result);
$login = $user_row['login'];
$password = $user_row['password'];
?>
<html>
<head>
    <title>Профиль</title>
    <link rel="stylesheet" type="text/css" href="../css/profile.css">
    <link rel="stylesheet" type="text/css" href="../css/common-style.css">
</head>
<body>
<div class="wrapper">
        <div class="header">
            <a href="index.php"><img src="../images/logo.png" alt="logo" class="logo"></a>
            <?php
            echo "<form action='index.php' method='post'>
                <input type='submit' name='logout' method='post' class='logout' value='Выход'/>
                <a href='upload.php' class='cart'>Загрузить<u class='count'></u></a>
            </form>
            <span class='welcome'>Добро пожаловать <b>".$_SESSION['usern']."</b>!</span>";
            ?>
        </div>
        <nav>
            <b>
            <ul class="nav-links">
                <li><a href="./index.php"><b>Главная</b></a></li>
                <li><a href="./library.php"><b>Каталог</b></a></li>
                <li><a href="./about.php"><b>О нас</b></a></li>
                <li><a href="./contact.php"><b>Контакты</b></a></li>
            </ul>
            </b>
        </nav>
        <div class="zero">
        <div class="profile-wrapper">
            <h1 class="headline">Профиль</h1>
            <div class="columnshadow">
                <div class="column">
                    <div class="twice_placeholder">
                        <label class="labels">Логин</label>
                        <input type="text" class="form-control" readonly value="<?php echo $login; ?>">
                    </div>
                    <div class="twice_placeholder">
                        <label class="labels">Пароль</label>
                        <input type="text" class="form-control" readonly value="<?php echo $password; ?>">
                    </div>
                </div>
            </div>
    </div>
</div>

<div class="zero"></div>
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
            <div class="faq">
                <h2>Загрузка музыки</h2>
                    <ul>
                        <li><a href="./upload.php">Предложить</a></li>
                    </ul>
            </div>
        </div>
        <div class="copyright">&copy;2023 &bull; Все права защищены &bull; дизайн by <b>Семён Ларьков</b></div>
    </footer>
</body>
</html>