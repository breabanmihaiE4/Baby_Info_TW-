<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/feed.css">
    <title>Feed</title>
</head>
<body>

    <?php
        require '../controller/_check_auth.php';
        require '../controller/_get_user_profile.php';
    ?>

    <div id="navbar">
        <nav>
            <div class="nav-container">
                <div class="nav-logo">
                    <img src=<?php echo "$pathPhotoProfile" ?> alt="User_Logo">
                </div>
                <div class="nav-username">
                    <h1> <?php echo $userName; ?> </h1>
                </div>
                <div class="nav-menu">
                    <ul>
                        <li><a href="home_view.php">Home</a></li>
                        <li><a class="here" href="feed_view.php">Feed</a></li>
                        <li><a href="dashboard_view.php">Dashboard</a></li>
                        <li><a href="profile_view.php">Profile</a></li>
                    </ul>
                </div>
            </div>
        </nav>
    </div>

    <div class="page">
        
        <div class="feedpage">
            <h1>Feed Page</h1>
        </div>
        
        <?php
            require '../model/_dbcon.php';
            $sql = "SELECT * FROM Feed";
            $result = mysqli_query($connect, $sql);
            while ($row = mysqli_fetch_array($result)) {
                echo '<div class="container">';
                echo '<div class="post">';
                echo '<div class="username-post"><p>' . $row['NumeUtilizator'] . '</p></div>';
                echo '<div class="mediashared"> ';
                $extensie = strtolower(pathinfo($row['PathPhoto'], PATHINFO_EXTENSION));
                if ($extensie == 'mp4') {
                    echo '<video controls>';
                    echo '<source src="' . $row['PathPhoto'] . '" type="video/mp4">';
                    echo 'Your browser does not support the video tag.';
                    echo '</video>';
                } else {
                    echo '<img src="' . $row['PathPhoto'] . '" alt="calendar" class="imag">';
                }
                echo '</div>';
                echo '<div class="description"><p>' . $row['Descriere'] . '</p></div>';
                echo '<div class="buttons form-container">';
                echo '</div>';
                echo '</div>';
                echo '<form method="POST"">';
                echo '<input type="hidden" name="postid" value="' . $row['Id'] . '">';
                echo '<button class="like-button" type="submit" name="like">Like</button>';
                if ($row['NumeUtilizator'] == $userName) {
                    echo '<p>' . $row['Likes'] . '</p>';
                } else {
                    echo '<p> - </p>';
                }
                echo '<button class="dislike-button" type="submit" name="dislike">Dislike</button>';
                if ($row['NumeUtilizator'] == $userName) {
                    echo '<p>' . $row['Dislikes'] . '</p>';
                } else {
                    echo '<p> - </p>';
                }
                if ($row['NumeUtilizator'] == $userName) {
                    echo '<button class="delete-button" type="submit" name="delete">Delete</button>';
                }
                echo '</form>';
                echo '</div>';
            }
            if (isset($_POST['postid'])) {
                $variabila = $_POST['postid'];
                if (isset($_POST['like'])) {
                    $sql = "UPDATE Feed SET Likes=Likes+1 WHERE Id='$variabila'";
                    $result = mysqli_query($connect, $sql);
                    header("Location: feed_view.php");
                    exit();
                }

                if (isset($_POST['dislike'])) {
                    $sql = "UPDATE Feed SET Dislikes=Dislikes+1 WHERE Id='$variabila'";
                    $result = mysqli_query($connect, $sql);
                    header("Location: feed_view.php");
                    exit();
                }
                if (isset($_POST['delete'])) {
                    $sql = "DELETE FROM Feed WHERE Id='$variabila'";
                    $result = mysqli_query($connect, $sql);
                    header("Location: feed_view.php");
                    exit();
                }
            }
        ?>

        <div class="add-post">
            <form action="Home.php" method="GET" class="add-post">
                <button type="submit">Add post</button>
            </form>
        </div>
    </div>
    
</body>
</html>
