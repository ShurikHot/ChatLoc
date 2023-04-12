<?php
$current_page = $data['current_page'];
$total_pages = $data['total_pages'];
$back = null;
$forward = null;
$startpage = null;
$endpage = null;
$page2left = null;
$page1left = null;
$page2right = null;
$page1right = null;

// $back
if ($current_page > 1) {
    $back = "<li class='page-item'><a class='page-link' href='/admin/content?" . $content . "=" . $current_page - 1 . "'>&lt;</a></li>";
}
// $forward
if ($current_page < $total_pages) {
    $forward = "<li class='page-item'><a class='page-link' href='/admin/content?" . $content . "=" . $current_page + 1 . "'>&gt;</a></li>";
}
// $startpage
if ($current_page > 3) {
    $startpage = "<li class='page-item'><a class='page-link' href='/admin/content?" . $content . "=" . "1" . "'>&laquo;</a></li>";
}
// $endpage
if ($current_page < ($total_pages - 2)) {
    $endpage = "<li class='page-item'><a class='page-link' href='/admin/content?" . $content . "=" . $total_pages . "'>&raquo;</a></li>";
}
// $page2left
if ($current_page - 2 > 0) {
    $page2left = "<li class='page-item'><a class='page-link' href='/admin/content?" . $content . "=" . $current_page - 2 . "'>" . $current_page - 2 . "</a></li>";
}
// $page1left
if ($current_page - 1 > 0) {
    $page1left = "<li class='page-item'><a class='page-link' href='/admin/content?" . $content . "=" . $current_page - 1 . "'>" . $current_page - 1 . "</a></li>";
}
// $page1right
if ($current_page + 1 <= $total_pages) {
    $page1right = "<li class='page-item'><a class='page-link' href='/admin/content?" . $content . "=" . $current_page + 1 . "'>" . $current_page + 1 . "</a></li>";
}
// $page2right
if ($current_page + 2 <= $total_pages) {
    $page2right = "<li class='page-item'><a class='page-link' href='/admin/content?" . $content . "=" . $current_page + 2 . "'>" . $current_page + 2 . "</a></li>";
}
if ($total_pages > 1) echo ('<nav aria-label="Page navigation"><ul class="pagination">' . $startpage . $back . $page2left . $page1left .
    '<li class="page-item active"><a class="page-link">' . $current_page . '</a></li>' . $page1right . $page2right . $forward . $endpage . '</ul></nav>');