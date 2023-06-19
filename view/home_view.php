<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/home.css">
    <title>Home</title>
</head>
<body>

    <?php
        require '../controller/_check_auth.php';
        require '../controller/_get_user_profile.php';
    ?>

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
                    <li><a class="here" href="home_view.php">Home</a></li>
                    <li><a href="feed_view.php">Feed</a></li>
                    <li><a href="dashboard_view.php">Dashboard</a></li>
                    <li><a href="profile_view.php">Profile</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="home">
        <div class="bain">
            <h1>Baby Info Manager</h1>
        </div>
        <div class="info">
            <h3>Acest site web a fost creat de care echipa noastra pentru a face mai usoara gestionarea copiilor in cadrul unei familii numeroase sau pentru a ajuta mamicele in cresterea mai usoara a primului copil.</h3>
        </div>
        <div class="scop">
            <h4>Scopul acestui site este de a facilita cresterea copiilor din cadrul unei familii, avand la dispozitie sfaturi, orare de somn, programe alimentare, postari legate de evolutia unor copii, folosite de alti utilizatori.</h3>
        </div>
            <div class="buton">
                <form action="Documentatie.html" method="GET" class="buton">
                    <button type="submit">Documentatie</button>
                </form>
            </div>
    </div>
    
</body>
</html>
