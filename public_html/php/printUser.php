
<?php


    include ('../../connection.php');

    $query = "SELECT * FROM users WHERE type=0";
    $result = mysqli_query($conn,$query);
    mysqli_close($conn);
        
    
?>