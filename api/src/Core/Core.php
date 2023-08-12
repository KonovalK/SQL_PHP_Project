<?php

namespace App\Core;

use App\Core\Database\Database;

final class Core
{
    /**
     * @var $database Database
     */
    private  $database;
    private FrontController $frontController;
    private static self $instance;
    private function __construct()
    {
    }
    public static function GetInstance():self{
        if(empty(self::$instance)){
            self::$instance=new self();
        }
        return self::$instance;
    }
    public function GetDatabase():Database{
        return $this->database;
    }
    public function Init():void{
        global $CoreParams;
        $this->database=new Database($CoreParams['Database']['Host'], $CoreParams['Database']['Username'], $CoreParams['Database']['Password'], $CoreParams['Database']['Database']);
        $this->frontController=new FrontController();
    }
    public function Run():void{
        $this->database->connect();
        $this->frontController->run();
    }
    public function Done():void{

    }

}