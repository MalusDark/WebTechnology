<?php
    session_start();

    $hostname = "localhost";
    $username = "root";
    $password = "root";
    $databaseName = "orders";
    $connect = mysqli_connect($hostname, $username, $password, $databaseName);
    $usersid = mysqli_query($connect,"SELECT customerName, customerId FROM customers");
    $arrayid = array();

    if(isset($_POST["add"])) 
    {
        $deliveryAdress=htmlspecialchars(strip_tags($_POST["Addres"]));
        $orderNote=htmlspecialchars(strip_tags($_POST["Note"]));
        $orderCost=doubleval(htmlspecialchars(($_POST["Cost"])));
        if($orderCost<0.0)
        {
            $message = 'Цена указана неверно';
        }
        else
        {
            $customerId=htmlspecialchars(($_POST['select_id']));
                
            if(isset($_FILES) && $_FILES['fileFF']['error'] == 0)
            {
                $uploaddir = $_SERVER['DOCUMENT_ROOT'] . '/LR6/image/';
                $uploadfile = $uploaddir . basename($_FILES['fileFF']['name']);
                $tmp_name = $_FILES["fileFF"]["tmp_name"];
                $name = basename($_FILES["fileFF"]["name"]);
                move_uploaded_file($tmp_name, "$uploaddir/$name"); 
                $invoiceScan=htmlspecialchars($_FILES["fileFF"]["name"]);
                $message ='Файл успешно загружен';
                UserTable::add($invoiceScan,$deliveryAdress,$orderNote,$orderCost,$customerId);
            }
            else
            {
                $message = 'Ошибка загрузки файла';
            }
        }
    }
    class UserTable 
    { 
        public static function open()
        {
            $hostname = "localhost";
            $username = "root";
            $password = "root";
            $databaseName = "orders";
            $connect = mysqli_connect($hostname, $username, $password, $databaseName);
            $query = "SELECT transactions.invoiceId,transactions.invoiceScan,transactions.deliveryAdress,transactions.orderNote,transactions.orderCost,customers.customerName FROM transactions inner join customers ON transactions.customerId = customers.customerId ORDER BY transactions.invoiceId ASC";
            $result_table = mysqli_query($connect, $query);
            
            while($row1 = mysqli_fetch_array($result_table))
            {
                $resualt_text = $resualt_text. "<tr><td>".$row1[0]."</td>
                    <td><img src=\"image/".$row1[1]."\" height=250 width=480></img></td>
                    <td>".$row1[2]."</td>
                    <td>".$row1[3]."</td>
                    <td>".$row1[4]."</td>
                    <td>".$row1[5]."</td>
                </tr>";
            }
            return $resualt_text;
        }
        public static function add(string $invoiceScan, string $deliveryAdress, string $orderNote, float $orderCost, int $customerId)
        {
            $hostname = "localhost";
            $username = "root";
            $password = "root";
            $databaseName = "orders";
            $connect = mysqli_connect($hostname, $username, $password, $databaseName);
            
            $query = "INSERT INTO `transactions`(invoiceScan, deliveryAdress, orderNote, orderCost, customerId) VALUES('$invoiceScan','$deliveryAdress','$orderNote','$orderCost','$customerId');";
            
            $update_table = mysqli_query($connect, $query);
            if($update_table != FALSE)
            {
                $message="Запись успешно добавлена";
            }
            else
            {
                $message="Ошибка добавления записи";
            }
            
            return $message;
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
        <div class="col-12">
            <table class="table table-striped table-dark">
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
                    <?php echo $text=UserTable::open(); ?>
                </tbody>
            </table>
            <form enctype="multipart/form-data" method="post" id="feedback-form">
                <label for="fileFF">Прикрепить Скан:</label>
                <br>
                <input required="required" type="file" name="fileFF" multiple id="fileFF" style="width:280px">
                <label for="Address">Адрес:</label>
                <input required="required" type="text" name="Addres" id="Address" style="width:120px">
                <label for="Note">Пояснение:</label>
                <textarea name="Note" id="messageFF" required rows="5" placeholder="Детали заявки…" style="width:120px"></textarea>
                <label for="Cost">Цена:</label>
                <input required="required" type="number" name="Cost" id="Costt" style="width:120px">
                <label for="nameFF">Пользователь:</label>
                <select class="select" name="select_id">
                    <?php
                        while ($row = mysqli_fetch_array($usersid))
                        {
                            echo "<option value='".$row['customerId']."'>".$row['customerName']."</option>";
                        }
                        $selected_id = htmlspecialchars(strip_tags(stripslashes(trim($_GET['select_id']))));
                    ?>
                </select>
                <br>
                <input name="add" value="Добавить" type="submit" id="submitFF">
            </form>
            <?php
                echo $message;
            ?>
        </div>
    </div>
    
    <?php include "footer.php"; ?>
    
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
