<?php
$userName = $_COOKIE['cookieUserName'];
require '../model/_dbcon.php';
$sql2 = "select PathPhoto from user_profile where UserName='$userName'";
$result2 = mysqli_query($connect, $sql2);
$row2 = mysqli_fetch_array($result2);
if ($row2) {
    $pathPhotoProfile = $row2['PathPhoto'];
} else {
    $pathPhotoProfile = "../images/user.png";
}
?>
