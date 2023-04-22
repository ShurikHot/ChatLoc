<?php

use models\ProfileModel;

function lastVisit($id) {
    if(!isset($id)) {
        header('Location: /');
    } else {
        $model = new ProfileModel();
        $last_visit_info = $model->getLastVisit($id);
        if (!empty($last_visit_info)) {
            $last_visit = mysqli_fetch_assoc($last_visit_info);
            $last_access_time = strtotime($last_visit['last_visit']);
            $current_time = time();
            if ($current_time - $last_access_time > 3600) {
                unset($_SESSION['user']);
                header('Location: /');
            }
        }
    }
}

function __($text) {
    echo $_SESSION['user']['lang_text'][$text];
}