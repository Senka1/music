<?php
session_start();

$conn = mysqli_connect("localhost", "root", "", "larkov");

if (!$conn) {
    die("Connection has been failed");
}

if (!isset($_SESSION['usern'])) {
    header('Location: index.php');
} else if ($_SESSION['usern'] !== "admin") {
    header('Location: index.php');
}
if (isset($_POST['logout'])) {
    session_destroy();
    header('Location: index.php');
}
?>
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="../css/users.css">
    <link rel="stylesheet" type="text/css" href="../css/common-style.css">
    <link rel="icon" type="image/png" href="./images/favicon.png">
    <title>Категории</title>
</head>
<body>
    <div class="wrapper">
        <div class="header">
            <a href="../pages/index.php"><img src="../images/logo.png" alt="logo" class="logo"></a>
            <?php
            if (!isset($_SESSION['usern'])) {
                echo "<a href='../pages/login.php' class='login'>Вход</a>";
            } else {
                echo "
                    <form action='index.php' method='post'>
                        <input type='submit' name='logout' method='post' class='logout' value='Выход'/>
                    </form>
                    <a href='cart.php' class='cart'>Корзина <u class='count'>0</u></a>
                    <span class='welcome'>Добро пожаловать <b>" . $_SESSION['usern'] . "</b>!</span>
                    ";
                if ($_SESSION['usern'] == 'admin') {
                    echo "
                        <a href='panel.php' class='panel'>Админ панель</a>
                        ";
                }
            }
            ?>
        </div>
        <nav>
            <b>
            <ul class="nav-links">
                <li><a href="./index.php" id="active"><b>Главная</b></a></li>
                <li><a href="./library.php"><b>Каталог</b></a></li>
                <li><a href="./about.php"><b>О нас</b></a></li>
                <li><a href="./contact.php"><b>Контакты</b></a></li>
            </ul>
            </b>
        </nav>
        <h1>Список пользователей</h1>
        <table>
            <tr>
                <th>Логин</th>
                <th>Пароль</th>
                <th>Действие</th>
            </tr>
            <?php

            // Retrieve data from database
            $sql = "SELECT * FROM users";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                // Output data of each row
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["login"] . "</td>";
                    echo "<td>" . $row["password"] . "</td>";
                    echo "<td><a href='edit_user.php?id=" . $row["id"] . "'>Изменить</a></td>";
                }
            } else {
                echo "0 results";
            }

            $conn->close();
            ?>
        </table>
        <button onclick="history.go(-1);">Назад</button>

</body>

</html>