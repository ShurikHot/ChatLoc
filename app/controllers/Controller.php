<?php

namespace controllers;

use models\ProfileModel;

class Controller
{
    public function __construct()
    {
        session_start();
    }
}