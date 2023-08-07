<?php
class NewsController{
    /**
     * @return Responce
     */
    public function list():Responce{
        return new Responce("LIST","TEXT");
    }

    /**
     * @return Responce
     */
    public function add():Responce{
        return new Responce("ADD","TEXT");
    }

    /**
     * @return Responce
     */
    public function index():Responce{
        return new Responce("INDEX","TEXT");
    }
}