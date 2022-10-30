<?php
session_start();
error_reporting(0);
$server = "localhost";
$username = "root";
$password = "root";
$database = "users";

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
$mysqli = mysqli_connect($server, $username, $password, $database);

if(isset($_POST["register"])) {
    $email = htmlspecialchars(($_POST["email"]));
    $username = htmlspecialchars(($_POST["userName"]));
    $accepted_password = htmlspecialchars(($_POST['password_accept']));
    $password = htmlspecialchars(($_POST["password"]));
    $hash_password = password_hash($password, PASSWORD_DEFAULT);
    $birthday_day = date('Y-m-d', strtotime($_POST['birthdayDate']));
    $user_address = htmlspecialchars(($_POST["userAddress"]));
    $user_inst = htmlspecialchars(($_POST["userInst"]));
    $gender = $_POST['inlineRadioOptions'];
    $user_interests = htmlspecialchars(($_POST["interests"]));
    $query = mysqli_query($mysqli, "SELECT * FROM usersdata WHERE userName='$username' or email='$email'");
    $numrows = mysqli_num_rows($query);
    if ($password == $accepted_password)
    {
        if ($numrows == 0)
        {
            $sql = ("INSERT INTO `usersdata` (`email`, `userName`, `password`, `birthdayDate`, `Gender`, `userAddress`, `userInst`, `interests`)
            VALUES('$email','$username', '$hash_password', '$birthday_day', '$gender', '$user_address', '$user_inst', '$user_interests')");
            $result = mysqli_query($mysqli, $sql);
            if ($result)
            {
                $message = "Аккаунт успешно создан";
                $_SESSION['user_nem'] = $username;
                header('Location: index.php');
            } else {
                $message = "Неверный формат введенныйх данных";
            }
        }
        else
        {
            $message = "Данное имя пользователя или почта уже используется";
        }
    }
    else
    {
        $message = "Пароли не совпадают";
    }
}

?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WoodFamily</title>
    <link rel="stylesheet" href="MainStyle.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body class="d-flex flex-column min-vh-100">
<div class="container-fluid" >
    <div class="row" style="max-width: 45%">
        <div class="col-3">
            <a class="contact-phone" href="tel:89375381690" title="8 800 555 35 35">
                <span> 8 937 538 16 90</span>
            </a>
        </div>
        <div class="col-3">
            <div class="work-time">
                <span>9:00 - 18:00</span>
            </div>
        </div>
        <div class="col-3">
            <a class="contact-mail" href="mailto:artem.kotegov@mail.ru" title="artem.kotegov@mail.ru">
                <span>artem.kotegov@mail.ru</span>
            </a>
        </div>
    </div>
    <div class="container-fluid" style="background-color: #F8F9FA">
        <div class="row" style="box-shadow:
                 0 15px 15px  -15px dimgrey ,
                 0 -15px 15px  -15px dimgrey;">
            <div class="col-12">
                <nav class="navbar navbar-expand-lg navbar-light bg-light">
                    <div class="container-fluid">
                        <a class="navbar-brand" href="#" onClick='location.href="index.php"'>
                            <img src="image/icon.png" style="max-width: 250px;max-height: 150px;">
                        </a>
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Переключатель навигации">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <ul class="navbar-nav me-auto">
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown1" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        О нас
                                    </a>
                                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown1">
                                        <li><a class="dropdown-item" href="#">JAF в мире</a></li>
                                    </ul>
                                </li>
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown2" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        Продукция из древесины
                                    </a>
                                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown2">
                                        <ul class="navbar-nav">
                                            <li class="nav-item dropdown">
                                                <a class="nav-link dropdown-toggle" href="#" role="button" id="navbarDropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                                                    Пиломатериалы
                                                </a>
                                                <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                                    <li><a class="dropdown-item" href="#">Обрезанная доска</a></li>
                                                    <li><a class="dropdown-item" href="#">Необрезанная доска</a></li>
                                                    <li><a class="dropdown-item" href="#">Слэбы</a></li>
                                                    <li><a class="dropdown-item" href="#">Торцевые спилы и капы</a></li>
                                                    <li><a class="dropdown-item" href="#">Столярная заготовка</a></li>
                                                </ul>
                                            </li>
                                        </ul>
                                        <li><a class="dropdown-item" href="#">Шпон</a></li>
                                        <li><a class="dropdown-item" href="#">Террасная доска</a></li>
                                        <li><a class="dropdown-item" href="#">Фасадная доска</a></li>
                                        <li><a class="dropdown-item" href="#">Термососна</a></li>
                                        <li><a class="dropdown-item" href="#">Термоясень</a></li>
                                        <li><a class="dropdown-item" href="#">Масло для дерева</a></li>
                                        <li><a class="dropdown-item" href="#">Термососна</a></li>
                                        <li><a class="dropdown-item" href="#">Крепеж</a></li>
                                        <li><a class="dropdown-item" href="#">Столярная плита</a></li>
                                        <li><a class="dropdown-item" href="#">Мебельный щит</a></li>
                                        <li><a class="dropdown-item" href="#">Панели Мдф</a></li>
                                        <li><a class="dropdown-item" href="#">Паркет</a></li>
                                        <ul class="navbar-nav">
                                            <li class="nav-item dropdown">
                                                <a class="nav-link dropdown-toggle" href="#" role="button" id="navbarDropdownMenuLink1" data-bs-toggle="dropdown" aria-expanded="false">
                                                    Фанера
                                                </a>
                                                <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink1">
                                                    <li><a class="dropdown-item" href="#">Ламинированная фанера</a></li>
                                                </ul>
                                            </li>
                                        </ul>
                                        <li><a class="dropdown-item" href="#">Клей</a></li>
                                        <li><a class="dropdown-item" href="#">Напольные покрытия Eurowood</a></li>
                                        <li><a class="dropdown-item" href="#">Погонаж из лиственницы</a></li>
                                    </ul>
                                </li>
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown3" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        Кровельная продукция RUUKKI
                                    </a>
                                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown3">
                                        <li><a class="dropdown-item" href="#">Металлочерепица Hyygge</a></li>
                                        <li><a class="dropdown-item" href="#">Металлочерепица Finnera</a></li>
                                        <li><a class="dropdown-item" href="#">Металлочерепица Frigge</a></li>
                                        <li><a class="dropdown-item" href="#">Металлочерепица Adamante</a></li>
                                        <li><a class="dropdown-item" href="#">Металлочерепица Elite</a></li>
                                        <li><a class="dropdown-item" href="#">Металлочерепица Monterrey</a></li>
                                        <li><a class="dropdown-item" href="#">Металлочерепица Monterrey FEB</a></li>
                                        <li><a class="dropdown-item" href="#">Металлочерепица Classic C</a></li>
                                        <li><a class="dropdown-item" href="#">Металлочерепица Classic D</a></li>
                                        <li><a class="dropdown-item" href="#">Металлочерепица Classic Silence</a></li>
                                        <li><a class="dropdown-item" href="#">Металлочерепица Classic Authentic</a></li>
                                        <li><a class="dropdown-item" href="#">Металлочерепица Ruukki Classic M</a></li>
                                    </ul>
                                </li>
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown4" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        Заказ и оплата
                                    </a>
                                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown4">
                                        <li><a class="dropdown-item" href="#">Оплата на сайте</a></li>
                                    </ul>
                                </li>
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-x" href="#" id="navbarDropdown5" role="button" data-bs-toggle="dropdown" aria-expanded="false" onClick='location.href="orders.php?minimum=0&maximum=999999&select_address=all&name=&note="'>
                                        Доставка
                                    </a>
                                </li>
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-x" href="#" id="navbarDropdown6" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        Контакты
                                    </a>
                                </li>
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-x" href="#" id="navbarDropdown7" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        Породы дерева
                                    </a>
                                </li>
                            </ul>
                            <form class="d-flex">
                                <input class="form-control me-2" type="search" placeholder="Поиск" aria-label="Поиск">
                                <button class="btn btn-success" type="submit">Поиск</button>
                            </form>
                            <div class="registration">
                                <?php
                                if ($_SESSION['user_nem'] !="")
                                {
                                    echo "Вы вошли как ". $_SESSION['user_nem'] . "<br>";
                                    echo "<a href='index.php?out=true'>Выйти</a>";
                                }
                                else
                                {
                                    echo "Вы не авторизованы.";
                                    echo "<br>";
                                    echo "<a href='register.php'>Зарегистрироваться</a>";
                                    echo "<br>";
                                    echo "<a href='login.php'>Войти</a>";
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </nav>
            </div>
        </div>
    </div>
    <div class="row">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active" aria-current="page">Регистрация</li>
            </ol>
        </nav>
    </div>
    <div class="container">
        <div class="row">
            <div class="container py-5 h-100">
                <div class="row justify-content-center align-items-center h-100">
                    <div class="col-12">
                        <div class="card shadow-2-strong card-registration" style="border-radius: 15px; background: linear-gradient(45deg, #EECFBA, #C5DDE8);">
                            <div class="card-body p-4 p-md-5">
                                <h3 class="mb-4">Регистрация</h3>
                                <form action="" method="post" id="form_register" name="form_register">
                                    <div class="row">
                                        <div class="col-md-6 mb-4">
                                            <div class="form-outline">
                                                <input required="required" type="email" name="email" class="form-control form-control-lg" />
                                                <label class="form-label" for="email">Почта</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-4">
                                            <div class="form-outline">
                                                <input required="required" type="text" name="userName" class="form-control form-control-lg" />
                                                <label class="form-label" for="userName">Имя пользователя</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 mb-4 d-flex align-items-center">
                                            <div class="form-outline datepicker w-100">
                                                <input required="required" type="date" class="form-control" name="birthdayDate" id="birthdayDate" />
                                                <label for="birthdayDate" class="form-label">Дата рождения</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-4">
                                            <h6 class="mb-2 pb-1">Пол: </h6>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="inlineRadioOptions" id="femaleGender"
                                                       value="Female" checked />
                                                <label class="form-check-label" for="femaleGender">Жен.</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="inlineRadioOptions" id="maleGender"
                                                       value="Male" />
                                                <label class="form-check-label" for="maleGender">Муж.</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 mb-4 pb-2">
                                            <div class="form-outline">
                                                <input required="required" type="text" name="userAddress" class="form-control form-control-lg" />
                                                <label class="form-label" for="userAddress">Адрес</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-4 pb-2">
                                            <div class="form-outline">
                                                <input required="required" type="text" name="userInst" class="form-control form-control-lg" />
                                                <label class="form-label" for="userInst">Инстаграмм</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 mb-4 pb-2">
                                            <div class="form-outline">
                                                <input required="required" type="text" name="interests" class="form-control form-control-lg" />
                                                <label class="form-label" for="interests">Интересы</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-4 pb-2">
                                            <div class="form-outline">
                                                <input required="required" type="password" name="password" class="form-control form-control-lg" />
                                                <label class="form-label" for="interests">Пароль</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 mb-4 pb-2">
                                            <div class="form-outline">
                                                <input required="required" type="password" name="password_accept" class="form-control form-control-lg" />
                                                <label class="form-label" for="password_accept">Подтверждение пароля</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mt-4 pt-2">
                                        <button type="submit" name="register" class="btn btn-dark" value="Зарегистрироваться" style="border-radius: 8px;">Зарегистрироваться</button>
                                    </div>
                                </form>
                                <?php echo "<p class='error'>" . "MESSAGE: ". $message . "</p>"; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<footer class="footer mt-auto py-3 bg-light">
    <section class="articles_block" style="background-color: #313131;color:#77737E">
        <div class="container text-left text-md-start mt-5">
            <div class="row mt-3">
                <div class="col-3">
                    <div class="row">
                        <span>Породы дерева</span>
                    </div>
                    <div class="row">
                        <span>Каталог</span>
                    </div>
                    <div class="row">
                        <span>JAF в мире</span>
                    </div>
                    <div class="row">
                        <span>Контакты</span>
                    </div>
                </div>
                <div class="col-6">

                </div>
                <div class="col-3 float-end">
                    <div class="articles text-left" style="color:#F2FFFF">
                        Статьи
                        <div class="row">
                            <ul class="list-group list-group-horizontal">
                                <li class="list-group-item" style="background-color: #313131;"><img src="image/articles1.jpg" style="max-width: 150px;max-height: 150px;color:#3A3A3A">Особенности пород древесины</li>
                                <li class="list-group-item" style="background-color: #313131;"> <img src="image/articles2.jpg" style="max-width: 150px;max-height: 150px;color:#3A3A3A">Мебельный щит и способы его применения</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div class="footer">
        <div class="text-left p-4" style="background-color:#242424;">
            <p class="text-break" style=" color:#77737E">© 2022 ООО "Лесная семья" - дерево наш мир – Все права защищены. Официальный сайт</p>
            <p class="text-break" style=" color:#77737E">ООО "Джей Эй Эф Рус" https://wood-family.ru</p>
        </div>
    </div>
</footer>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>