<?php
    ob_start();
?>
<?php
    session_start();
    
    if(!isset($_SESSION['username'])){
        $_SESSION['msg'] = "You Must Login Fisrt To View This Page";
        header("location:../index.php");
        ob_flush();
    }
    
    if(time()-$_SESSION['LAST_ACTIVITY'] > 86400){
        $_SESSION['msg'] = "Session time out";
        header("location:../php/logout.php");
        
        ob_flush();
    }
    
    include ('../../connection.php');
    
    $password_1 = mysqli_real_escape_string($conn,$_POST["Newpassword"]);
    $password_2 = mysqli_real_escape_string($conn,$_POST["confirmPassword"]);
    $otp = mysqli_real_escape_string($conn,$_POST["OTP"]);
    $OTP = md5($otp);
    
    if($password_1===0 || $password_2===0 || $otp===0 || $password_1=='' || $password_2=='')
    {
        $_SESSION['error']="Enter Valid Password/OTP";
        header("Location: ../html/index.php");
        ob_flush();
    }
    else{
        if($password_1 != $password_2){
            $_SESSION['error']="Passwords didnt matched";
            header("Location: ../html/Reset.php");
            ob_flush();
        }
        else{
            
            //OTP VERIFICATION
            
            
            $check_user_query = "SELECT * FROM users WHERE OTP='$OTP' LIMIT 1";
            $result = mysqli_query($conn,$check_user_query);
            $user = mysqli_fetch_array($result, MYSQLI_ASSOC);
            $rowcount=mysqli_num_rows($result);
            
            if( $rowcount!=1){
                
                $_SESSION['error']="Data not Found";
                
                header("location: ../index.php");
                
                ob_flush();
                
            }
            else if($rowcount==1){
                $password = md5($password_1);
                $query = "UPDATE users SET pass='$password' WHERE OTP='$OTP' LIMIT 1";
                $result = mysqli_query($conn, $query);
                
                if ( false===$result ) {
                    
                    $_SESSION['error']="Password couldnt be updated";
                    header("location: ../index.php");
                    ob_flush();
                    
                }
                else {
        
                    unset($_SESSION['error']);
                    unset($_SESSION["id"]);
                    unset($_SESSION["username"]);
                    unset($_SESSION["error"]);
                    unset($_SESSION["type"]);
                    session_destroy();
                    
                    session_start();
                    
                    
                    $_SESSION['type'] = 0;
                    $_SESSION['username'] = $user['uname'];
                    $_SESSION['email'] = $user['email'];
                    $_SESSION["success"] = "You have succesfully Loggedin";
                    $_SESSION['LAST_ACTIVITY'] = time();
                    header('location: ../html/home.php');
                    ob_flush();
                }
            }
        }
    }
   ob_flush();
    
?>