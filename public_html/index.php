<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Planora- Planogram Maker Registration</title>
    <!-- Required meta tags always come first -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">

    <!-- Bootstrap CSS -->
    <!-- build:css css/main.css -->
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="css/Reg-style.css">
    <!-- endbuild -->
</head>

<body class="imgbox">
    <div class="d-none d-lg-block">
        <?php
            if(isset($_SESSION['error'])){
            echo 
                "<div><center><h3> 
                    
                    ".$_SESSION['error']."
                                
                <h3> </center></div>";
            }
            unset($_SESSION['error']);
        ?>
        <img class="backimg" src="../img/Planora1.png">
        <div class="container log-container">
            <div id="Registration-Form" class="form">
                <div class="btn">
                    <button class="signUpBtn">SIGN UP</button>
                    <button class="loginBtn">LOG IN</button>
                </div>
                <form class="signUp" action="php/Registration.php" method="post">
                    <div class="formGroup">
                        <input type="text" name="userName" placeholder="User Name" autocomplete="off">
                    </div>
                    <div class="formGroup">
                        <input type="email" placeholder="Email ID" name="email" required autocomplete="off">
                    </div>
                    <div class="formGroup">
                        <input type="password" id="password" name="password" placeholder="Password" required autocomplete="off">
                    </div>
                    <div class="formGroup">
                        <input type="password" id="confirm_password" name="confirmPassword" placeholder="Confirm Password" required autocomplete="off">
                    </div>
                    
                     <center><div style="margin-top: 7px;" id="CheckPasswordMatch"></div></center>
                    <div class="checkBox">
                        <input type="checkbox" name="checkbox" id="checkbox">
                        <span class="text">I agree with term & conditions</span>
                    </div>
                    <div class="formGroup">
                        <button type="submit" id="submit" name="registerUser" class="btn2">REGISTER</button>
                    </div>
            
                </form>
            
                <!------ Login Form -------- -->
                <form class="login" action="php/Authentication.php" method="post">
            
                    <div class="formGroup">
                        <input type="email" placeholder="Email ID" name="email" required autocomplete="off">
                    </div>
                    <div class="formGroup">
                        <input type="password" name="password1" placeholder="Password" required autocomplete="off">
            
                    </div>
                    <div class="checkBox">
                        <input type="checkbox" name="checkbox" id="checkbox">
                        <span class="text">Keep me signed in on this device</span>
                    </div>
                    <div class="formGroup">
                        <button type="submit"  name="login_user" class="btn2">Login</button>
                    </div>
                         <br>
                        <span class="Heading"><a href="html/Forget.php">Forget Password</a></span>
                    
            
                </form>
            
            </div>
        </div>



        

    </div>
    <div class="imgbox_small d-lg-none">
        <img class="backimg_small" src="../img/Planora1.png">
        <div class="small_text">
            <h2 class="anim">
                <center>For better experience</center>
            </h2>
            <h2 class="anim">
                <center>Open in a PC or Laptop</center>
            </h2>
        </div>
        
    </div>
    <!-- build:js js/main.js-->
    <!-- jQuery library -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"></script>
    <!-- Popper JS -->
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <!-- Latest compiled JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="js/Reg-script.js"></script>
    <!-- endbuild -->
    <script>
        $(document).ready(function() {
            $('#submit').hide();
          $("#confirm_password").on('keyup', function() {
            var password = $("#password").val();
            var confirmPassword = $("#confirm_password").val();
            if (password != confirmPassword)
              $("#CheckPasswordMatch").html("Password does not match !").css("color", "red");
            else{
              $("#CheckPasswordMatch").html("Password match !").css("color", "green");
                $('#submit').show();
            }
          });
        });
      </script>
</body>

</html>