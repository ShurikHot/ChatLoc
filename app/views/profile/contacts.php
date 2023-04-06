
<h4>
    <b><?= $_SESSION['user']['lang_text']['my_contacts'] ?></b>
</h4>

<ul class="list-group" style="list-style-type: none;">
    <div id="contacts" style="border: #0a0e14 solid 1px; width: 500px; margin: auto">
        <?php
            foreach ($contacts as $type => $users) {
                if ($type == "contact_arr" && $users != "") {
                    foreach ($users as $key => $value) {
                        echo("<a href='/contact/profile?id=" . $key . "'>
                                    <li class='justify-content-between align-items-center'>" . $value['nickname'] .
                            "</a> " .
                            $value['count_unread'] .
                            " <span class='badge bg-primary rounded-pill'>" . $value['status'] . "</span>
                                    </li>"
                        );
                    }
                } elseif ($type == "contact_appr_arr" && $users != "") {
                    foreach ($users as $key => $value) {
                        echo("<a href='/contact/profile?id=" . $key . "'>
                                        <li class='justify-content-between align-items-center'>" . $value['nickname'] .
                            "</a><span class='badge bg-danger rounded-pill'> ?</span> " . $_SESSION['user']['lang_text']['added_you'] . " 
                                        </li>"
                        );
                    }
                }
            }
        ?>
    </div>
</ul>