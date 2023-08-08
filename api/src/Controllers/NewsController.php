<?php

namespace App\Controllers;
use App\Core\Attributes\Route;
use App\Core\Responce;

class NewsController
{
    /**
     * @return Responce
     */
    public function list(): Responce
    {
        return new Responce("LIST", "TEXT");
    }

    #[Route("addition")]
    /**
     * @return Responce
     */
    public function add(): Responce
    {
        return new Responce("ADD", "TEXT");
    }

    #[Route("home")]
    /**
     * @return Responce
     */
    public function index(): Responce
    {
        return new Responce("INDEX", "TEXT");
    }
}