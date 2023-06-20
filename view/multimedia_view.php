<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/multimedia.css">
    <title>calendarSomn</title>
</head>
<body>
    <?php
        require '../controller/_check_auth.php';
        require '../controller/_get_user_profile.php';
        if(!isset($_COOKIE['cookieUserName'])){
            header("Location: login_view.php");
        } else {
            $userName = $_COOKIE['cookieUserName'];
            $childId = $_GET['id'];
            require '../model/_dbcon.php';
            $sql = "SELECT * FROM copil WHERE Id='$childId'";
            $result = mysqli_query($connect, $sql);
            $row = mysqli_fetch_array($result);
            $childName = $row['NumeCopil'];  
        }
    ?>
<div class="page">

        <div class="babypage">
            <h2>Calendar Multimedia <?php echo $childName ?></h2>
        </div>

        <?php
            require '../model/_dbcon.php';
            $sql = "SELECT * FROM multimedia WHERE IdCopil='$childId'";
            $result = mysqli_query($connect, $sql);

            while ($row = mysqli_fetch_array($result)) {
                echo '<div class="container">';
                echo '<div class="child"> ';

                $extensie = strtolower(pathinfo($row['media_path'], PATHINFO_EXTENSION));
                if ($extensie == 'mp4') {
                    echo '<video controls>';
                    echo '<source src="'.$row['media_path'].'" type="video/mp4">';
                    echo 'Your browser does not support the video tag.';
                    echo '</video>';
                } else {
                    echo '<img src="'.$row['media_path'].'" alt="calendar" class="img">';
                }

                echo '<form method="POST" class="share-delete">';
                echo '<input type="hidden" name="postid" value="'.$row['Id'].'">';
                echo '<button class="btn-share", name="btn-share">Share</button>';
                echo '<button class="btn-delete", name="btn-delete">Delete</button>';
                echo '</form>';
                echo '</div>';
                echo '</div>';
                
            }

            if (isset($_POST['postid'])) {
                $idPoza = $_POST['postid'];  
            }
            if(isset($_POST['btn-delete'])) {
                $sql = "DELETE FROM multimedia WHERE Id='$idPoza'";
                $result = mysqli_query($connect, $sql);
                header("refresh:0; url=./multimedia_view.php?id=$childId");
                exit();
            }
            if(isset($_POST['btn-share'])) {
                setcookie('cookieMediaId', $idPoza, time() + (86400 * 30),'/');
                header("refresh:0; url=../controller/share.php?id=$childId");
                exit();
            }
            if(isset($_POST['btn-return'])) {
                header("refresh:0; url=./babypage_view.php?id=$childId");
                exit();
            }
            if(isset($_POST['btn-add'])) {
                header("refresh:0; url=../controller/addmedia.php?id=$childId");
                exit();
            }
        ?>
        

        <form method="POST" class="button">
            <button class="btn-return" name="btn-return" >Return</button>
            <button class="btn-add" name="btn-add">Add media</button>
        </form>
</body>
</html>