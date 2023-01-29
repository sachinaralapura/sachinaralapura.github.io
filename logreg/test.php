<?php
    include '../dbinc.php';
    $email = 'sachin.aralapura@gmail.com';
    $sql = "SELECT * FROM login where email = '$email'";
            
            if($result = mysqli_query($conn,$sql)){

                echo "sucess";
            }
            $row=mysqli_fetch_array($result);
            print_r($row);
       
           

    
?>