<?php
    session_start();

    function Ex1($text)
    {
        $count1 = preg_match_all('/<h1(?=(?:[^<>]*)?)>/', $text);
        for($i=1;$i<=$count1; $i++)
        {
            $text = preg_replace('/<\/h[1]>/', '</li>', $text, 1);
            if($i==1)
            {
                $text = preg_replace('/<h1(?=(?:[^<>]*)?)>/','<ol><li>', $text, 1);
                $sometext = substr($text, 0, strpos($text, '<h1>'));
                $count2 = preg_match_all('/<h2(?=(?:[^<>]*)?)>/', $sometext);
                for($j=1;$j<=$count2; $j++)
                {
                    if($j==1)
                    {
                        $text = preg_replace('/<h2(?=(?:[^<>]*)?)>/','<ol><li>', $text, 1);
                        $text = preg_replace('/<\/h[2]>/', '</li>', $text, 1);
                    }
                    if($j==1)
                    {
                        $text = preg_replace('/<h2(?=(?:[^<>]*)?)>/','<li>', $text, 1);
                        $text = preg_replace('/<\/h[2]>/', '</li>', $text, 1);
                    }
                    if($j==1)
                    {
                        $text = preg_replace('/<h2(?=(?:[^<>]*)?)>/','<li>', $text, 1);
                        $text = preg_replace('/<\/h[2]>/', '</li></ol>', $text, 1);
                    }
                }
            }
            if($i>1 and $i < $count1)
            {
                $text = preg_replace('/<h1(?=(?:[^<>]*)?)>/','<li>', $text, 1);
                $sometext = substr($text, 0, strpos($text, '<h1>'));
                $count2 = preg_match_all('/<h2(?=(?:[^<>]*)?)>/', $sometext);
                for($j=1;$j<=$count2; $j++)
                {
                    if($j==1)
                    {
                        $text = preg_replace('/<h2(?=(?:[^<>]*)?)>/','<ol><li>', $text, 1);
                        $text = preg_replace('/<\/h[2]>/', '</li>', $text, 1);
                    }
                    if($j==1)
                    {
                        $text = preg_replace('/<h2(?=(?:[^<>]*)?)>/','<li>', $text, 1);
                        $text = preg_replace('/<\/h[2]>/', '</li>', $text, 1);
                    }
                    if($j==1)
                    {
                        $text = preg_replace('/<h2(?=(?:[^<>]*)?)>/','<li>', $text, 1);
                        $text = preg_replace('/<\/h[2]>/', '</li></ol>', $text, 1);
                    }
                }
            }
            if($i==$count1)
            {
                $text = preg_replace('/<h1(?=(?:[^<>]*)?)>/','<li>', $text, 1);
                $count2 = preg_match_all('/<h2(?=(?:[^<>]*)?)>/', $text);
                for($j=1;$j<=$count2; $j++)
                {
                    if($j==1)
                    {
                        $text = preg_replace('/<h2(?=(?:[^<>]*)?)>/','<ol><li>', $text, 1);
                        $text = preg_replace('/<\/h[2]>/', '</li>', $text, 1);
                    }
                    if($j==1)
                    {
                        $text = preg_replace('/<h2(?=(?:[^<>]*)?)>/','<li>', $text, 1);
                        $text = preg_replace('/<\/h[2]>/', '</li>', $text, 1);
                    }
                    if($j==1)
                    {
                        $text = preg_replace('/<h2(?=(?:[^<>]*)?)>/','<li>', $text, 1);
                        $text = preg_replace('/<\/h[2]>/', '</li></ol>', $text, 1);
                    }
                }
            }
        }
        return $text;
    }
    function Ex7($text)
    {
        $text = preg_replace(array('~[,]{3,}~', '~[!]{3,}~', '~[?]{3,}~', '~[.]{3,}~'), array(',,,', '!!!', '???', '&#8230;'), $text);
        return $text;
    }
    function Ex14($text)
    {
        $text = stripslashes($text);
        preg_match_all('#<\s*?a href\b[^>]*>(.*?)</a\b[^>]*>#s', $text, $items);

        if (!empty($items[1])) 
        {
            $newline = "
                <div class=\"texts-list\">
                <h3>Содержание</h3>
                <ol>";
                foreach ($items[1] as $i => $row) 
                {
                    $newline = $newline ."<li><a href=\"#tag-". ++$i. "\"> $row </a></li>";
                }
            $newline = $newline ."
                </ol>
                </div>";
        }

        if (!empty($items[0])) 
        {
            foreach ($items[0] as $i => $row) 
            {
                $text = str_replace($row, '<a name="tag-' . ++$i . '"></a>' . $row, $text);
            } 
        }
        $text = $newline . $text;
        return $text;
    }
    function Ex16($text)
    {
        $text = preg_replace(array("/\sпух/is",'/\sрот/','/\sделать/','/\sехать/', '/\sоколо/', '/\sдля/'), array('###','###', '######', '#####', '#####', '###'), $text);
        return $text;
    }
    if($_GET["preset"] == "1")
    {
        $text = file_get_contents("https://ru.wikipedia.org/wiki/%D0%9A%D0%B8%D0%BD%D0%BE%D1%80%D0%B8%D0%BD%D1%85%D0%B8");
        $pos = strpos($text, '<span class="mw-headline" id="Примечания">Примечания</span>');
        $text = substr($text, 0, $pos);
    }
    if($_GET["preset"] == "2")
    {
        $text=file_get_contents("https://echo.msk.ru/programs/sorokina/2917870-echo/");
    }
    if($_GET["preset"] == "3")
    { 
        $text = file_get_contents("https://mishka-knizhka.ru/skazki-dlay-detey/zarubezhnye-skazochniki/skazki-alana-milna/vinni-puh-i-vse-vse-vse/#glava-pervaya-v-kotoroj-my-znakomimsya-s-vinni-puhom-i-neskolkimi-pchy");
    }

    if($_POST["form"]=='Отправить')
    {
        $text=($_POST['content']);
    }
    if($_POST["form"]=='Вариант 1')
    {
        $text=($_POST['content']);
        $text=Ex1($text);
    }
    if($_POST["form"]=='Вариант 7')
    {
        $text=($_POST['content']);
        $text=Ex7($text);
    }
    if($_POST["form"]=='Вариант 14')
    {
        $text=($_POST['content']);
        $text=Ex14($text);
    }
    if($_POST["form"]=='Вариант 16')
    {
        $text=($_POST['content']);
        $text=Ex16($text);
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
    
    <br>
    
    <div class="container-fluid">
        <form method="post">
          <label>Введите текст:</label>
          <textarea name='content' style="width:1280px; height:680px;"> <?php if(isset($_POST['content'])) echo $_POST['content'] ?></textarea>
            <br>
            <input type='submit' name="form" value='Отправить'/>
            <input type='submit' name="form" value='Вариант 1'/>
            <input type='submit' name="form" value='Вариант 7'/>
            <input type='submit' name="form" value='Вариант 14'/>
            <input type='submit' name="form" value='Вариант 16'/>
        </form>
        <?php echo $text; ?>
    </div>
    
    
    <?php include "footer.php"; ?>
    
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
