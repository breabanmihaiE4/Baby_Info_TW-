<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/babypage.css">
    <title>BabyPage</title>
</head>
<body>

<?php
        if(!isset($_COOKIE['cookieUserName'])){
            header("Location: ../view/login_view.php");
        } else {
            $userName = $_COOKIE['cookieUserName'];
            $childId = $_GET['id'];
            setcookie('cookieChildId', $childId, time() + (86400 * 30),'/');
            require '../model/_dbcon.php';
            $sql="select * from copil where Id='$childId'";
            $result = mysqli_query($connect, $sql);
            $row = mysqli_fetch_array($result);
            $childName = $row['NumeCopil'];
            $childAge = $row['VarstaCopil'];
            $childWeight = $row['GreutateCopil'];
            $childHeight = $row['InaltimeCopil'];
            $childSchool = $row['ScoalaCopil'];
            $pathPhoto = $row['PathPhoto'];
            $sql2="select PathPhoto from user_profile where UserName='$userName'";
            $result2 = mysqli_query($connect, $sql2);
            $row2 = mysqli_fetch_array($result2);
            $pathPhotoProfile = $row2['PathPhoto'];
            
        }   
    ?>

<nav>
    <div class="nav-container">
            <div class="nav-logo">
                <img src="<?php echo $pathPhotoProfile; ?>" alt="User_Logo" class="profile-image">            
            </div>
            <div class="nav-username">
                <h1><?php echo $userName ?></h1>
            </div>
            <div class="nav-menu">
                <ul>
                    <li><a href="home_view.php">Home</a></li>
                    <li><a href="feed_view.php">Feed</a></li>
                    <li><a href="dashboard_view.php">Dashboard</a></li>
                    <li><a href="profile_view.php">Profile</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="page">
        <div class="babypage">
            <h2><?php echo $childName ?></h2>
        </div>

        <div class="child">
            <div>
                <img src=<?php echo "$pathPhoto"?> class="childprofilepic" alt="Profile pic child">
            </div>
            <div class="tabel">
                <table>
                    <thead>
                        <tr>
                            <th class="heads">Vârsta</th>
                            <th class="heads">Greutate</th>
                            <th class="heads">Înălțime</th>
                            <th class="heads">Școală</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="inserts"><?php echo $childAge ?> years </td>
                            <td class="inserts"><?php echo $childWeight ?> kg </td>
                            <td class="inserts"><?php echo $childHeight ?> m </td>
                            <td class="inserts"><?php echo $childSchool ?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="edit-photo">
                <?php 
                echo'<form action="../controller/upload.php?id='.$row['Id'].'" method="POST" class="button">' 
                ?>
                    <button type="submit"><p>Editare Poza</p></button>
                </form>
            </div>
            <div class="edit-table">
                <?php 
                echo'<form action="../controller/editTable.php?id='.$row['Id'].'" method="POST" class="button">' 
                ?>
                    <button type="submit"><p>Editare Tabel</p></button>
                </form>
            </div>
            <div class="food">
                <?php
                    echo'<form action="calendarHrana_view.php?id='.$row['Id'].'" method="POST" class="button">' 
                ?>
                    <button type="submit"><p>Calendar Hrana</p></button>
                </form>
            </div>
            <div class="sleep">
                <?php
                    echo'<form action="calendarSomn_view.php?id='.$row['Id'].'" method="POST" class="button">' 
                ?>
                    <button type="submit"><p>Calendar Somn</p></button>
                </form>
            </div>
            <div class="events">
                <?php 
                    echo'<form action="../view/events_view.php?id='.$row['Id'].'" method="POST" class="button">' 
                ?>
                    <button type="submit"><p>Evenimente</p></button>
                </form>
            </div>
            <div class="medical">
                <?php
                    echo'<form action="./medical_view.php?id='.$row['Id'].'" method="POST" class="button">' 
                ?>
                    <button type="submit"><p>Istoric Medical</p></button>
                </form>
            </div>
            <div class="media">
                <?php
                    echo'<form action="./multimedia_view.php?id='.$row['Id'].'" method="POST" class="button">' 
                ?>
                    <button type="submit"><p>Galerie MultiMedia</p></button>
                </form>
            </div>
            <div class="relatii">
                <?php
                    echo'<form action="./relatiiCopii_view.php?id='.$row['Id'].'" method="POST" class="button">' 
                ?>
                    <button type="submit"><p>Relatii Copii</p></button>
                </form>
            </div>
        </div>

</body>
</html>