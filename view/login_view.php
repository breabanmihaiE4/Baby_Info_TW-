<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/login.css">
    <title>Login</title>
</head>
<body>
    <div class="loginForm" ng-app="login_app" ng-controller="login_controller" >
        <form method="POST">
            <input type="text" ng-model="username_input" placeholder="Enter Username" name="username"><br>
            <input type="password" ng-model="password_input" placeholder="Enter Password" name="password"><br>
            <a href="Register_view.php">Create an account</a>
            <button type="submit" name="register">Login</button>
        </form>
    </div>

    <?php
        
        if(isset($_POST['register'])){
            require '../model/_dbcon.php';
            $username = $_POST['username'];
            $password = $_POST['password'];

            $sql="select Password from user_details where UserName='$username'";
            $sqlres=mysqli_query($connect, $sql);
            $rowcount=mysqli_num_rows($sqlres);
            $password_hash = mysqli_fetch_assoc($sqlres);
            
            if($rowcount>0){
                if(password_verify($password, $password_hash['Password'])){
                    setcookie("cookieUserName",$_POST['username'], time() + (86400 * 30),'/');
                    header("Location: home_view.php");
                } else {
                    echo "<script>alert('Invalid credentials!');</script>";
                }
                
            } else {
                echo "<script>alert('Invalid credentials!');</script>";
            }
            
        }
    ?>

</body>
</html>