<?php
    ob_start();
?>
<?php
    session_start();
    
    
    include ('../../connection.php');

    //initializing variable

    $errors = array();

    $brand = mysqli_real_escape_string($conn,$_POST["brand"]);
    $upc = mysqli_real_escape_string($conn,$_POST["upc"]);
    $manuf = mysqli_real_escape_string($conn,$_POST["manuf"]);
    $cat = mysqli_real_escape_string($conn,$_POST["cat"]);
    $uom = mysqli_real_escape_string($conn,$_POST["uom"]);
    $image = "../uploads/".$_FILES["image"]["name"];
    $addedBy = $_SESSION['username'];
    $type = $_SESSION['type'];
    $target_dir = "../uploads/";
    
    if($brand===0 ||$upc===0||$manuf===0||$cat===0||$uom===0 ){
        $_SESSION['error']="Enter Valid Details";
        header("Location: ../html/Admin.php");
        ob_flush();
    }
    
    else{
    
        if(($_FILES['image']['type']=='image/png') or ($_FILES['image']['type']=='image/jpg') or ($_FILES['image']['type']=='image/jpeg')){
        
            $target_file = $target_dir . basename($_FILES["image"]["name"]);
            $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
        
            // Check if image file is an actual image or fake image
            
                
            // Check file size
            if ($_FILES["image"]["size"] > 5000000) {
                
                    $_SESSION['error']="Sorry, your file is too large.";
                    header("Location: ../html/Admin.php");
                    ob_flush();
            }
            
            else{
                
                //check database for existing user
            
                $check_user_query = "SELECT * FROM products WHERE upcid = '$upc' LIMIT 1";
            
                $result = mysqli_query($conn,$check_user_query);
                $product = mysqli_fetch_assoc($result);
            
                if($product){
                    if($product["upcid"]===$upc){
                        
                        $_SESSION['error']="Product exist";
                        header("Location: ../html/Admin.php");
                        ob_flush();
                        
                    }
                }
                else{
            
                    if(move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                      
                          $_SESSION['error'] = "The file ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " has been uploaded.";
                
                          $query = "INSERT INTO products(upcid, manufacturer, brand, category, uom, image, addedBy, type) VALUES ('$upc','$manuf','$brand','$cat','$uom','$image','$addedBy','$type')";
                          $result = mysqli_query($conn, $query);
                          if ( false===$result ) {
                            $_SESSION['error']=mysqli_error($conn);
                            header("Location: ../html/Admin.php");
                            ob_flush();
                          }
                          else {
                              header("Location: ../html/Admin.php");
                              ob_flush();
                
                          }
                    }
                    else {
                        $_SESSION['error']= "Sorry, there was an error uploading your file.";
                        header("Location: ../html/Admin.php"); 
                        ob_flush();
                  }
                    
                }
                
                
            }
        
            
        }
    }
        
    
?>
