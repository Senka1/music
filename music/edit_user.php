<?php
session_start();

$conn = mysqli_connect("localhost", "root", "", "larkov");
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $login = $_POST["login"];
    $password = $_POST["password"];

    // Check if user exists
    $query = "SELECT * FROM users WHERE login=?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "s", $login);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    
    if (mysqli_num_rows($result) > 0) {
        // Update user's login and password
        $query = "UPDATE users SET password=? WHERE login=?";
        $stmt = mysqli_prepare($conn, $query);
        mysqli_stmt_bind_param($stmt, "ss", $password, $login);
        $message = "Record updated successfully";
    } else {
        // Insert new user with login and password
        $query = "INSERT INTO users (login, password) VALUES (?, ?)";
        $stmt = mysqli_prepare($conn, $query);
        mysqli_stmt_bind_param($stmt, "ss", $login, $password);
        $message = "Record added successfully";
    }

    if (mysqli_stmt_execute($stmt)) {
        echo $message;
        $_SESSION['login'] = $login;
    } else {
        echo "Error: " . mysqli_stmt_error($stmt);
    }

    mysqli_stmt_close($stmt);
}

mysqli_close($conn);
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
            session_start();
            $conn = mysqli_connect('localhost', 'root', '', 'larkov');
            if (!isset($_SESSION['usern'])) {
                echo "<a href='login.php' class='login'>Вход</a>";
            } else {
                $user_query = "SELECT * FROM users";
                $user_result = mysqli_query($conn, $user_query);
                $user_row = mysqli_fetch_assoc($user_result);
                $user_id = $user_row['id'];
                echo "<form action='index.php' method='post'>
                    <input type='submit' name='logout' method='post' class='logout' value='Выход'/>
                </form>
                <a href='cart.php' class='cart'>Корзина <u class='count'>0</u></a>
                <span class='welcome'>Добро пожаловать <b>" . $_SESSION['usern'] . "</b>, ваш ID: <b>" . $user_id . "</b>!</span>";
                if ($_SESSION['usern'] == 'admin') {
                    echo "<a href='panel.php' class='panel'>Админ панель</a>";
                }
            }
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
        <div class="profile-wrapper">
            <h1 class="headline">Профиль</h1>
            <div class="columnshadow">
                <form method="POST" action="">
                    <div class="column">
                        <div class="twice_placeholder">
                            <label class="labels">Логин</label>
                            <input type="text" name="login" class="form-control" placeholder="Логин" value="<?php echo isset($_POST['login']) ? $_POST['login'] : ''; ?>">
                        </div>
                        <div class="twice_placeholder">
                            <label class="labels">Пароль</label>
                            <input type="password" name="password" class="form-control" placeholder="Пароль" value="<?php echo isset($_POST['password']) ? $_POST['password'] : ''; ?>">
                        </div>
                        <button type="submit" class="button" name="submit">Сохранить изменения</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
<footer>
    <div class="sections">
        <div class="about-info">
            <h2>Информация</h2>
            <p>Наш интернет-магазин специализируется на продаже высококачественной электронной продукции. Мы предлагаем широкий выбор современных устройств от ведущих производителей, гарантирующих стабильную работу и высокую надежность.</p>
        </div>
    </div>
</footer>
</html>