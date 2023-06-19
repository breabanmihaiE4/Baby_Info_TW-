<?php
if (!isset($_COOKIE['cookieUserName'])) {
    header("Location: ../view/login_view.php");
    exit();
}
?>
