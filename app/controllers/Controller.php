<?php


namespace app\controllers;


class Controller
{
    public function __construct()
    {
        //$params = require_once('../config/params.php');
        /*ini_set('session.gc_maxlifetime', 3600);
        ini_set('session.gc_probability', 1);
        ini_set('session.gc_divisor', 1);*/
        session_start();
    }
}