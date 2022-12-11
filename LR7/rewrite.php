<?php
    session_start();

    $hostname = "localhost";
    $username = "root";
    $password = "root";
    $databaseName = "orders";
    $connect = mysqli_connect($hostname, $username, $password, $databaseName);

    $selected_id = htmlspecialchars(strip_tags(stripslashes(trim($_GET['select_id']))));
    
    if(isset($_POST['rewrite']))
    {
        $deliveryAdress=htmlspecialchars(strip_tags($_POST["Addres"]));
        $orderNote=htmlspecialchars(strip_tags($_POST["Note"]));
        $orderCost=doubleval(htmlspecialchars(($_POST["Cost"])));
        $customerId=htmlspecialchars(($_POST['select_id']));
               
        if($orderCost<0.0)
        {
            $message = 'Цена указана неверно';
        }
        else
        {
            if(isset($_FILES) && $_FILES['fileFF']['error'] == 0)
            {
                $uploaddir = $_SERVER['DOCUMENT_ROOT'] . '/LR7/image/';
                $uploadfile = $uploaddir . basename($_FILES['fileFF']['name']);
                $tmp_name = $_FILES["fileFF"]["tmp_name"];
                $name = basename($_FILES["fileFF"]["name"]);
                move_uploaded_file($tmp_name, "$uploaddir/$name"); 
                $invoiceScan=htmlspecialchars($_FILES["fileFF"]["name"]);
                $message ='Файл успешно загружен';
                $rew_id = $_GET['rew_id'];
                $query = "SELECT invoiceScan FROM transactions WHERE invoiceId = '$rew_id'";
                $result_table = mysqli_query($connect, $query);
                $row1 = mysqli_fetch_array($result_table);
                $path = $_SERVER['DOCUMENT_ROOT'] . '/LR7/image/'.$row1[0];
                unlink($path);
                $fileName = htmlspecialchars($_FILES["fileFF"]["name"]);
                $query = "UPDATE `transactions` SET invoiceScan = '$fileName', deliveryAdress = '$deliveryAdress', orderNote = '$orderNote', orderCost = '$orderCost', customerId = '$customerId' WHERE invoiceId = '$rew_id'";
                $result_table = mysqli_query($connect, $query);
                header('Location: CR_Table.php');
            }
            else
            {
                $rew_id = $_GET['rew_id'];
                $query = "SELECT invoiceScan FROM transactions WHERE invoiceId = '$rew_id'";
                $result_table = mysqli_query($connect, $query);
                $row1 = mysqli_fetch_array($result_table);
                $query = " UPDATE `transactions` SET invoiceScan = '$row1[0]', deliveryAdress = '$deliveryAdress', orderNote = '$orderNote', orderCost = '$orderCost', customerId = '$customerId' WHERE invoiceId = '$rew_id'";
                $result_table = mysqli_query($connect, $query);
                header('Location: CR_Table.php');
            }
        }
    }
    class UserTable 
    { 
        public static function OpenSelected()
        {
            $hostname = "localhost";
            $username = "root";
            $password = "root";
            $databaseName = "orders";
            $connect = mysqli_connect($hostname, $username, $password, $databaseName);
            $selectId = $_GET[rew_id];
            $query = "SELECT transactions.invoiceId,transactions.invoiceScan,transactions.deliveryAdress,transactions.orderNote,transactions.orderCost,customers.customerName FROM transactions inner join customers ON transactions.customerId = customers.customerId WHERE transactions.invoiceId = '$selectId' ORDER BY transactions.invoiceId ASC";
            $result_table = mysqli_query($connect, $query);
            $usersid = mysqli_query($connect,"SELECT customerName, customerId FROM customers");
            $arrayid = array();
            
            while($row1 = mysqli_fetch_array($result_table))
            {
                $resualt_text = $resualt_text. "<tr><td>".$row1[0]."</td>
                    <td><img src=\"image/".$row1[1]."\" height=250 width=480></img></td>
                    <td>".$row1[2]."</td>
                    <td>".$row1[3]."</td>
                    <td>".$row1[4]."</td>
                    <td>".$row1[5]."</td>
                </tr>
                </tbody>
            </table>
            <form enctype=\"multipart/form-data\" method=\"post\" id=\"feedback-form\">
                <label for=\"fileFF\">Прикрепить Скан:</label>
                <br>
                <input type=\"file\" value = '".$row1[1]."' name=\"fileFF\" multiple id=\"fileFF\" style=\"width:280px\">
                <label for=\"Address\">Адрес:</label>
                <input type=\"text\" value = '".$row1[2]."' name=\"Addres\" id=\"Address\" style=\"width:120px\">
                <label for=\"Note\">Пояснение:</label>
                <textarea name=\"Note\" id=\"messageFF\" required rows=\"5\" placeholder=\"Детали заявки…\" style=\"width:120px\">".$row1[3]."</textarea>
                <label for=\"Cost\">Цена:</label>
                <input type=\"number\" value = '".$row1[4]."' name=\"Cost\" id=\"Costt\" style=\"width:120px\">
                <label for=\"nameFF\">Пользователь:</label>
                <select class=\"select\" name=\"select_id\">";
                        while ($row = mysqli_fetch_array($usersid))
                        {
                            $resualt_text = $resualt_text. "<option value='".$row['customerId']."'>".$row['customerName']."</option>";
                        }
                        $resualt_text = $resualt_text. " </select>
                <br>
                <input name=\"rewrite\" value=\"Подтвердить\" type=\"submit\" id=\"submitFF\">
            </form>";
            }
            return $resualt_text;
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
                    <?php echo $text=UserTable::OpenSelected(); ?>
                
            <?php
                echo $message;
            ?>
        </div>
    </div>
    
    <?php include "footer.php"; ?>
    
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
