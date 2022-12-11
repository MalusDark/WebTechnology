<?php
    session_start();
    error_reporting(0);
    if($_GET["out"] == "true")
    {
        $_SESSION['user_nem'] = "";
        unset($_SESSION['user_nem']);
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
                        <li class="breadcrumb-item active" aria-current="page">Главная</li>
                    </ol>
                </nav>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col">
                        <div class="pictures">
                            <img src="image/jaf-доска-лиственница.jpg" style="max-width: 60%;max-height: 55%;">
                        </div>
                    </div>
                    <div class="col-lg">
                        <div class="row">
                            <div class="item_name fw-weight-bold">
                                Доска ЛИСТВЕННИЦА, сорт АВС, 50х100х6000 мм
                            </div>
                            <div class="item_name">
                                <span>60,000.00 P</span>
                            </div>
                            <span>Цена розничная указана за м^3</span>
                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <th scope="col">Толщина</th>
                                    <td scope="col">50 мм</td>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <th>Ширина</th>
                                    <td>100 мм</td>
                                </tr>
                                <tr>
                                    <th>Длинна</th>
                                    <td>6000 мм</td>
                                </tr>
                                </tbody>
                            </table>
                            <div class="availability" style="color:red">
                                <span>Нет в наличии</span>
                            </div>
                            <div class="information">
                                <span>Артикул: 99999/0205-1 Категория: Обрезная доска Метка: Лиственница</span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-1">
                            <input name="input" type="button" value="Описание" onclick="document.getElementById('pole').value='Описание\n'+'Производитель: Красноярск\n'+'\n'+'Обрезная доска из лиственницы — это неотшлифованный пласт дерева, очищенный от коры и обзола. Лиственница прекрасно зарекомендовала себя в качестве строительного материала для создания различных пристроек, покрытия полов и устройства придомовых территорий. Доски из лиственницы востребованы благодаря прочности, прекрасному внешнему виду и долговечности.';"/>
                        </div>
                        <div class="col-1">
                            <input name="input" type="button" value="Детали" onclick="document.getElementById('pole').value='';"/>
                        </div>
                        <div class="col-1">
                            <input name="input" type="button" value="Отзывы(0)" onclick="document.getElementById('pole').value='';"/>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <span class="fs-3"> Описание </span>
                        <span> Производитель: Красноярск </span>
                        <span>Обрезная доска из лиственницы — это неотшлифованный пласт дерева, очищенный от коры и обзола. Лиственница прекрасно зарекомендовала себя в качестве строительного материала для создания различных пристроек, покрытия полов и устройства придомовых территорий. Доски из лиственницы востребованы благодаря прочности, прекрасному внешнему виду и долговечности.</span>
                    </div>
                </div>
                <div class="similar">
                    <div class="row">
                        <span class="fs-3">Похожие товары</span>
                        <div class="col-3">
                            <div class="card" style="width: 18rem;">
                                <img src="image/JAF-доска-пола-лиственница-300x300.jpg" class="card-img-top" alt="...">
                                <div class="card-body">
                                    <p class="card-text">
                                        Доска пола Лиственница ВС
                                        <span>769.00 P</span>
                                        <br>
                                        <button>
                                            В корзину
                                        </button>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="card" style="width: 18rem;">
                                <img src="image/jaf-террасная-доска-лиственница-300x300.jpg" class="card-img-top" alt="...">
                                <div class="card-body">
                                    <p class="card-text">
                                        Террасная доска Лиственница Прима
                                        <span>2,550.00 P</span>
                                        <br>
                                        <button>
                                            В корзину
                                        </button>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="card" style="width: 18rem;">
                                <img src="image/jaf-доска-ясень-300x300.jpg" class="card-img-top" alt="...">
                                <div class="card-body">
                                    <p class="card-text">
                                        Доска ЯСЕНЬ сорт AB, длина от 2000 мм, толщина 30/50 мм
                                        <span>153,400.00 P</span>
                                        <br>
                                        <button>
                                            В корзину
                                        </button>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="card" style="width: 18rem;">
                                <img src="image/jaf-лага-лиственница-300x300.jpg" class="card-img-top" alt="...">
                                <div class="card-body">
                                    <p class="card-text">
                                        Лага лиственница цельностроганая АВ
                                        <span>300.00 P</span>
                                        <br>
                                        <button>
                                            В корзину
                                        </button>
                                    </p>
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