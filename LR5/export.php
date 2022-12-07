<?php
    session_start();
    error_reporting(0);

    $server = "localhost";
    $username = "root";
    $password = "root";
    $database = "users";
    
    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
    $mysqli = mysqli_connect($server, $username, $password, $database);
    
    if($_SERVER['REQUEST_METHOD'] == 'POST') 
    {
        $path = $_SERVER['DOCUMENT_ROOT'] . '/LR5/export/';
        $query = mysqli_query($mysqli, "SELECT * FROM orders_import");
        $fp = fopen($path.'orders_export.csv', 'w');
        
        $head = array(invoiceId, invoiceScan, deliveryAdress, orderNote, orderCost, customerId);
        fputcsv($fp,$head);
        
        while($row = mysqli_fetch_assoc($query))
        {
            $array[] = $row;
        }        
        foreach($array as $file_array)
        {       
            fputcsv($fp, $file_array);
        }
        
        fclose($fp);
        $message = "Файл с данными сохранен на диск по адресу: /export/transactions_exported.csv";
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
    
    <br>Формат - csv
    <br>Способ экспорта - Файл на сервере
    <br>Способ импорта - Файл с локального сервера    
    <form action="" method="post" enctype=”multipart/form-data”>
        <div class="form-group">
             <button type="submit" name="export" class="btn btn-dark"style="border-radius: 8px;">Экспортировать</button>
        </div>
    </form>
    <?php 
        echo $message; 
    ?>
    <?php include "footer.php"; ?>
    
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
