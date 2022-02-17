<?php
    ob_start();
?>
<?php
    session_start();
    include ('../../connection.php');
    
    //initializing variable
    
    
    $username = mysqli_real_escape_string($conn,$_POST["userName"]);
    $email = mysqli_real_escape_string($conn,$_POST["email"]);
    $password_1 = mysqli_real_escape_string($conn,$_POST["password"]);
    $password_2 = mysqli_real_escape_string($conn,$_POST["confirmPassword"]);
    
    //Form validation
    if($username===0 || $password_1===0 || $password_2===0|| $username=='' || $password_1=='' || $password_2=='' ){
        $_SESSION['error']="Enter valid Name/Email/Password";
        header("Location: ../index.php");
        ob_flush();
    }
    else{
    
        if($password_1 != $password_2){
            $_SESSION['error']="Passwords didn't matched";
            header("Location: ../index.php");
            ob_flush();
        }
        //check database for existing user 
        
        $check_user_query = "SELECT * FROM users WHERE email = '$email'";
        
        $result = mysqli_query($conn,$check_user_query);
        $user = mysqli_fetch_assoc($result);
        $row = mysqli_num_rows($result);
        
        if($row > 0){
             $_SESSION['error']="Email already exists";
             header("Location: ../index.php");
             ob_flush();
        }
        else{
        //register user if no error
        
            $password = md5($password_1);
            $query = "INSERT INTO users(uname,email,pass,OTP) VALUES ('$username','$email','$password',0)";
            $result = mysqli_query($conn, $query);
            if ( false==$result ) {
              $_SESSION['error' ]= mysqli_error($conn);
              header("Location: ../index.php");
              ob_flush();
            }
            else {
                    unset($_SESSION["id"]);
                    unset($_SESSION["username"]);
                    unset($_SESSION["error"]);
                    unset($_SESSION["type"]);
                    session_destroy();
                    
                    session_start();
                    
                    $_SESSION["username"] = $username;
                    $_SESSION['type'] = 0;
                    $_SESSION["success"] = "You have succesfully Loggedin";
                    $_SESSION['LAST_ACTIVITY'] = time();
                    header('location: ../html/home.php');
                    ob_flush();
                
            }
        }
    }

?>