<?php
    session_start();
    $conn = mysqli_connect("localhost", "root", "", "larkov");
    if (!$conn) {die("Connection failed: ".mysqli_connect_error());}
    if(isset($_POST['logout'])) {session_destroy();
        header('Location: index.php');}?>
<html>
<head> 
    <title>index</title>
    <link rel="stylesheet" type="text/css" href="../css/home-style.css">
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
                <li><a href="./index.php" id="active"><b>Главная</b></a></li>
                <li><a href="./library.php"><b>Каталог</b></a></li>
                <li><a href="./about.php"><b>О нас</b></a></li>
                <li><a href="./contact.php"><b>Контакты</b></a></li>
            </ul>
        </nav>
  <div class="swiper mySwiper">
    <div class="swiper-wrapper">
      <div class="swiper-slide"><img src="../images/song (2).jpg" alt="song (2)"></div>
      <div class="swiper-slide"><img src="../images/song (1).jpg" alt="song (1)"></div>
      <div class="swiper-slide"><img src="../images/song (3).jpg" alt="song (3)"></div>
    </div>
  </div>
        <h1 class="products-header">Последние композиции<a href="./library.php"><span class="all-products">Все аудио &rarr;</span></a></h1>
        <div class="products">
            <div class="product">
                <audio controls>
                    <source src="uploads/stalking.mp3" type="audio/mpeg">
                </audio>
                <div class="detail">
                    <div class="name">Killing Stalking</div>
                    <div class="desc">never die, KID SADNESS</div>
                </div>
            </div>
            <script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>
  <script>
    var swiper = new Swiper(".mySwiper", {
      centeredSlides: true,
      autoplay: {
        delay: 1500,
        loop: true,
        disableOnInteraction: false,},});
  </script>
        </div>
        <div class="products">
            <div class="product">
                <audio controls>
                    <source src="uploads/Не моя.mp3" type="audio/mpeg">
                </audio>
                <div class="detail">
                    <div class="name">Не моя</div>
                    <div class="desc">bezotca</div>
                </div>
            </div>
        </div>
        <div class="products">
            <div class="product">
                <audio controls>
                    <source src="uploads/Icy Cry - Надеюсь ты поймёшь.mp3" type="audio/mpeg">
                </audio>
                <div class="detail">
                    <div class="name">Надеюсь ты поймёшь</div>
                    <div class="desc">Icy Cry</div>
                </div>
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