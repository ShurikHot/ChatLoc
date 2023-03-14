<?php
require_once 'db.php';
?>

<br><br>
<h4>
    <b>My Contacts</b>
</h4>
<ul class="list-group">
    <div style="border: #0a0e14 solid 1px">
            <?php
                $user_id = $_SESSION['user']['id'];
                $query = mysqli_query($connect,"SELECT * FROM `contacts` WHERE `user_id` = $user_id");
                while($user = mysqli_fetch_assoc($query)) {
                    $contact_id = $user['contact_id'];
                    $query2 = mysqli_query($connect,"SELECT * FROM `members` WHERE `id` = $contact_id");
                    if (mysqli_num_rows($query2) > 0) {
                        $contact = mysqli_fetch_assoc($query2);
                        echo ("<a href='vendor/contactprofile.php?id=" . $contact_id . "'> 
                                <li class='justify-content-between align-items-center'>" . $contact['nickname'] .
                               "</a>&nbsp;
                                <span class='badge bg-primary rounded-pill'>online/offline</span>
                                </li>"

                        );
                    }
                }
            ?>
    </div>
</ul>








