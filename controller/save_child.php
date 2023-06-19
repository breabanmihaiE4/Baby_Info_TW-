<?php
require '../model/_dbcon.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $userName = $_COOKIE['cookieUserName'];
    $name = $_POST["name"];
    $age = $_POST["age"];
    $weight = $_POST["weight"];
    $height = $_POST["height"];
    $school = $_POST["school"];
    $photoPath = "../images/nanimult.jpg";
    $sql = "INSERT INTO copil (NumeUtilizator, NumeCopil, PathPhoto, VarstaCopil, GreutateCopil, InaltimeCopil, ScoalaCopil) 
            VALUES ('$userName', '$name', '$photoPath', '$age', '$weight', '$height', '$school')";

    if (mysqli_query($connect, $sql)) {
        echo "<script>alert('Child added!');</script>";
    } else {
        echo "<script>alert('Error adding child!');</script>";
    }
    $sql = "select Id from copil where NumeUtilizator = '$userName' and NumeCopil = '$name'";
    $result = mysqli_query($connect, $sql);
    $row = mysqli_fetch_assoc($result);
    $copilId = intval($row['Id']);

    //create 4 rows for each child in table somn
    $sql = "INSERT INTO somn (idCopil) VALUES ('$copilId')";
    $result = mysqli_query($connect, $sql);
    $sql = "INSERT INTO somn (idCopil) VALUES ('$copilId')";
    $result = mysqli_query($connect, $sql);
    $sql = "INSERT INTO somn (idCopil) VALUES ('$copilId')";
    $result = mysqli_query($connect, $sql);
    $sql = "INSERT INTO somn (idCopil) VALUES ('$copilId')";
    $result = mysqli_query($connect, $sql);

    //create 4 rows for each child in table hrana
    $sql = "INSERT INTO hrana (idCopil) VALUES ('$copilId')";
    $result = mysqli_query($connect, $sql);
    $sql = "INSERT INTO hrana (idCopil) VALUES ('$copilId')";
    $result = mysqli_query($connect, $sql);
    $sql = "INSERT INTO hrana (idCopil) VALUES ('$copilId')";
    $result = mysqli_query($connect, $sql);
    $sql = "INSERT INTO hrana (idCopil) VALUES ('$copilId')";
    $result = mysqli_query($connect, $sql);
}
mysqli_close($connect);
header("refresh:0; url=../view/dashboard_view.php");
exit();
?> 
