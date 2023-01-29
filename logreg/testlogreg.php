<?php
    session_start();


    if(isset($_POST['log-submit'])){
        require '../dbinc.php';
    
        $log_email = $_POST['log-email'];
        $log_password = $_POST['log-pass'];
        
        //print_r($_POST);
        
        if(!filter_var($log_email,FILTER_VALIDATE_EMAIL)){
            header("Location:logreg.php");
            exit();
        }
        
    
        $sql = "SELECT * FROM login WHERE email = '$log_email'";
        $result = mysqli_query($conn,$sql) or die("query failed");
        $count=mysqli_num_rows($result);
        $row = mysqli_fetch_assoc($result);
          if($count==1){
            if(password_verify($log_password,$row['password'])){
                //$message = "login successful";
                //$_SESSION['loginsucess']=$message;
                //echo $message;
                $sql = "SELECT uid FROM user WHERE email = '$log_email'";
                $result = mysqli_query($conn,$sql);
                $userid = mysqli_fetch_row($result);
                echo $userid[0];

                $_SESSION['userid'] = $userid[0];
                header("location:../main/main.php");
            }
            else{
                $unsucess = "login unsuccessful";
               $_SESSION['loginunsucess']=$unsucess;
               header("location:logreg.php");
            }
              
          }
          else{
               $unsucess = "login unsuccessful";
               $_SESSION['loginunsucess']=$unsucess;
               header("location:logreg.php");
          }
        
    }
           
           
    if(isset($_POST['sign-submit'])){
        require '../dbinc.php';
        $user_name =$_POST['sign-name'];
        $user_email=$_POST['sign-email'];
        $user_pass=$_POST['sign-pass'];
        $user_cpas=$_POST['sign-cpass'];

        $sql ="SELECT * FROM login WHERE email = '$user_email'";
        $result=mysqli_query($conn,$sql);
        $row = mysqli_num_rows($result);
        if($row>0){
            $message = "Email already registered";
            $_SESSION['emailexists']= $message;
            header("location:logreg.php");
        }else{
           if($user_pass==$user_cpas){
                $hash = password_hash($user_pass,PASSWORD_DEFAULT);
                $insert = "INSERT INTO login (email,name,password) VALUES ( '$user_email','$user_name','$hash')";
                $result = mysqli_query($conn,$insert);
                if($result){
                    $sql = "INSERT INTO user(email,username)  VALUES('$user_email','$user_name');";
                    $result = mysqli_query($conn,$sql);
                    header("location:logreg.php");
                }
           }else{
            $mismatch = "Password not matching";
            $_SESSION['mismatch']=$mismatch;
            header("location:logreg.php");
           }

        }
        
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