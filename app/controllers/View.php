<?php


namespace app\controllers;


class View
{
    public function render($template, $data = [])
    {
        extract($data);
        require_once 'app/views/' . $template;

    }
}