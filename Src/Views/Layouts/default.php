<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <base href="/project.loc/">
    <link rel="stylesheet" href="css/style.css" >
    <title>MONO_KURSOVAYA</title>
</head>
<body>
    <div class="home-page">
      <div class="div">
        <header class="header">
          <div class="header-content">
            <a href="">
              <img class="logo" src="img/logo.png" alt="Logo">
              <div class="text-wrapper">MONO</div>
            </a>
          <!-- Чекбокс и лейбл для меню -->
          <input type="checkbox" id="menu-toggle" class="menu-toggle">
          <div class="menu-container">
            <div class="menu-background"></div>
            <label for="menu-toggle" class="menu-button"></label>
          </div>
            <!-- Навигационное меню -->
              <nav class="nav-menu">
                <a href="index.html">Главная</a>
                <a href="about.html">О нас</a>
                <a href="cars.html">Наши автомобили</a>
                <a href="rent.html">Аренда</a>
                <a href="faq.html">FAQ</a>
              </nav>
          <?= !empty($user) ? '<p>Привет, '.$user->getNickname().' '.'<a href="users/logout">Выход</a>'.'</p>' : '<a href="users/login">Войдите на сайт</a>' ?>

          </div>
        </header>
        <main>
            <?= $content ?>
       </main>
    <footer class="footer">
      <div class="footer-container">
        <!-- Левая колонка -->
        <div class="footer-contacts">
          <h3 class="footer-title">Контакты</h3>
          <p class="footer-address">г. Санкт-Петербург, Морская наб 17, к1</p>
          <a href="tel:89528125252" class="footer-phone">8 (952) 812 52 52</a>
          <a href="mailto:MONO@gmail.com" class="footer-email">MONO@gmail.com</a>
          
          <!-- Социальные сети -->
          <div class="footer-social">
            <a href="https://web.whatsapp.com/"><img src="img/whatsapp.svg" alt="WhatsApp" class="social-icon"></a>
            <a href="https://www.instagram.com/bmw?igsh=MXJrNjlpNWk3YWlycA=="><img src="img/instagram.svg" alt="Instagram" class="social-icon"></a>
            <a href="https://youtube.com/@forsazh?si=PqZTfVkC8e2g-Tqf"><img src="img/youtube.svg" alt="YouTube" class="social-icon"></a>
            <a href="https://t.me/mono000"><img src="img/telegram.svg" alt="Telegram" class="social-icon"></a>
          </div>
        </div>

        <!-- Правая колонка -->
        <div class="footer-nav">
          <a href="index.html">Главная</a>
          <a href="about.html">О нас</a>
          <a href="cars.html">Наши автомобили</a>
          <a href="rent.html">Аренда</a>
          <a href="faq.html">FAQ</a>
        </div>

        <!-- Правовая информация -->
        <div class="footer-legal">
          Информация на данном сайте носит исключительно ознакомительный характер и не является публичной офертой, определяемой положениями Статьи 437 Гражданского кодекса РФ.
        </div>

        <!-- Копирайт -->
        <div class="footer-copyright">
          (C) 2024 «MONO» — аренда автомобилей в Санкт-Петербурге
        </div>
      </div>
    </footer>

    </div>

    </div>
</body>
</html>