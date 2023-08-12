<?php

use App\Core\Core;
use App\Core\Database\Database;
use App\Core\FrontController;

require_once ('../config/config.php');
global $CoreParams;
spl_autoload_register(function ($classname){
    $newClassName=str_replace('\\','/',$classname);
    if(stripos($newClassName,'App/')===0){
        $newClassName=substr($newClassName, 4);
    }
    $path="../src/{$newClassName}.php";
    if(file_exists($path)){
        require_once($path);
    }

});
$core=Core::GetInstance();
$core->Init();
$core->Run();
$core->Done();

//\App\Core\StaticCore::Init();
//\App\Core\StaticCore::Run();
//\App\Core\StaticCore::Done();

$record=new \App\Models\News();
$record->title="title";
$record->text="text";
$record->date="12:54";
$record->save();
//
//
//$query=new QueryBuilder();
//$query->select()->from("news")->join("inner","posts")->on("posts.Id","news.postId");
////$rows=$database->execute($query);
//echo $query->getSql();
//echo "<br>intsert query<br>";
//$query2=new QueryBuilder();
//$date=date("Y-m-d H:i:s");
//$query2->insert("news",['title','text','date'])->Values(["MyTITLE","MyText",$date]);
////$rows=$database->execute($query2);
//echo $query2->getSql()."<br>";
//$query3=new QueryBuilder();
//$query3->update('news')->set(['title'=>'MyTitle','text'=>'MyText'])->where(['id'=>3]);
////$rows=$database->execute($query2);
//echo $query3->getSql()."<br>";


//$front_controller=new FrontController();
//$front_controller->run();
//
//function getObject():?\App\Core\Responce
//{
//    //return null;
//    return new App\Core\Responce("title","<br>text");
//}
//$obj=getObject();
//echo $obj?->getText();

