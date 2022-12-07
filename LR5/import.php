<?php
    session_start();
    error_reporting(0);

    function check_file_exists_here($url)
    {
       $result=get_headers($url);
       return stripos($result[0],"200 OK")?true:false;
    }
    $server = "localhost";
    $username = "root";
    $password = "root";
    $database = "users";
    
    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
    $mysqli = mysqli_connect($server, $username, $password, $database);
    
    if($_SERVER['REQUEST_METHOD'] == 'POST') 
    {
        $path = ($_POST["path"]);
        if(check_file_exists_here($path))
        {
            $file = basename($path, ".csv");
            $file = $file."_import";
            $fh = fopen($path, "r");
            $query = mysqli_query($mysqli, "DROP TABLE IF EXISTS $file");
            $query = mysqli_query($mysqli, "CREATE TABLE $file(invoiceId int(25) NOT NULL PRIMARY KEY,invoiceScan varchar(150),deliveryAdress varchar(60),orderNote text,orderCost decimal(10,2),customerId int(11))");
            fgetcsv($fh,',');
            if (($handle = fopen($path, "r")) !== FALSE) 
            {
                $count_row=0;
                while (($row = fgetcsv($fh, ',')) !== false) 
                {
                    list($invoiceId, $invoiceScan, $deliveryAdress, $orderNote, $orderCost, $customerId) = $row;
                    settype($invoiceId,'integer');
                    $invoiceScan = mysqli_real_escape_string($mysqli,$invoiceScan);
                    $deliveryAdress = mysqli_real_escape_string($mysqli,$deliveryAdress);
                    $orderNote = mysqli_real_escape_string($mysqli,$orderNote);
                    settype($orderCost,'double'); 
                    settype($customerId,'integer');
                    $query = mysqli_query($mysqli, "INSERT INTO `$file` VALUES('$invoiceId','$invoiceScan','$deliveryAdress', '$orderNote','$orderCost','$customerId');");
                    $count_row++;
                }
                fclose($handle);
                $message = "Файл с данными получен из $path и обработан. Создана таблица $file число записей в ней-$count_row";
            }
        }        
        else
        {
            $message = "Ошибка чтения файла, возможно неверно указано название";
        }
    }
    clearstatcache();
    
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
            <input type="text" required="required" name="path" placeholder="http://localhost/LR3(1)/import/import.csv" style="box-shadow:0 0 15px 4px rgba(0,0,0,0.06); border-radius:10px; margin:10px 0;  border: 2px solid #755a57;" />
            <br>
             <button type="submit" name="import" class="btn btn-dark"style="border-radius: 8px;">Импорт</button>
        </div>
    </form>
    <br>
    <?php 
        echo $message;
    ?>
    
    <?php include "footer.php"; ?>
    
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
