<?php
    include "DB.php"; //включение файла с подключением к БД

    if (isset($_POST['logout'])) { //если кнопка выхода нажата
        session_unset(); //уничтожение переменных сессии
        session_destroy();  //уничтожение сессии
        header("Location: Main.php"); 
        exit();
    }
    $error = 0;

    $budget_query = "SELECT Budget_ID, Cost FROM budget";     // Получение списка бюджета
    $budget_result = mysqli_query($conn, $budget_query);

    $services_query = "SELECT Service_ID, Name FROM services";     // Получение списка услуг
    $services_result = mysqli_query($conn, $services_query);

    if (isset($_SESSION['login-a'])) { //Сохранение переменной логина сессии в другую переменную
        $login = $_SESSION['login-a'];
    }
    else
    {
        $login = $_SESSION['login-r'];
    }
    $sql = "SELECT Full_name, Login, Mail, Phone_number FROM clients WHERE Login = '$login'"; //запрос на получение данных пользователя
    $result = mysqli_query($conn, $sql); //сохранение результата
    $client = mysqli_fetch_assoc($result);

    if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST['budget']) && !empty($_POST['service']) && !empty($_POST['description'])) { //сохранение данных из формы в переменные сессии
        $_SESSION['budget'] = htmlspecialchars($_POST['budget']);
        $_SESSION['service'] = htmlspecialchars($_POST['service']);
        $_SESSION['description'] = htmlspecialchars($_POST['description']);
    } 

    if (isset($_SESSION['budget'])) { //Сохранение переменных сессии в другие переменные
        $me = $_SESSION['budget'];
        $se = $_SESSION['service'];
        $de = $_SESSION['description'];
    }

    if (isset($_POST['entry']) && isset($_SESSION['budget']) && isset($_SESSION['service']) && isset($_SESSION['description'])) { //условие "если переменные сессии установлены"
        $sql_id = "SELECT Client_ID FROM clients WHERE Login = '$login'";
        $result_id = mysqli_query($conn, $sql_id);
        $row_client = mysqli_fetch_assoc($result_id);
        $client_id = $row_client['Client_ID'];

        $sqlm_id = "SELECT Budget_ID FROM budget WHERE Budget_ID = '$me'";
        $m_result = mysqli_query($conn, $sqlm_id);
        $row_bu = mysqli_fetch_assoc($m_result);
        $bu_id = $row_bu['Budget_ID'];

        $sqls_id = "SELECT Service_ID FROM services WHERE Service_ID = '$se'";
        $s_result = mysqli_query($conn, $sqls_id);
        $row_service = mysqli_fetch_assoc($s_result);
        $service_id = $row_service['Service_ID'];

        $sql = "INSERT INTO entries (Description, Budget_ID, Service_ID, Client_ID) VALUES 
        ('$de', '$bu_id', '$service_id', '$client_id')";
        $result = mysqli_query($conn, $sql);

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
        <section class="account-info"> <!-- секция для информации о пользователе -->
            <h1>Личный кабинет</h1>
            <p>ФИО: <?php echo htmlspecialchars($client["Full_name"]); ?></p>
            <p>Логин: <?php echo htmlspecialchars($client["Login"]); ?></p>
            <p>Эл. почта: <?php echo htmlspecialchars($client["Mail"]); ?></p>
            <p>Телефон: <?php echo htmlspecialchars($client["Phone_number"]); ?></p>
            <form method="post">
                <button name="logout">Выйти из аккаунта</button> 
            </form>                                   
        </section>

        <section class="standart-block accountp"> <!-- секция с формой записи -->
            <h3>Подайте заявку</h3>
            <form class="form-section" method="post">
                <div class="form-account">
                    <div class="admin-in">
                        <p>Услуга</p>
                        <select class="table" name="service" required>
                            <?php while ($row = mysqli_fetch_assoc($services_result)) : ?>
                                <option value="<?php echo $row['Service_ID']; ?>">
                                    <?php echo htmlspecialchars($row['Name']); ?>
                                </option>
                            <?php endwhile; ?>
                        </select>
                    </div>
                    <div class="admin-in">
                        <p>Бюджет</p>
                        <select class="table" name="budget" required>
                            <?php while ($row = mysqli_fetch_assoc($budget_result)) : ?>
                                <option value="<?php echo $row['Budget_ID']; ?>">
                                    <?php echo htmlspecialchars($row['Cost']); ?>
                                </option>
                            <?php endwhile; ?>
                        </select>
                    </div>
                    <div class="admin-in">
                        <p>Описание</p>
                        <textarea type="text" class="enter-question" name="description" required></textarea>
                    </div>

                </div>
                <input type="submit" value="Отправить заявку" class="finish" name="entry">
            </form>
        </section>
    </main>

    <footer class="footer"> <!-- подвал сайта -->
        <div class="container-2">
            <p>Ferwix 2025</p>
        </div>
    </footer>

</body>
</html>