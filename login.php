
<?php
    session_start();
    require("config.php");

    mysqli_select_db($conn , 'newdb');

    if(isset($_POST["submit"])){

        // take email and password which is enter by the user in the form...
        
        $email    =  trim($_POST['email']);
        $password = trim($_POST['password']);
        

        //take email so that check if this email already exixt in the table
        $emailquery = " select * from  gymData where email = '$email' ";
        $query = mysqli_query($conn, $emailquery);

        $emailcount = mysqli_num_rows($query);

        if($emailcount){
            $email_pass = mysqli_fetch_assoc($query);

            $db_pass = $email_pass['password'];
            $_SESSION['username'] = $email_pass['username'];

            $pass_decode = password_verify($password , $db_pass);    //verify is db_password and password are equal or not....

            if($pass_decode){
              echo 'Login successful';
              header('location:welcome.php');    //if password is matched then redirect to home page..
            }
            else{
              echo 'password incorrect';       //else pass is incorrect..
            }
        }
        else{
          echo 'Invalid Email';       //else email is incorrect .. 
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
  <form class="form" method="post" name="login">
        <h1 class="login-title">Login</h1>
        <input type="email" class="login-input" name="email" placeholder="Email" autofocus="true"/>
        <input type="password" class="login-input" name="password" placeholder="Password"/>
        <input type="submit" value="Login" name="submit" class="login-button"/>
        <p class="link"><a href="register.php">New Registration</a></p>
  </form>
</body>
</html>