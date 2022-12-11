<?php
    session_start();
    error_reporting(0);
    $hostname = "localhost";
    $username = "root";
    $password = "root";
    $databaseName = "orders";

    $connect = mysqli_connect($hostname, $username, $password, $databaseName);
    $addresses = mysqli_query($connect,"SELECT deliveryAdress FROM transactions");

    $query = "SELECT transactions.invoiceId,transactions.invoiceScan,transactions.deliveryAdress,transactions.orderNote,transactions.orderCost,customers.customerName FROM transactions inner join customers ON transactions.customerId = customers.customerId ORDER BY transactions.invoiceId ASC";
    $result_table = mysqli_query($connect, $query);

    if ($_SESSION['user_nem'] == "")
    {
        header('Location: login.php');
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
                <li class="breadcrumb-item"><a href="#" onClick='location.href="index.php"'>Главная</a></li>
                <li class="breadcrumb-item active" aria-current="page">Сортировка</li>
            </ol>
        </nav>
    </div>
    <div class="container">
        <div class ="row">
            <span style="text-align: center">Фильтры поиска</span>
            <span style="text-align: left">По цене</span>
            <form method="GET" id="search">
                <input class="form-control" type="number" name="minimum" placeholder="От" value="<?php
                if (isset($_GET['minimum']))
                    echo $_GET['minimum'];
                else echo 0
                ?>" size="5">
                <br>
                <input class="form-control" type="number" name="maximum" placeholder="До" value="<?php
                if (isset($_GET['maximum']))
                    echo $_GET['maximum'];
                else echo 999999
                ?>" size="5">
                <br>
                <span style="text-align: center">По Адресу</span>
                <br>
                <select class="select" name="select_address">
                    <option value="all">Все адреса</option>
                    <?php
                        while ($deliveryAddress = mysqli_fetch_array($addresses, MYSQLI_ASSOC))
                        {
                            echo "<option value='".$deliveryAddress['deliveryAdress']."'>".$deliveryAddress['deliveryAdress']."</option>";
                        }
                    $selected_address = htmlspecialchars(strip_tags(stripslashes(trim($_GET['select_address']))));
                    ?>
                </select>
                <br>
                <span style="text-align: center">По Имени</span>
                <br>
                <input class="form-control" type="text" name="name" placeholder="Имя" <?php
                if (isset($_GET['name']))
                    echo $_GET['name'];
                else echo ' '
                ?>" size="5">
                <br>
                <span style="text-align: center">По пояснению</span>
                <br>
                <input class="form-control" type="text" name="note" placeholder="Пояснение" <?php
                if (isset($_GET['note'])!='')
                    echo $_GET['note'];
                ?> size="5">
                <br>
                <input type="submit" form="search" value="Принять">
                <input type="reset" form="search" onClick='location.href="orders.php?minimum=0&maximum=999999&select_address=all&name=&note="' value="Сбросить">
            </form>
            <?php
                $min = 0;
                $max = 999999;
                $name = '';
                $note = '';

                if (isset($_GET['minimum']))
                {
                    $min =  $_GET['minimum'];
                }
                if (isset($_GET['maximum']))
                {
                    $max = $_GET['maximum'];
                }
                if (isset($_GET['name']) != '')
                {
                    $name = htmlspecialchars(strip_tags(stripslashes(trim($_GET['name']))));
                }
                if(isset($_GET['note']) != '')
                {
                    $note = htmlspecialchars(strip_tags(stripslashes(trim($_GET['note']))));
                }
                if((!empty($name))and(empty($note))and($selected_address="all"))
                {
                    $query = "SELECT transactions.invoiceId,transactions.invoiceScan,transactions.deliveryAdress,transactions.orderNote,transactions.orderCost,customers.customerName FROM transactions inner join customers ON transactions.customerId = customers.customerId WHERE transactions.orderCost >= '$min' and transactions.orderCost < '$max' and customers.customerName='$name' ORDER BY transactions.invoiceId ASC";
                }
                elseif((!empty($name))and($selected_address!="all")and(empty($note)))
                {
                    $query = "SELECT transactions.invoiceId,transactions.invoiceScan,transactions.deliveryAdress,transactions.orderNote,transactions.orderCost,customers.customerName FROM transactions inner join customers ON transactions.customerId = customers.customerId WHERE transactions.orderCost >= '$min' and transactions.orderCost < '$max' and customers.customerName='$name' and transactions.deliveryAdress = '$selected_address' ORDER BY transactions.invoiceId ASC";
                }
                elseif((!empty($name))and(!empty($note))and($selected_address="all"))
                {
                    $query = "SELECT transactions.invoiceId,transactions.invoiceScan,transactions.deliveryAdress,transactions.orderNote,transactions.orderCost,customers.customerName FROM transactions inner join customers ON transactions.customerId = customers.customerId WHERE transactions.orderCost >= '$min' and transactions.orderCost < '$max' and customers.customerName='$name' and transactions.orderNote = '$note' ORDER BY transactions.invoiceId ASC";
                }
                elseif((!empty($name))and(!empty($note))and($selected_address!="all"))
                {
                    $query = "SELECT transactions.invoiceId,transactions.invoiceScan,transactions.deliveryAdress,transactions.orderNote,transactions.orderCost,customers.customerName FROM transactions inner join customers ON transactions.customerId = customers.customerId WHERE transactions.orderCost >= '$min' and transactions.orderCost < '$max' and customers.customerName='$name' and transactions.orderNote = '$note' and transactions.deliveryAdress = '$selected_address' ORDER BY transactions.invoiceId ASC";
                }
                elseif((!empty($note))and(empty($name))and($selected_address!="all"))
                {
                    $query = "SELECT transactions.invoiceId,transactions.invoiceScan,transactions.deliveryAdress,transactions.orderNote,transactions.orderCost,customers.customerName FROM transactions inner join customers ON transactions.customerId = customers.customerId WHERE transactions.orderCost >= '$min' and transactions.orderCost < '$max' and transactions.orderNote = '$note' and transactions.deliveryAdress = '$selected_address' ORDER BY transactions.invoiceId ASC";
                }
                elseif((!empty($note))and(empty($name))and($selected_address="all"))
                {
                    $query = "SELECT transactions.invoiceId,transactions.invoiceScan,transactions.deliveryAdress,transactions.orderNote,transactions.orderCost,customers.customerName FROM transactions inner join customers ON transactions.customerId = customers.customerId WHERE transactions.orderCost >= '$min' and transactions.orderCost < '$max' and transactions.orderNote = '$note' ORDER BY transactions.invoiceId ASC";
                }
                elseif((empty($note))and(empty($name))and($selected_address!="all"))
                {
                    $query = "SELECT transactions.invoiceId,transactions.invoiceScan,transactions.deliveryAdress,transactions.orderNote,transactions.orderCost,customers.customerName FROM transactions inner join customers ON transactions.customerId = customers.customerId WHERE transactions.orderCost >= '$min' and transactions.orderCost < '$max' and transactions.deliveryAdress = '$selected_address' ORDER BY transactions.invoiceId ASC";
                }
                elseif((empty($note))and(empty($name))and($selected_address!="all"))
                {
                    $query = "SELECT transactions.invoiceId,transactions.invoiceScan,transactions.deliveryAdress,transactions.orderNote,transactions.orderCost,customers.customerName FROM transactions inner join customers ON transactions.customerId = customers.customerId WHERE transactions.orderCost >= '$min' and transactions.orderCost < '$max' and customers.customerName='$name' and transactions.orderNote = '$note' and transactions.deliveryAdress = '$selected_address' ORDER BY transactions.invoiceId ASC";
                }
                else
                {
                    $query = "SELECT transactions.invoiceId,transactions.invoiceScan,transactions.deliveryAdress,transactions.orderNote,transactions.orderCost,customers.customerName FROM transactions inner join customers ON transactions.customerId = customers.customerId WHERE transactions.orderCost >= '$min' and transactions.orderCost < '$max' ORDER BY transactions.invoiceId ASC";
                }
                $result_table = mysqli_query($connect, $query);
            ?>
        </div>
        <div class="row">
            <div class="col-12">
                <table class="table table-bordered" id="orders" class="display" style="width: 100%">
                    <thead>
                    <tr>
                        <th style="width:20px">Id</th>
                        <th style="width:500px">Скан</th>
                        <th style="width:180px">Адрес</th>
                        <th style="width:120px">Пояснение</th>
                        <th style="width:80px">Цена</th>
                        <th style="width:80px">Имя пользователя</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php while($row1 = mysqli_fetch_array($result_table)):;?>
                        <tr>
                            <td><?php echo $row1[0];?></td>
                            <td><img src="image/<?php echo $row1[1];?>" alt="" height=550 width=500></img></td>
                            <td><?php echo $row1[2];?></td>
                            <td><?php echo $row1[3];?></td>
                            <td><?php echo $row1[4];?></td>
                            <td><?php echo $row1[5];?></td>
                        </tr>
                    <?php endwhile;?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
 <?php include "footer.php"; ?>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>