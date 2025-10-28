<?php
    include "DB.php"; //включение файла с подключением к БД
    $entered = 0;
    $ea = 0;

    if (isset($_SESSION['login-a'])) { //если переменная с логином установлена, то переменная entered становится 1
        $login = $_SESSION['login-a'];
        $entered = 1;
        if ($login == 'admin') { //проверка, вошёл ли админ в аккаунт
            $ea = 1;
        }
    }
    elseif (isset($_SESSION['login-r']))
    {
        $login = $_SESSION['login-r'];
        $entered = 1;
    }
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Azimut IT</title>
    <link rel="stylesheet" href="main.css"> <!-- подключение css -->
</head>
<body>
    <header class="header"> <!-- шапка сайта -->
        <div class="container header__content">
            <img src="img/logo.png" alt="Лого" width="100px" height="100px">
            <nav class="menu">
                <ul class="menu__list">
                    <li class="menu__item"><a class="menu__link" href="Main.php">Главная</a></li>
                    <li class="menu__item"><a class="menu__link" href="Services.php">Услуги</a></li>
                    <li class="menu__item"><a class="menu__link" href="Callback.php">Обратная связь</a></li>
                </ul>
            </nav>
        </div>
    </header>
    <main class="main container-2">
        <div class="auth-block"> <!-- блок навигации (слева) -->
            <div class="auth">
                <p>Личный кабинет</p>
                <button class="btn" id="auth"><a href="Auth.php">Авторизоваться</a></button>
                <button class="btn-re" id="reg"><a href="Registration.php">Зарегистрироваться</a></button>
                <button class="btn entr" id="enter"><a href="Account.php">Открыть</a></button>
            </div>
            <div class="admin-panel" id="adm">
                <button class="btn admin"><a href="Admin_panel.php">Админ-панель</a></button>
            </div>
        </div>

        <section class="about"> <!-- блок с информацией о компании -->
            <h1>О компании</h1>
            <p>
                AZIMUT IT — технологичная компания, специализирующаяся на разработке индивидуальных цифровых решений и внедрении искусственного интеллекта в бизнес-процессы.<br>
                <br>
                Продуктовое ядро:<br>
                • Индивидуальная разработка веб-сайтов и мобильных приложений<br>
                • Интеграция искусственного интеллекта в бизнес-процессы<br>
                • Разработка программного обеспечения под задачи заказчика<br>
                • Системная интеграция и автоматизация<br>
                • IT-консалтинг и цифровая стратегия <br>
                <br>
                Мы работаем в B2B сегменте, предоставляя интеллектуальные решения, которые позволяют компаниям ускорять рост, снижать операционные издержки и повышать конкурентоспособность.
                AZIMUT IT — это технологичный ростовой актив с чёткой стратегией развития и высокой добавленной стоимостью.
                Мы открыты к инвестиционному партнёрству и заинтересованы в долгосрочном стратегическом росте на международных рынках.
            </p>
        </section>
        <div class="line"><hr noshade></div>
        <section class="about"> <!-- блок "Работа с нами" -->
            <h1>Работа с нами</h1>
            <p>
                Мы не берём любые заказы. Мы за точечные и масштабные цифровые решения.<br>
                <br>
                AZIMUT IT = экспертиза + фокус. Мы работаем с задачами:<br>
                • где нужна инженерия, а не просто дизайн<br>
                • где важен результат, а не только “присутствие в цифре”<br>
                • где клиент — партнёр, а не просто заказчик<br>
                <br>
                Как начинается работа с AZIMUT IT?<br>
                1. Диалог — выясняем задачу и цели<br>
                2. Предпроектная аналитика<br>
                3. Дорожная карта и смета<br>
                4. MVP или первая итерация<br>
                5. Запуск, поддержка, масштаб<br>
                <br>
            </p>
        </section>
    </main>

    <footer class="footer"> <!-- подвал сайта -->
        <div class="container-2">
            <p>Ferwix 2025</p>
        </div>
    </footer>

    <script>
        let entered = <?php echo json_encode($entered); ?>; //преобразование переменной для JS
        let ea = <?php echo json_encode($ea); ?>;

        if (entered === 1) { //если entered = 1, то кнопки авторизации и регистрации заменяются на кнопку входа в личный кабинет
            document.getElementById("auth").style.display = "none";
            document.getElementById("reg").style.display = "none";
            document.getElementById("enter").style.display = "block";
        }

        if (ea === 1) { //если ea = 1, то появится кнопка админ панели
            document.getElementById("adm").style.display = "flex";
        }
    </script>
</body>
</html>