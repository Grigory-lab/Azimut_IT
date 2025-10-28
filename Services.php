<?php
    include "DB.php"; //включение файла с подключением к БД
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
        <h1>Услуги</h1>
        <section class="standart-block2"> <!-- секция услуг -->
                <?php
                    $query = "SELECT * FROM services";
                    $result = mysqli_query($conn, $query);

                    if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo '<div class="master-block">';
                            echo '  <div class="service-im">';
                            echo '<img src="image.php?id=' . $row['Service_ID'] . '" alt="Услуга" width="100px" height="100px">';
                            echo '  </div>';
                            echo '  <div class="master-info">';
                            echo '      <h2>' . htmlspecialchars($row['Name']) . '</h2>';
                            echo '      <p>' . htmlspecialchars($row['Description']) . '</p>';
                            echo '  </div>';
                            echo '</div>';
                        }
                    } else {
                        echo '<p>Услуги не найдены.</p>';
                    }
                ?>
        </section>
    </main>

    <footer class="footer"> <!-- подвал сайта -->
        <div class="container-2">
            <p>Ferwix 2025</p>
        </div>
    </footer>
</body>
</html>