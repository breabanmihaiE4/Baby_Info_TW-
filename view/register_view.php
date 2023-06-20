<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/register.css">
    <title>Register</title>
</head>
<body>
    <div class="registerForm" ng-app="register_app" ng-controller="register_controller">
        <form method="POST">
            <input type="text" ng-model="username_input" placeholder="Enter Username" name="username"><br>
            <input type="email" ng-model="email_input" placeholder="Enter Your Email" name="email"><br>
            <input type="password" ng-model="password_input" placeholder="Enter Password" name="password"><br>
            <input type="password" ng-model="password_input" placeholder="Confirm Password" name="cpassword"><br>
            <a href="login_view.php">Already have an account?</a>
            <button type="submit" name="register">Create account</button>
        </form>

        <?php
            if(isset($_POST['register'])){
                require '../model/_dbcon.php';
                $username = $_POST['username'];
                $email = $_POST['email'];
                $password = $_POST['password'];
                $cpassword = $_POST['cpassword'];
                $password_hash = password_hash($password, PASSWORD_DEFAULT);

                $sql="select UserName from user_details where UserName='$username'";
                $sqlres=mysqli_query($connect, $sql);
                $rowcount=mysqli_num_rows($sqlres);
            
            if($username != "" && $email != "" && $password != ""){
                if($rowcount>0){
                    echo "<script>alert('Username already exists!');</script>";
                } else {
                    if($password==$cpassword){
                        $sql="insert into user_details(UserName, Email, Password) values('$username', '$email', '$password_hash')";
                        $sql2="insert into user_profile(UserName, PathPhoto) values('$username','../images/user_logo.png')";
                        $sqlres=mysqli_query($connect, $sql);
                        $sqlres2=mysqli_query($connect, $sql2);
                        if($sqlres && $sqlres2){
                            header("Location: login_view.php");
                        } else {
                            echo "<script>alert('Error creating account!');</script>";
                        }
                    } else {
                        echo "<script>alert('Passwords do not match!');</script>";
                    }
                }
            } else {
                echo "<script>alert('Please fill all the fields!');</script>";
            }
        }
        
        ?>        
    </div>
</body>
</html>