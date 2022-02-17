<?php
    ob_start();
?>
<?php

    session_start();
    
    if((!isset($_SESSION['username'])) or $_SESSION['type']!=0){
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
    
    $upc = mysqli_real_escape_string($conn,$_POST["delete"]);
    $username = $_SESSION['username'];
    
    if($upc===0){
        $_SESSION['error']="Enter Valid UPC";
        header("Location: ../html/Product.php");
        ob_flush();
    }
    
    else{
    
        $check_user_query = "SELECT * FROM products WHERE upcid = '$upc' AND addedBy='$username'";
        
        $result = mysqli_query($conn,$check_user_query);
        $user = mysqli_fetch_assoc($result);
        $row = mysqli_num_rows($result);
        
        if($row == 0){
             $_SESSION['error']="Product Not exists";
             header("Location: ../html/Product.php");
             ob_flush();
        }
        else{
            $path = $user['image'];
            
            if(unlink($path)){
                $update = "DELETE FROM products WHERE upcid = '$upc' AND addedBy='$username'";
                $result = mysqli_query($conn,$update);
                
                if(!($result)){
                    $_SESSION['error']="Couldn't Remove Product";
                    header("Location: ../html/Product.php");
                    ob_flush();
                }
                else{
                    $_SESSION['error']="Succesfully Removed Product";
                    header("Location: ../html/Product.php");
                    ob_flush();
                }
                
            }
            else{
                if(!($result)){
                    $_SESSION['error']="Couldn't Remove Product";
                    header("Location: ../html/Product.php");
                    ob_flush();
                }
            }
        }
    }

?>