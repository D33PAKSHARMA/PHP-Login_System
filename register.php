
<?php
    session_start();
    require("config.php");

    mysqli_select_db($conn , 'newdb');

    if(isset($_POST["submit"])){

        // take all the values which is enter by the user in the form...
        $username = trim($_POST['username']);
        $email    =  trim($_POST['email']);
        $password = trim($_POST['password']);
        $cpassword = trim($_POST['cpassword']);

        // convert password into encrypted form
        $pass = password_hash($password,PASSWORD_BCRYPT);   
        

        //take email so that check if this email already exixt in the table
        $emailquery = " select * from  gymData where email = '$email' ";
        $query = mysqli_query($conn, $emailquery);

        $emailcount = mysqli_num_rows($query);

        if($emailcount>0){
            echo "
                <script type=\"text/javascript\">
                    alert('Email already exist');
                </script>
            ";
        }
        else{
            if(empty($password)){
                echo 'Please enter a password.';
            }
            elseif($password != $cpassword){  // if password is not equal
                echo "
                    <script type=\"text/javascript\">
                        alert('password is different';
                    </script>
                ";
            }
            else{
                $insert = "insert into gymData (username,email,password) values ('$username','$email','$pass')";
                $passquery = mysqli_query($conn , $insert);
                header("location:login.php");
            }
        }
    }

?>


<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="style.css">
    <title>PHP login system!</title>
  </head>
  <body>
  <form class="form" action="" method="post">
        <h1 class="login-title">Registration</h1>
        <input type="text" class="login-input" name="username" placeholder="Username" required />
        <input type="text" class="login-input" name="email" placeholder="Email Adress">
        <input type="password" class="login-input" name="password" placeholder="Password">
        <input type="password" class="login-input" name="cpassword" placeholder="Confirm Password">
        <input type="submit" name="submit" value="Register" class="login-button">
        <p class="link"><a href="login.php">Click to Login</a></p>
    </form>
  </body>
</html>