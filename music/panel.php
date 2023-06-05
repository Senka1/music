<?php
    session_start();
    $conn = mysqli_connect("localhost", "root", "", "larkov");
    if(!$conn) {
        die("Connection has been failed");
    }
    if(!isset($_SESSION['usern'])) {
        header('Location: index.php');
    }
    else if($_SESSION['usern'] !== "admin") {
        header('Location: index.php');
    }
    if(isset($_POST['logout'])) {
        session_destroy();
        header('Location: index.php');
    }
?>
<html>
<head>
    <title>Админ панель</title>
    <link rel="stylesheet" type="text/css" href="../css/panel-style.css">
    <link rel="stylesheet" type="text/css" href="../css/common-style.css">
    <link rel="icon" type="image/png" href="./images/favicon.png">
</head>
<body>
    <div class="wrapper">
        <div class="header">
            <a href="index.php"><img src="../images/logo.png" alt="logo" class="logo"></a>
            <?php
                if(!isset($_SESSION['usern'])) {
                    echo "<a href='login.php' class='login'>Вход</a>";
                }
                else {
                    echo "
                    <form action='index.php' method='post'>
                        <input type='submit' name='logout' method='post' class='logout' value='Выход'/>
                    </form>
                    <span class='welcome'>Добро пожаловать <b>".$_SESSION['usern']."</b>!</span>
                    ";
                    if($_SESSION['usern'] == 'admin') {
                        echo "
                        <a href='panel.php' class='panel'>Админ панель</a>";} }
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
        </nav>   
        <div class="container-bar">         
            <ul>
              <li><a class="active" href="#panel.php"><b>АДМИН ПАНЕЛЬ</b></a></li>
              <li><a href="del.php">удалить музыку</a></li>
              <li><a href="view-users.php">Пользователи</a></li>
            </ul>
        </div>
        <form action="" method="post">
            <div class="save">
                <input type="submit" value="сохранить" name="submit">
            </div>
            <?php
                $query = "SELECT * FROM products";
                $result = mysqli_query($conn, $query);

                if(isset($_POST["submit"])) {
                    foreach($result as $product) {
                        $id = $product['id'];
                        $update_query = "UPDATE products SET stock='".$_POST[$id]."' WHERE id='".$id."'";
                        mysqli_query($conn, $update_query);
                    }
                    echo "<span class='succ'>Успешно сохраненно</span><br>";
                }
            ?>
            <table>
                </tbody>
            </table>
        </form>
    </div>
</body>
</html>