<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/profile.css">
    <title>Profile</title>
</head>
<body>

    <?php
        if(!isset($_COOKIE['cookieUserName'])){
            header("Location: login_view.php");
        } else {
            $userName = $_COOKIE['cookieUserName'];
            require '../model/_dbcon.php';
            $sql2="select PathPhoto from user_profile where UserName='$userName'";
            $result2 = mysqli_query($connect, $sql2);
            $row2 = mysqli_fetch_array($result2);
            if($row2!=NULL){
                $pathPhotoProfile = $row2['PathPhoto'];
            } else {
                $pathPhotoProfile = "./images/user_logo.png";
            }
        }   
        // Verificăm dacă formularul a fost trimis
        if(isset($_POST['save'])) {
            $phoneNumber = $_POST['phoneNumber'];
            $userDescription = $_POST['userDescription'];

            // Actualizăm valorile în baza de date
            $updateQuery = "UPDATE user_profile SET PhoneNumber='$phoneNumber', UserDescription='$userDescription' WHERE UserName='$userName'";
            mysqli_query($connect, $updateQuery);
        }
        
        $sql = "SELECT Email FROM user_details WHERE UserName='$userName'";
        $sqlres = mysqli_query($connect, $sql);
        $rowcount = mysqli_num_rows($sqlres);
        $email = mysqli_fetch_assoc($sqlres);
        if($rowcount > 0){
            $email = $email['Email'];
        } else {
            $email = "N/A";
        }

        $sql = "SELECT * FROM user_profile WHERE UserName='$userName'";
        $sqlres = mysqli_query($connect, $sql);
        $rowcount = mysqli_num_rows($sqlres);
        $row = mysqli_fetch_assoc($sqlres);
        if($rowcount > 0){
            $phoneNumber = $row['PhoneNumber'];
            $userDescription = $row['UserDescription'];
        }
        else{
            $phoneNumber = "N/A";
            $userDescription = "N/A";
        }
    ?>

    <div id="navbar">
        <nav>
            <div class="nav-container">
                <div class="nav-logo">
                    <img src="<?php echo $pathPhotoProfile; ?>" alt="User_Logo" class="profile-image">
                </div>
                <div class="nav-username">
                    <h1> <?php echo $userName; ?> </h1>
                </div>
                <div class="nav-menu">
                    <ul>
                        <li><a href="home_view.php">Home</a></li>
                        <li><a href="feed_view.php">Feed</a></li>
                        <li><a href="dashboard_view.php">Dashboard</a></li>
                        <li><a class="here" href="profile_view.php">Profile</a></li>
                    </ul>
                </div>
            </div>
        </nav>
    </div>
    
    <div class="page">
        <div class="profile">
            <h1>Profil</h1>
        </div>
            
        <div class="post">
            <div class="namebox">
                <input class="input-field" value="<?php echo $userName; ?>" disabled>
            </div>
            <div class="emailbox">
                <input class="input-field" value="<?php echo $email; ?>" disabled>
            </div>
            <div class="phonebox">
                <form method="POST" action="">
                    <input class="input-field" name="phoneNumber" value="<?php echo $phoneNumber; ?>">
            </div>
            <div class="descriptionbox">
                <textarea name="userDescription"><?php echo $userDescription; ?></textarea>
            </div>
            <div class="edit">
                <button type="submit" name="save"><p>Save</p></button>
                </form>
            </div>
            <div class="disconnect">
                <form class="button">
                    <button type="submit" name="disconnect"><p>Disconnect</p></button>
                </form>
            </div>
        </div>
        <div class="edit-photo">
                <form action="../controller/profilepic.php" method="POST" class="button">
                    <button class="photo" type="submit"><p>Editare Poza</p></button>
                </form>
        </div>
    </div>

    <?php
        if(isset($_GET['disconnect'])){
            setcookie('cookieUserName', '', time()- 3600, '/');
            setcookie('cookieChildId', '', time()- 3600, '/');
            setcookie('cookieMediaId', '', time()- 3600, '/');
            header("Location: login_view.php");
        }
    ?>
</body>
</html>
