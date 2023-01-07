<?php



    if(isset($_POST['log-submit'])){
        require '../dbinc.php';
    
        $log_email = $_POST['log-email'];
        $log_password = $_POST['log-pass'];
        
        //print_r($_POST);
        
        if(!filter_var($log_email,FILTER_VALIDATE_EMAIL)){
            header("Location:logreg.php");
            exit();
        }
        
        echo $log_email;
        echo $log_password;
        $sql = "SELECT * FROM login WHERE email = '$log_email' AND password='$log_password' ";
        $result = mysqli_query($conn,$sql) or die("query failed");
        $count=mysqli_num_rows($result);
        print_r($result);        
        print_r($count);
        if($count>0){
            echo "login successful";
        }
        else{
             echo "login unsuccessful";
        }
        
    }
           
           
    if(isset($_POST['sign-submit'])){
        require '../dbinc.php';
        echo "success";
    }
           
           
           
           
           
           
           
           
           
           
           
           
           
           
           
           
           
           
           
           
           
           
           
           
           
           
           
           
           
           
           
            // $sql = "SELECT * FROM login WHERE email = ?";
            // //create a prepared statement
            // $stmt  = mysqli_stmt_init($conn);
            // //prepare the prepared statement
            // if(!mysqli_stmt_prepare($stmt,$sql)){
            //     echo "sql statement failed";
            // }else{
            //     echo "sucess";
            //     //bind parameters to the placeholders
            //     mysqli_stmt_bind_param($stmt,"s",$log_email);
            //     //Run parameters inside database
            //     mysqli_stmt_execute($stmt);
            //     $row = mysqli_stmt_get_result($stmt);
            // }
            // $row = mysqli_fetch_assoc($row);
            
            // echo is_array($row);

        
            //print_r($row['password']);
            // if($row["email"]=="sachin.aralapura@gmail.com"){
            //     echo "<h1> admim </h1> ";
            // }
            
       
        
           
    
?>  