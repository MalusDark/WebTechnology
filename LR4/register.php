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
    
 <?php include "header.php"; ?>
    
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
 <?php include "footer.php"; ?>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>