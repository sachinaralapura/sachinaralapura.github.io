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
                $message = "login successful";
                //$_SESSION['loginsucess']=$message;
                echo $message;
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
                    echo "user creation sucessful";
                }
           }else{
            $mismatch = "Password not matching";
            $_SESSION['mismatch']=$mismatch;
            header("location:logreg.php");
           }

        }
        
    }
            
    
?>  
