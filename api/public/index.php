<?php
require_once ('../config/config.php');
global $CoreParams;
spl_autoload_register(function ($classname){
    $path="../src/{$classname}.php";
    if(file_exists($path)){
        require_once($path);
    }

});
$database=new Database($CoreParams['Database']['Host'], $CoreParams['Database']['Username'], $CoreParams['Database']['Password'], $CoreParams['Database']['Database']);
$database->connect();


$query=new QueryBuilder();
$query->select()->from("news")->join("inner","posts")->on("posts.Id","news.postId");
//$rows=$database->execute($query);
echo $query->getSql();
echo "<br>intsert query<br>";
$query2=new QueryBuilder();
$date=date("Y-m-d H:i:s");
$query2->insert("news",['title','text','date'])->Values(["MyTITLE","MyText",$date]);
//$rows=$database->execute($query2);
echo $query2->getSql()."<br>";
$query3=new QueryBuilder();
$query3->update('news')->set(['title'=>'MyTitle','text'=>'MyText'])->where(['id'=>3]);
//$rows=$database->execute($query2);
echo $query3->getSql()."<br>";


$front_controller=new FrontController();
$front_controller->run();
