<?php
require_once 'db.php';
?>

<br>
<h4>
    <b>My Contacts</b>
</h4>
<ul class="list-group" style="list-style-type: none;">
    <div style="border: #0a0e14 solid 1px; width: 500px; margin: auto">
            <?php
                $user_id = $_SESSION['user']['id'];
                $query = mysqli_query($connect,"SELECT `contact_id` FROM `contacts` WHERE `user_id` = $user_id");
                while($user = mysqli_fetch_assoc($query)) {
                    $contact_id = $user['contact_id'];
                    $query_mess = mysqli_query($connect,"SELECT `id` FROM `personal_messages` WHERE `from_id` = $contact_id AND `to_id` = $user_id AND `unread` = 1");
                    $count_unread = mysqli_num_rows($query_mess) > 0 ? "<span class='badge rounded-pill text-bg-success'>" . mysqli_num_rows($query_mess) . " </span>" : '';
                    $query2 = mysqli_query($connect,"SELECT `last_visit`, `nickname` FROM `members` WHERE `id` = $contact_id");
                    if (mysqli_num_rows($query2) > 0) {
                        $contact = mysqli_fetch_assoc($query2);
                        $contact['last_visit'] >= (date('Y-m-d H:i:s', strtotime(date('Y-m-d H:i:s') . ' -5 minutes'))) ? $status = 'ONLINE' : $status = 'offline';
                        echo ("<a href='vendor/contactprofile.php?id=" . $contact_id . "'> 
                                <li class='justify-content-between align-items-center'>" . $contact['nickname'] .
                                "</a> " .
                                $count_unread .
                                " <span class='badge bg-primary rounded-pill'>" . $status . "</span>
                                </li>"
                        );
                    }
                }
            ?>
    </div>
</ul>