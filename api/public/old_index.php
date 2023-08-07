<?php
date_default_timezone_set('Europe/Kiev');
$pdo = new PDO("mysql:host=172.22.75.8;dbname=cms","cms-user","123456");
if($_SERVER['REQUEST_METHOD']=='POST'){
    $text=$_POST['text'];
    $title=$_POST['title'];
    $date=date("Y-m-d H:i:s");
    $pdo->query("INSERT INTO news (title,text, date) VALUES ('{$title}','{$text}','{$date}')");
}
if(isset($_GET["page"])){
    $currentpage=$_GET["page"];
}
else{
    $currentpage=1;
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <form action="" method="post">
        <div>Title:</div>
        <div>
            <input type="text" name="title">
        </div>
        <div>Text:</div>
        <div>
            <textarea name="text">

            </textarea>
        </div>
        <button type="submit">Add</button>
    </form>
    <div>
        <h1>NEWS LIST</h1>
        <table>
        <?php
        $sth = $pdo->query("SELECT * FROM news");
        $query_count=5;
        $all_count=ceil($sth->rowCount());
        echo "<h1>{$all_count}</h1><br>";
        $page_count=$all_count/$query_count;
        $maxlength=$currentpage*5;
        $start=$currentpage*5-5;
        $sth_main = $pdo->query("SELECT * FROM news LIMIT {$start}, 5");
        while($row =$sth_main->fetch()): ?>
        <tr>
            <td><?=$row['id'] ?></td>
            <td><?=$row['title'] ?></td>
            <td><?=$row['text'] ?></td>
            <td><?=$row['date'] ?></td>
        </tr>
        <?php
        endwhile;
        ?>
        </table>
        <div>
            <?php for ($i=1; $i<=$page_count ; $i++) : ?>
            <a href="?page=<?=$i ?>"><?=$i; ?></a>
            <?php endfor; ?>
        </div>
    </div>
</body>
</html>
