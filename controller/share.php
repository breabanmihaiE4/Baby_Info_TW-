<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/share.css">
    <title>Edit Table</title>
</head>
<body>
    
    <?php
        $childId = $_GET['id'];
        $photoId = $_COOKIE['cookieMediaId'];
        $numeUtilizator = $_COOKIE['cookieUserName'];

        require '../model/_dbcon.php';
        $sql = "select media_path from multimedia where Id=$photoId";
        $result = mysqli_query($connect, $sql);
        $photoPath = mysqli_fetch_array($result);

        if(isset($_POST['btnShare'])) {
            $descriere = $_POST['name'];
            $sql = "INSERT INTO feed (NumeUtilizator, PathPhoto, Descriere,Likes,Dislikes) VALUES ('$numeUtilizator', '$photoPath[0]', '$descriere',0,0)";
            $result = mysqli_query($connect, $sql);
            if ($result) {
                header("Location: ../view/feed_view.php?id=$childId");
                exit();
            } else {
                echo "Error: " . $sql . "<br>" . mysqli_error($connect);
            }
        }
    ?>
    <form method="POST">
        <label for="name">Adaugati o descriere  :</label><br>
        <input type="text" id="name" name="name"><br><br>
        <div class="returnbtn">
            <form action="POST">
            <button class="btn-return" name="btnShare">Share</button>
            </form>
        </div>
</body>
</html>
