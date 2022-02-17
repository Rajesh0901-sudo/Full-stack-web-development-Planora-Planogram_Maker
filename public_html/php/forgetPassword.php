<?php
    ob_start();
?>
<?php
    session_start();
    include ('../../connection.php');
    function generateNumericOTP($n) {
      
            // Take a generator string which consist of
            // all numeric digits
            $generator = "1357902468";
          
            // Iterate for n-times and pick a single character
            // from generator and append it to $result
              
            // Login for generating a random character from generator
            //     ---generate a random number
            //     ---take modulus of same with length of generator (say i)
            //     ---append the character at place (i) from generator to result
          
            $result = "";
          
            for ($i = 1; $i <= $n; $i++) {
                $result .= substr($generator, (rand()%(strlen($generator))), 1);
            }
          
            // Return result
            return $result;
        }
    
    //initializing variable
    
    $errors = array();
    
    $email = mysqli_real_escape_string($conn,$_POST["email"]);
    
    if($email==''){
        $_SESSION['error']="email cant be empty";
            header("location: ../index.php");
            ob_flush();
    }
    
    else{
        
    
        //Email validation
        
        $check_user_query = "SELECT * FROM users WHERE email = '$email' LIMIT 1";
        
        $result = mysqli_query($conn,$check_user_query);
        $user = mysqli_fetch_array($result, MYSQLI_ASSOC);
        
        if(!($user)){
            $_SESSION['error']="User Not Found";
            header("location: ../index.php");
            ob_flush();
    
        }
        else if($user['type']==1){
            $_SESSION['error']="Admin's Password Cant be Changed Contact Developer";
            header("location: ../index.php");
            ob_flush();
        }
            
        else{
            
            $_SESSION['username'] = $user['uname'];
            $_SESSION['email'] = $user['email'];
            // Function to generate OTP
            
            $ran = generateNumericOTP(6);
            $to = $user['email'];
            $subject = "Planogram Maker OTP Verification";
            $txt = "".$user["uname"]." Your otp is - ".$ran;
            
            $result = mail($to,$subject,$txt);
            if(!($result)){
                $_SESSION['error']="Mail Couldn'be Sent";
                header("location: ../index.php");
                ob_flush();
            }
            else{
                $otp = md5($ran);
                $query = "UPDATE users SET OTP='$otp' WHERE email='$email' LIMIT 1";
                $results = mysqli_query($conn,$query);
                
                if(!($results)){
                    $_SESSION['error']="OTP Couldn'be Stored";
                    header("location: ../index.php");
                    ob_flush();
                }
                else{
                     $_SESSION['status']= 1;
                unset($_SESSION['error']);
                header('Location: ../html/Reset.php');
                ob_flush();
                }
                
            }
            
        }
        
    }
    ob_flush();
 ?>