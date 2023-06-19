<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/dashboard.css">
    <title>Dashboard</title>
</head>
<body>

    <?php
       require '../controller/_check_auth.php';
       require '../controller/_get_user_profile.php';
    ?> 

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
                    <li><a class="here" href="dashboard_view.php">Dashboard</a></li>
                    <li><a href="profile_view.php">Profile</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="page">

        <div class="dashboardpage">
            <h2>Dashboard</h2>
        </div>
        
        <?php
            require '../model/_dbcon.php';
            $sql="select * from copil where NumeUtilizator='$userName'";
            $result = mysqli_query($connect, $sql);
            while($row = mysqli_fetch_array($result)){
                echo '<div class="container">';
                    echo '<div class="copil">';
                        echo '<div><h2 class="nume">'.$row['NumeCopil'].'</h2></div>';
                        echo '<div class="imagine">';
                        echo '<img src="'.$row['PathPhoto'].'" class="childprofilepic" alt="Profile pic child">';
                        echo '</div>';
                        echo '<div class="tabel">';
                            echo '<table>';
                            echo '<thead>';
                            echo '<tr>';
                                echo '<th class="heads">Vârsta</th>';
                                echo '<th class="heads">Greutate</th>';
                                echo '<th class="heads">Înălțime</th>';
                                echo '<th class="heads">Școală</th>';
                            echo '</tr>';
                            echo '</thead>';
                            echo '<tbody>';
                            echo '<tr>';
                                echo '<td class="inserts">'.$row['VarstaCopil'].'</td>';
                                echo '<td class="inserts">'.$row['GreutateCopil'].'</td>';
                                echo '<td class="inserts">'.$row['InaltimeCopil'].' cm</td>';
                                echo '<td class="inserts">'.$row['ScoalaCopil'].'</td>';
                            echo '</tr>';
                            echo '</tbody>';
                            echo '</table>';
                        echo '</div>';
                        echo '<div class="edit">';
                            echo '<form method="POST" class="button" action="babypage_view.php?id='.$row['Id'].'">';
                                echo '<button type="submit"><p>Edit</p></button>';
                            echo '</form>';
                        echo '</div>';
                        echo '<div class="delete">';
                            echo '<form method="POST" class="button">';
                                echo '<button name="delete"><p>Delete</p></button>';
                                echo '<input type="hidden" name="child_id" value="'.$row['Id'].'">';
                            echo '</form>';
                        echo '</div>';
                    echo '</div>';
                echo '</div>';
            }
        ?>

        <div class="add">
            <button data-open-modal>Add Child</button>

            <dialog data-modal>
                <form id="childForm" action="../controller/save_child.php" method="POST">
                    <input type="text" name="name" placeholder="Name">
                    <br>
                    <input type="text" name="age" placeholder="Age">
                    <br>
                    <input type="text" name="weight" placeholder="Weight(kg)">
                    <br>
                    <input type="text" name="height" placeholder="Height(cm)">
                    <br>
                    <input type="text" name="school" placeholder="School">
                    <br>
                    <button type="button" formmethod="dialog">Cancel</button>
                    <button type="submit" id="submitButton">Submit</button>
                </form>
            </dialog>

            <script>
                const openButton = document.querySelector("[data-open-modal]");
                const closeButton = document.querySelector("[formmethod='dialog']");
                const submitButton = document.querySelector("#submitButton");
                const modal = document.querySelector("[data-modal]");
                const childForm = document.querySelector("#childForm");

                openButton.addEventListener("click", () => {
                    modal.showModal();
                });

                closeButton.addEventListener("click", () => {
                    modal.close();
                });

                submitButton.addEventListener("click", () => {
                    childForm.submit();
                });
            </script>
        </div>

    </div>

    <?php
        if(isset($_POST['edit'])) {
            $childId = $_POST['child_id'];
            $url = 'babypage_view.php?id=' . $childId;
            header("Location: $url");
            exit();
        }

        if(isset($_POST['delete'])) {
            $childId = $_POST['child_id'];
            require '../model/_dbcon.php';
            $sql="DELETE FROM copil WHERE Id='$childId'";
            $result = mysqli_query($connect, $sql);
            $sql="DELETE FROM somn WHERE idCopil='$childId'";
            $result = mysqli_query($connect, $sql);
            $sql="DELETE FROM hrana WHERE idCopil='$childId'";
            $result = mysqli_query($connect, $sql);
            header("refresh:0");
            exit();
        }
    ?>
</body>
</html>
