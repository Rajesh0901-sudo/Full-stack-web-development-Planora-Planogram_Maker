<?php
    ob_start();
?>
<?php
    session_start();
    
    
    include ('../../connection.php');

    //initializing variable

    $errors = array();

    $type = mysqli_real_escape_string($conn,$_POST["type"]);
    $image = "../uploads/".$_FILES["image"]["name"];
    $addedBy = $_SESSION['username'];
    $target_dir = "../uploads/";
    
    if($type===0 ){
        $_SESSION['error']="Enter Valid Details";
        header("Location: ../html/pandf.php");
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
                    header("Location: ../html/pandf.php");
                    ob_flush();
            }
            
            else{
                
                //check database for existing user
            
                if(move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                  
                      $_SESSION['error'] = "The file ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " has been uploaded.";
            
                      $query = "INSERT INTO pandf(addedBy, image, type) VALUES ('$addedBy','$image','$type')";
                      $result = mysqli_query($conn, $query);
                      if ( false===$result ) {
                        $_SESSION['error']=mysqli_error($conn);
                        header("Location: ../html/pandf.php");
                        ob_flush();
                      }
                      else {
                          header("Location: ../html/pandf.php");
                          ob_flush();
            
                      }
                }
                else {
                    $_SESSION['error']= "Sorry, there was an error uploading your file.";
                    header("Location: ../html/pandf.php"); 
                    ob_flush();
              }

            
            }
        
            
        }
    }
        
    
?>
