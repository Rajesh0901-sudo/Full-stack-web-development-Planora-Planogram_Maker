<?php
    ob_start();
?>
<?php

    session_start();
    
    unset($_SESSION['LAST_ACTIVITY']);
    $_SESSION['LAST_ACTIVITY'] = time();
    
    if((!isset($_SESSION['username'])) or ($_SESSION['type']!=1)){
        $_SESSION['msg'] = "You Must Login Fisrt To View This Page";
        header("location:../php/logout.php");
        ob_flush();
    }
    
    if(time()-$_SESSION['LAST_ACTIVITY'] > 1200){
        $_SESSION['msg'] = "Session time out";
        header("location:../php/logout.php");
        ob_flush();
        
    }
    
    include ('../../connection.php');
    
    $email = mysqli_real_escape_string($conn,$_POST["email"]);
    $username =  mysqli_real_escape_string($conn,$_POST["Name"]);
    
    if($username===0 ){
        $_SESSION['error']="Enter Valid Details";
        header("Location: ../html/Admin.php");
        ob_flush();
    }
    
    else{
        
        $check_user_query = "SELECT * FROM users WHERE email = '$email' AND uname='$username'";
        
        $result = mysqli_query($conn,$check_user_query);
        $user = mysqli_fetch_assoc($result);
        $row = mysqli_num_rows($result);
        
        if($row == 0){
             $_SESSION['error']="User Not exists";
             header("Location: ../html/Admin.php");
             ob_flush();
        }
        else{
            $update = "DELETE FROM users WHERE email = '$email' AND uname='$username'";
            $result = mysqli_query($conn,$update);
            
            if(!($result)){
                $_SESSION['error']="Couldn't Remove User";
                header("Location: ../html/Admin.php");
                ob_flush();
            }
            else{
                $_SESSION['error']="Succesfully Removed User";
                header("Location: ../html/Admin.php");
                ob_flush();
            }
        }
    }

?>