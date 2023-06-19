<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/editTable.css">
    <title>Edit Table</title>
</head>
<body>
    <?php
        require_once '../model/_dbcon.php';
        if (!empty($_POST['name']) && !empty($_POST['age']) && !empty($_POST['weight']) && !empty($_POST['height']) && !empty($_POST['school'])) {
            // Obțineți datele din formular
            $name = mysqli_real_escape_string($connect, $_POST['name']);
            $age = mysqli_real_escape_string($connect, $_POST['age']);
            $weight = mysqli_real_escape_string($connect, $_POST['weight']);
            $height = mysqli_real_escape_string($connect, $_POST['height']);
            $school = mysqli_real_escape_string($connect, $_POST['school']);
            $cookieId = $_GET['id'];

            $sql = "UPDATE copil SET NumeCopil='$name', VarstaCopil='$age', GreutateCopil='$weight', InaltimeCopil='$height', ScoalaCopil='$school' WHERE id=$cookieId";
            $result = mysqli_query($connect, $sql);
            if ($result) {
                header("Location: ../view/babypage_view.php?id=$cookieId");
                exit();
            } else {
                echo "Error: " . $sql . "<br>" . mysqli_error($connect);
            }

            $sql2 = "SELECT * FROM copil WHERE id=$cookieId";
            $result2 = mysqli_query($connect, $sql2);
            if ($result2) {
                $row = mysqli_fetch_array($result2);
            } else {
                $row = array();
            }
            
        }
        ?>
    <form method="POST">
        <label for="name">name:</label><br>
        <input type="text" id="name" name="name"><br><br>
        <label for="age">age:</label><br>
        <input type="text" id="age" name="age"><br><br>
        <label for="weight">weight:</label><br>
        <input type="text" id="weight" name="weight"><br><br>
        <label for="height">height:</label><br>
        <input type="text" id="height" name="height"><br><br>
        <label for="school">school:</label><br>
        <input type="text" id="school" name="school"><br><br>
        <input type="submit" value="Add">
    </form>
    <div class="returnbtn">
        <?php
            echo'<form action="../view/babypage_view.php?id='.$_GET['id'].'" method="POST" class="retrun">' 
        ?>
                <button class="btn-return">Return</button>
            </form>
    </div>
</body>
</html>
