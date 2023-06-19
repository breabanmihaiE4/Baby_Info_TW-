<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/upload.css">
    <title>Upload photo</title>
    
</head>
<body>
    <form id="uploadForm" method="POST" enctype="multipart/form-data">
            <input type="file" id="img" name="img" accept="image/*,video/*">
            <input type="submit" value="Upload" name="incarcare">
    </form>
    <div class="returnbtn">
        <?php
            echo'<form action="../view/babypage_view.php?id='.$_GET['id'].'" method="POST" class="retrun">' 
        ?>
                <button class="btn-return">Return</button>
            </form>
    </div>

<?php
        require_once '../model/_dbcon.php';
        $childId = $_GET['id'];
        if(isset($_POST['incarcare'])){
            // Verifică dacă există un fișier încărcat
            if(isset($_FILES['img']) && $_FILES['img']['error'] === UPLOAD_ERR_OK) {
                $tempFile = $_FILES['img']['tmp_name'];

                // Specifică calea completă a fișierului în care dorești să salvezi fișierul
                $targetPath = '../images/';

                // Obține numele fișierului încărcat
                $fileName = $_FILES['img']['name'];

                // Construiește calea completă a fișierului de destinație
                $targetFile = $targetPath . $fileName;
                $photoPath = '../images/' . $fileName;
                // Mută fișierul încărcat la locația de destinație
                move_uploaded_file($tempFile, $targetFile);
                $sql = "UPDATE `copil` SET `PathPhoto` = '$photoPath' WHERE `Id` = '$childId'";
                $result = mysqli_query($connect, $sql);
                if($result){
                    echo "<script>alert('Photo uploaded!');</script>" . $targetFile;
                    mysqli_close($connect);
                    header("Location: ../view/babypage_view.php?id=$childId","refresh:0"); 
                    exit();
                } else {
                    echo "Error upload!";
                }
            }
            else{
                echo "<script>alert('Error upload!');</script>";
            }
        }
    ?>
</body>
</html>
