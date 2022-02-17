<?php
    session_start();
    $_SESSION['LAST_ACTIVITY'] = time();
    
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
    <link rel="stylesheet" href="../css/Reg-style.css">
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
            <div id="Registration-Form1" class="form getemail">
                <form action="../php/forgetPassword.php" method="POST">
                    
                    <br><br><br>

                    <span class="Heading">An OTP will be sent to your <br>Email to recover password</span>
                    
                    <div class="formGroup">
                        <input type="email" placeholder="Email ID" name="email" required autocomplete="off">
                    </div>

                    <div class="formGroup">
                        <button type="submit" class="btn2">Send OTP</button>
                    </div>
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
    <script src="../js/Reg-script.js"></script>
    <!-- endbuild -->
</body>

</html>