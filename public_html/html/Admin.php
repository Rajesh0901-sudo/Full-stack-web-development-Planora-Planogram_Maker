<?php ob_start();
?>
<?php
    session_start();
    
    if((!isset($_SESSION['username'])) or ($_SESSION['type']!=1)){
        $_SESSION['msg'] = "You Must Login Fisrt To View This Page";
        header("location:../php/logout.php");
        ob_flush();
    }
    if(isset($_GET['logout'])){
        unset($_SESSION['username']);
        session.destroy();
        header("location : ../index.php");
        ob_flush();
    }
    
    if(time()-$_SESSION['LAST_ACTIVITY'] > 1200){
        $_SESSION['msg'] = "Session time out";
        header("location:../php/logout.php");
        ob_flush();
        
    }
    include ('../php/printUser.php');

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Planora- Planogram Maker Admin Panel</title>
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
        <nav id="navbar_top" class="navbar navbar-light navbar-expand-lg">
            <button class="logo" type="button"><img class="navbar-brand brand d-none d-sm-block img-fluid brand"
                    src="../img/Planora1.png"></button>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#main_nav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="main_nav">
                <ul class="navbar-nav ml-3">
                
                    <li class="nav-item nav-item-admin"><a class="nav-link " href="#usertable"> User table</li></a>
                    <li class="nav-item nav-item-admin"><a class="nav-link save" href="#usertable">Remove User</li></a>
                    <li class="nav-item nav-item-admin print"><a class="nav-link export" href="#">Print User List</li></a>
                </ul>
                <ul class="navbar-nav mr-5 ml-auto">
                    <li class="nav-item nav-item-admin"><a class="nav-link" href="#Product">Add Default Product</li></a>
                    <li class="nav-item nav-item-admin"><a class="nav-link" href="#">Hello <?php echo $_SESSION['username'];?></li></a>
                    <li class="nav-item nav-item-admin float-right"><a class="nav-link" href="../php/logout.php">Logout</li></a>
                </ul>
            </div>
        </nav>
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
        
        <div class="Heading admin">
            <h2>Hello! Admin </h2> 
        </div>
        <div id="usertable"class="container">
            <div class="row">
                <div class=" offset-1 col-6">
                        
                    <table class="table">
                        <thead>
                            <tr>
                                <th colspan="3">
                                    <h4><center>User Table</center></h4>
                                </th>
                            </tr>

                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">User Name</th>
                                <th scope="col">User Email</th>
                            </tr>
                        </thead>
                            <tbody>
                                <?php   $count=1;// LOOP TILL END OF DATA 
                                    while($rows=$result->fetch_assoc())
                                    {
                                        
                                 ?>
                                <tr>
                                    <!--FETCHING DATA FROM EACH 
                                        ROW OF EVERY COLUMN-->
                                    <td><?php echo $count;?></td>
                                    <td><?php echo $rows['uname'];?></td>
                                    <td><?php echo $rows['email'];?></td>
                                    
                                </tr>
                                <?php
                                    $count++;}
                                 ?> 
                            </tbody>
                        
                    </table>
                </div>
                <div class="col-4">
                    <div id="UserRemove-Form" class="form">
                        <div class="btn btn-remove">
                            <button class="RemoveUser">Remove User</button>
                        </div>
                        <form class="UserRemove-Form" action="../php/removeUser.php" method="POST">
                            <div class="formGroup">
                                <input type="text" name="Name" placeholder="User's Name" required autocomplete="off">
                            </div>
                            <div class="formGroup">
                                <input type="email" placeholder="User's Email ID" name="email" required autocomplete="off">
                            </div>
                            <div class="formGroup">
                                <button type="submit" class="btn2">REMOVE</button>
                            </div>
                            <br>
                        </form>
                        
                    </div>
                </div>
            </div>
<br><br><br><br>
            <div id="usertable" class="container">
                <div class="row">
                    <div class="col-4">
                        <div id="addProduct" class="form">
                            <br>
                           
                            <form class="UserRemove-Form" action="../php/insertProduct.php" method="POST" enctype="multipart/form-data">
                                <div class="formGroup">
                                    <input type="text" id="brand" name="brand" placeholder="Brand" autocomplete="off">
                                </div>
                                <div class="formGroup">
                                    <input type="number" id="upc" name="upc" placeholder="UPC Number" required autocomplete="off">
                                </div>
                                <div class="formGroup">
                                    <input type="text" id="Manufacturer" name="manuf" placeholder="Manufacturer" autocomplete="off">
                                </div>
                                <div class="formGroup">
                                    <input type="text" id="Category" name="cat" placeholder="Category" autocomplete="off">
                                </div>
                                <div class="formGroup">
                                    <input type="number" id="uom" name="uom" placeholder="UOM" autocomplete="off">
                                </div>
                                <div class="formGroup">
                                    <input type="file" name="image" accept="image/*" id="product-image">
                                </div>
            
                                <div class="formGroup">
                                    <button type="submit" name="submit" class="btn2">Add Product</button>
                                </div>
            
                            </form>
            
                        </div>
                    </div>
                    
                    <div class="col-7 offset-1 table">
                        <table id="Product" class=" ProductTable">
                            <thead>
                                <tr>
                                    <th colspan="8">
                                        <h4>
                                            <center>Default Products Table</center>
                                        </h4>
                                    </th>
                                </tr>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Brand</th>
                                    <th scope="col">UPC</th>
                                    <th scope="col">Manufacturer</th>
                                    <th scope="col">Category</th>
                                    <th scope="col">UOM</th>
                                    <th scope="col">Picture</th>
                                    <th scope="col"></th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                                $count = 1;
                                $addedBy = $_SESSION['username'];
                                include("../../connection.php");
                              $check_user_query = "SELECT * FROM products WHERE addedBy='$addedBy'";
                              $result = mysqli_query($conn,$check_user_query);
                            //   $product = mysqli_fetch_assoc($result);
                               while($product=$result->fetch_assoc())
                                { 
                            ?>
                                <tr>
                                    <th scope="row"><?php echo  $count; ?></th>
                                    <td><?php echo $product['brand']; ?></td>
                                    <td><?php echo $product['upcid']; ?></td>
                                    <td><?php echo $product['manufacturer']; ?></td>
                                    <td><?php echo $product['category']; ?></td>
                                    <td><?php echo $product['uom']; ?></td>
                                    <td><div ><img heigt="50px" width="50px" src="<?php echo $product['image']; ?>"></div></td>
                                    <td>
                                        <form action="../php/deleteDefaultProduct.php" method="POST">
                                            <input type="hidden" name="delete" value="<?php echo $product['upcid']; ?>">
                                            <button type="submit">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            <?php 
                                $count = $count+1 ;
                            } ?>
                            </tbody>
                        </table>
                    </div>
            
                </div>

            </div>
            <br><br><br><br>
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
    <script src="../jasonday-printThis-f73ca19/printThis.js"></script>
    <script src="../js/Reg-script.js"></script>
    <!-- endbuild -->
    
</body>

</html>