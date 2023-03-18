<?php
require_once 'db.php';
require_once 'admin/params.php';

ini_set('session.gc_maxlifetime', $session_lifetime);
ini_set('session.gc_probability', 1);
ini_set('session.gc_divisor', 1);
session_start();

$user_id = $_SESSION['user']['id'];
$contact_id = $_POST['contact_id'];
$result = mysqli_query($connect, "SELECT COUNT(*) as total FROM `personal_messages` WHERE (`from_id` = $user_id AND `to_id` = $contact_id) 
                                        OR (`from_id` = $contact_id AND `to_id` = $user_id)");
$row = mysqli_fetch_assoc($result);
$total_records = $row['total'];
$total_records > 50 ? $start = $total_records - 50 : $start = 0;
$query = mysqli_query($connect,"SELECT * FROM `personal_messages` WHERE (`from_id` = $user_id AND `to_id` = $contact_id) 
                                      OR (`from_id` = $contact_id AND `to_id` = $user_id) LIMIT $start, $total_records");
if (mysqli_num_rows($query)>0) {
    while ($messagearr = mysqli_fetch_assoc($query)) {
        $mes_from_id = $messagearr['from_id'];
        $query_user = mysqli_query($connect, "SELECT * FROM `members` WHERE `id` = $mes_from_id");
        $name = mysqli_fetch_assoc($query_user);

        if (isset($name)) {
            echo("<div class='container'>
                      <div style='margin-right: 5px; text-align: left;'>
                           <p>" . $name['nickname'] . ": " . $messagearr['message'] . "                    
                           </p>
                      </div>
                   </div>");
        }
        $mess_id = $messagearr['id'];
        if ($user_id != $mes_from_id) {
            mysqli_query($connect, "UPDATE `personal_messages` SET `unread` = 0 WHERE `id` = $mess_id");
        }
    }
}