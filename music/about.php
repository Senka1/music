<?php
session_start();
$conn = mysqli_connect("localhost", "root", "", "larkov");
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());}
if (isset($_POST['logout'])) {
    session_destroy();
    header('Location: index.php');}?>
<html>
<head>
    <title>Всё о нас</title>
    <link rel="stylesheet" type="text/css" href="../css/about-style.css">
    <link rel="stylesheet" type="text/css" href="../css/common-style.css">
    <script type="text/javascript">
        $(document).ready(function () {
            var cartNum = localStorage.getItem("cartCount")
            if (cartNum) {$(".count").text(cartNum)}})
    </script>
</head>
<body>
    <div class="wrapper">
    <div class="header">
            <a href="index.php"><img src="../images/logo.png" alt="logo" class="logo"></a>
            <?php
                if(!isset($_SESSION['usern'])) {echo "<a href='../pages/login.php' class='login'>Вход</a>";}
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
            <b>
            <ul class="nav-links">
                <li><a href="./index.php"><b>Главная</b></a></li>
                <li><a href="./library.php"><b>Каталог</b></a></li>
                <li><a href="./about.php" id="active"><b>О нас</b></a></li>
                <li><a href="./contact.php"><b>Контакты</b></a></li>
            </ul>
            </b>
        </nav>
        <img src="../images/branch.png" alt="branch" class="branch">
        <div class="abouttext">
            <p style="text-indent: 5%;">Наша <b>музыкальная площадка</b> предлагает вам удобную возможность загружать и слушать качественную музыку онлайн. У нас вы найдете широкий выбор современных композиций различных жанров, которые подойдут для любых ваших настроений. Мы также предлагаем уникальные треки и альбомы от талантливых исполнителей, чтобы вы могли открыть для себя новые музыкальные горизонты.</p>
            <p style="text-indent: 5%;">Мы уверены, что наши пользователи оценят качество предлагаемой музыки и удобство нашего сервиса. Мы стремимся предоставить вам самые лучшие композиции от известных артистов, а также поддерживаем начинающих музыкантов, чтобы они могли продемонстрировать свой талант и найти свою аудиторию.</p>
            <p style="text-indent: 5%;">Приглашаем вас присоединиться к нашему музыкальному сообществу и насладиться прекрасными звуками. Мы гарантируем удовлетворение вашей музыкальной потребности, индивидуальный подход к каждому пользователю и простоту использования нашего сервиса.</p>
        </div>
        <div class="first-wrapper">
            <div class="first">
                <h1>Семён Ларьков</h1><h2>Музыкальный эксперт</h2><br><img src="../images/la.jpg" alt="semyon">
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Consectetur iure quod esse debitis est consequuntur nostrum repudiandae a, maiores totam quia nobis exercitationem. Necessitatibus, earum dolore eaque animi corrupti commodi?</p>
            </div>
        </div>
        <div class="second-wrapper">
            <div class="second"><h1>Семён Ларьков</h1><h2>Создатель сервиса</h2><br><img src="../images/ls.jpg" alt="semyon">
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Nulla consequatur repellendus itaque est, nesciunt ratione perferendis dolore vel porro quaerat veniam inventore corporis excepturi saepe eius esse molestias quas doloremque?</p>
            </div>
        </div>
    </div>
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