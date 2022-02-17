<?php ob_start();
?>
<?php
    session_start();
    
    if((!isset($_SESSION['username'])) or $_SESSION['type']!=0){
        $_SESSION['msg'] = "You Must Login Fisrt To View This Page";
        header("location:../index.php");
        ob_flush();
    }
    if(isset($_GET['logout'])){
        unset($_SESSION['username']);
        session.destroy();
        header("location : ../index.php");
        ob_flush();
    }
    if(time()-$_SESSION['LAST_ACTIVITY'] > 86400){
        $_SESSION['msg'] = "Session time out";
        header("location:../php/logout.php");
        
        ob_flush();
    }
    

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Planora- Planogram Maker</title>
        <!-- Required meta tags always come first -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <!-- Bootstrap CSS -->
        <!-- build:css css/main.css -->
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.1/themes/base/jquery-ui.css">
        <link rel="stylesheet" href="../css/style.css">
        <!-- endbuild -->
    </head>
    <body class="imgbox">
    <div class="d-none d-lg-block">
        <div >
            <nav id="navbar_top" class="navbar navbar-light navbar-expand-lg">
                <button class="logo" type="button"><img class="navbar-brand brand d-none d-sm-block img-fluid brand" src="../img/Planora1.png"></button>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#main_nav">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="main_nav">
                    <ul class="navbar-nav ml-3">
                        
                        <li class="nav-item"><a class="nav-link " href="#"> Home</a></li>
                        <li class="nav-item"><a class="nav-link save" href="#"> Save</a></li>
                        <li class="nav-item"><a class="nav-link export" href="pandf.php"> Prop</a></li>
                        <li class="nav-item"><a class="nav-link export" href="pandf.php"> Fixture</a></li>
                    </ul>
                    <ul class="navbar-nav mr-5 ml-auto">
                        <li class="nav-item "><a class="nav-link" href="Product.php">Product</a></li>
                        <li class="nav-item"><a class="nav-link" href="#"><?php echo $_SESSION["username"];?></li></a>
                        <li class="nav-item float-right"><a class="nav-link" href="../php/logout.php">Logout</a></li>
                    </ul>
                </div>
            </nav>
            <div><center><h3> Hello! <?php echo "" . $_SESSION["username"] . ".<br>"; ?><h3> </center></div>
            <div class="body">
                <div class="box">
                    <span style="--i:1;">
                        <img src="../img/Planora1.png" alt="">
                    </span>
            
                    <span style="--i:2;">
                        <img src="../img/Planora1.png" alt="">
                    </span>
            
                    <span style="--i:3;">
                        <img src="../img/Planora1.png" alt="">
                    </span>
            
                    <span style="--i:4;">
                        <img src="../img/Planora1.png" alt="">
                    </span>
            
                    <span style="--i:5;">
                        <img src="../img/Planora1.png"alt="">
                    </span>
            
                    <span style="--i:6;">
                        <img src="../img/Planora1.png" alt="">
                    </span>
            
                    <span style="--i:7;">
                        <img src="../img/Planora1.png"alt="">
                    </span>
            
                    <span style="--i:8;">
                        <img src="../img/Planora1.png" alt="">
                    </span>
                </div>
            </div>
        </div>
    </div>
        
    <div class="toolbar d-none d-lg-block">
        <h3 class="heading1">Toolbar<h3>
        <div>    
            <button class="btn btn-outline-secondary">
                <input  class='item text' type='text' id="editor" />Click to add TextBox
            </button>
        </div>
    </div>

    <div class="container d-none d-lg-block">
        <div class="row">
            <div class="items-list-div col-3">
                <div class="heading">
                    <h5>Items</h5>
                </div>
                <div class=" btn-show">
                    <button id="b1" class="itemBin">Item Bin</button>
                
                    <button id="b2" class="props">Props</button>
        
                    <button id="b3" class="fixtures">Fixtures</button>
                </div>
                <div id="bin1" class="Item-bin container" >
                    <div class="row">
                        <div class="col-4">
                            <button class="btn">
                                <img class="line" src="../img/line_horizontal.png">
                            </button>
                        </div>
                        <div class="col-4">
                            <button class="btn">
                                <img class="line" src="../img/line_horizontal.png">
                            </button>
                        </div>
                        <div class="col-4">
                            <button class="btn">
                                <img class="line" src="../img/line_horizontal.png">
                            </button>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-4">
                            <button class="btn">
                                <img class="line_horizontal" src="../img/line_vertical.png">
                            </button>
                        </div>
                        <div class="col-4">
                            <button class="btn">
                                <img class="line_horizontal" src="../img/line_vertical.png">
                            </button>
                        </div>
                        <div class="col-4">
                            <button class="btn">
                                <img class="line_horizontal" src="../img/line_vertical.png">
                            </button>
                        </div>
                    </div>
                <?php
                    $count = 1;
                    $str_row_start='<div class="row" id="drag">';
                    $str_row_end= '</div>';
                    $str_start='<div class="col-4" id="drag">
                        <button class="btn">';
                    $str_end='</button></div>';
                    $addedBy = $_SESSION['username'];
                    include("../../connection.php");
                    $check_user_query = "SELECT * FROM products WHERE addedBy='$addedBy' or addedBy='Admin' ";
                    $result = mysqli_query($conn,$check_user_query);
                    $row = mysqli_num_rows($result);
                    
                    while($product=$result->fetch_assoc())
                    { 
                        if($count%3==1){
                            echo $str_row_start;
                        }
                        echo $str_start;
                   
                ?>
                        <img class="items" src="<?php echo $product['image']; ?>">
                <?php 
                       echo $str_end; 
                       
                       if(($count%3==0) || $count==$row){
                            echo $str_row_end;
                        }
                        
                        $count++;   
                    }    
                ?>
                </div>
                <div id="bin2" class="Item-bin container" >
            
                    <?php
                        $count = 1;
                        $str_row_start='<div class="row" id="drag">';
                        $str_row_end= '</div>';
                        $str_start='<div class="col-4" id="drag">
                            <button class="btn">';
                        $str_end='</button></div>';
                        $addedBy = $_SESSION['username'];
                        include("../../connection.php");
                        $check_user_query = "SELECT * FROM pandf WHERE addedBy='$addedBy' AND type='prop' ";
                        $result = mysqli_query($conn,$check_user_query);
                        $row = mysqli_num_rows($result);
                        
                        while($product=$result->fetch_assoc())
                        { 
                            if($count%3==1){
                                echo $str_row_start;
                            }
                            echo $str_start;
                       
                    ?>
                            <img class="items" src="<?php echo $product['image']; ?>">
                    <?php 
                           echo $str_end; 
                           
                           if(($count%3==0) || $count==$row){
                                echo $str_row_end;
                            }
                            
                            $count++;   
                        }    
                    ?>
                </div>
                <div id="bin3" class="Item-bin container" >
                        
                    <?php
                        $count = 1;
                        $str_row_start='<div class="row" id="drag">';
                        $str_row_end= '</div>';
                        $str_start='<div class="col-4" id="drag">
                            <button class="btn">';
                        $str_end='</button></div>';
                        $addedBy = $_SESSION['username'];
                        include("../../connection.php");
                        $check_user_query = "SELECT * FROM pandf WHERE addedBy='$addedBy' AND type='fixture' ";
                        $result = mysqli_query($conn,$check_user_query);
                        $row = mysqli_num_rows($result);
                        
                        while($product=$result->fetch_assoc())
                        { 
                            if($count%3==1){
                                echo $str_row_start;
                            }
                            echo $str_start;
                       
                    ?>
                            <img class="items" src="<?php echo $product['image']; ?>">
                    <?php 
                           echo $str_end; 
                           
                           if(($count%3==0) || $count==$row){
                                echo $str_row_end;
                            }
                            
                            $count++;   
                        }    
                    ?>
                </div>
            </div>
            <div class="col-9">
                <div class="DrawingArea">
                    <div class="Wall">
                        
                    </div>
                </div>
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
        <script src="../js/script.js"></script>
        <script src="../jasonday-printThis-f73ca19/printThis.js"></script>


        <!-- endbuild -->
        
    </body>
</html>