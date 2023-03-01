<?php
    $connect = mysqli_connect('localhost', 'root', 'root', 'chat_loc');
    if (!$connect) {
        die('Error connect to DataBase');
    }