<?php
    ob_start();
?>
<?php  
        session_start();
        include('../../connection.php');  
        $email = $_POST['email'];  
        $password = $_POST['password1'];  
      
        //to prevent from mysqli injection  
        $email = stripcslashes($email);  
        $password = stripcslashes($password);  
        $email = mysqli_real_escape_string($conn, $email);  
        $password = mysqli_real_escape_string($conn, $password);  
        $pass = md5($password);
        $user_check_query = "SELECT * FROM users WHERE email = '$email' and pass = '$pass'";  
        $results = mysqli_query($conn, $user_check_query);  
        $row = mysqli_fetch_array($results, MYSQLI_ASSOC);
        $count = mysqli_num_rows($results);
        
        if($count == 1){  
            if($row['type']==1){
                unset($_SESSION["id"]);
                unset($_SESSION["username"]);
                unset($_SESSION["error"]);
                unset($_SESSION["type"]);
                unset($_SESSION['LAST_ACTIVITY']);
                session_destroy();
                
                session_start();
                
                $_SESSION['LAST_ACTIVITY'] = time();
                $_SESSION["username"] = $row["uname"];
                $_SESSION['type'] = $row['type'];
                $_SESSION["success"] = "You have succesfully Loggedin";
                echo $row['type'];
                header('location: ../html/Admin.php');
                ob_flush();
            }
            else{
                unset($_SESSION["id"]);
                unset($_SESSION["username"]);
                unset($_SESSION["error"]);
                unset($_SESSION["type"]);
                session_destroy();
                
                session_start();
                
                $_SESSION["username"] = $row["uname"];
                $_SESSION['type'] = $row['type'];
                $_SESSION["success"] = "You have succesfully Loggedin";
                $_SESSION['LAST_ACTIVITY'] = time();
                header('location: ../html/home.php');
                ob_flush();
            }
        }
        else{  
            $_SESSION['error']=" Login failed. Invalid Email or Password.";
            header("Location: ../index.php");
            ob_flush();
        }     
?>  