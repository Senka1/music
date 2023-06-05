<?php
session_start();
$conn = mysqli_connect("localhost", "root", "", "larkov");
if (!$conn) {
    die("Connection has been failed");
}
if (isset($_SESSION['usern'])) {
    header('Location: index.php');
}
if (isset($_POST['logout'])) {
    session_destroy();
    header('Location: index.php');
}
?>

<html>

<head>
    <title>Вход</title>
    <link rel="stylesheet" type="text/css" href="./css/login-style.css">
    <link rel="stylesheet" type="text/css" href="./css/common-style.css">
    <link rel="icon" type="image/png" href="./images/favicon.png">
</head>

<body>
    <div class="wrapper">
        <div class="header">
            <a href="index.php"><img src="../images/logo.png" alt="logo" class="logo"></a>
            <a href="login.php" class="login">Вход</a>
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
    </div>
    <div class="forms">
        <div class="login-section">
            <form class="login-form" method="post" action="">
                <h1>Вход</h1>
                <?php
                if (isset($_POST['lsubmit'])) {
                    if ($_POST['llogin'] != "" && $_POST['lpass'] != "") {
                        $query = "SELECT count(*) AS count FROM users WHERE login=? AND password=?";
                        $stmt = mysqli_prepare($conn, $query);
                        mysqli_stmt_bind_param($stmt, "ss", $_POST['llogin'], $_POST['lpass']);
                        mysqli_stmt_execute($stmt);
                        mysqli_stmt_bind_result($stmt, $count);
                        mysqli_stmt_fetch($stmt);
                        mysqli_stmt_close($stmt);

                        if ($count > 0) {
                            $_SESSION['usern'] = $_POST['llogin'];
                            header('Location: index.php');
                        } else {
                            echo "<span class='err'>Логин или пароль неправильные</span><br>";
                        }
                    } else {
                        echo "<span class='err'>Вы не ввели логин или пароль</span><br>";
                    }
                }
                ?>
                <input type="textbox" placeholder="логин" class="username" name="llogin" autocomplete="off" />
                <input type="password" placeholder="пароль" class="password" name="lpass" autocomplete="off" />
                <input type="submit" value="Войти" name="lsubmit" class="submit">
            </form>
        </div>
        <div class="register-section">
            <form class="register-form" method="post" action="">
                <h1>регистрация</h1>
                <?php
                if (isset($_POST['rsubmit'])) {
                    if ($_POST['rlogin'] != "" && $_POST['rpass1'] != "" && $_POST['rpass2'] != "") {
                        $query = "SELECT count(*) AS count FROM users WHERE login=?";
                        $stmt = mysqli_prepare($conn, $query);
                        mysqli_stmt_bind_param($stmt, "s", $_POST['rlogin']);
                        mysqli_stmt_execute($stmt);
                        mysqli_stmt_bind_result($stmt, $count);
                        mysqli_stmt_fetch($stmt);
                        mysqli_stmt_close($stmt);
                        if ($count > 0) {
                            echo "<span class='err'>Этот логин уже занят</span><br>";
                        } else {
                            if ($_POST['rpass1'] == $_POST['rpass2']) {
                                $insertion_query = "INSERT INTO users (login, password) VALUES (?, ?)";
                                $stmt = mysqli_prepare($conn, $insertion_query);
                                mysqli_stmt_bind_param($stmt, "ss", $_POST['rlogin'], $_POST['rpass1']);
                                if (mysqli_stmt_execute($stmt)) {
                                    echo "<span class='succ'>Вы успешно зарегистрированы</span><br>";
                                } else {
                                    echo "<span class='err'>Ошибка при регистрации</span><br>";
                                }
                                mysqli_stmt_close($stmt);
                            } else {
                                echo "<span class='err'>Пароли не совпадают</span><br>";
                            }
                        }
                    } else {
                        echo "<span class='err'>Вы не ввели логин или пароль</span><br>";
                    }
                }
                ?>
                <input type="textbox" placeholder="логин" class="username" name="rlogin" autocomplete="off" />
                <input type="password" placeholder="пароль" class="password" name="rpass1" autocomplete="off" />
                <input type="password" placeholder="повторите пароль" class="password" name="rpass2"
                    autocomplete="off" />
                <input type="submit" value="Зарегистрироваться" name="rsubmit" class="submit">
            </form>
        </div>
    </div>
    <footer>
        <div class="sections">
            <div class="about-info">
                <h2>Информация</h2>
                <p>Наш интернет-магазин специализируется на продаже высококачественной электронной продукции. Мы
                    предлагаем широкий выбор современных устройств от ведущих производителей, гарантирующих стабильную
                    работу и высокую надежность.</p>
            </div>
            <div class="about-shipping">
                <h2>Доставка</h2>
                <p>Наши партнеры по доставке пользуются хорошей репутацией и доверием, и мы тесно сотрудничаем с ними,
                    чтобы гарантировать, что ваши заказы будут обработаны с осторожностью и доставлены вовремя</p>
            </div>
            <div class="faq">
                <h2>FAQ</h2>
                <ul>
                    <li><a href="./faq.php">FAQ</a></li>
                </ul>
            </div>
        </div>
    </footer>

</body>

</html>