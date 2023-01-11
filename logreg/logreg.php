 <?php
    session_start();
    ?>

 <!DOCTYPE html>
 <!-- === Coding by CodingLab | www.codinglabweb.com === -->
 <html lang="en">

 <head>
     <meta charset="UTF-8">
     <meta http-equiv="X-UA-Compatible" content="IE=edge">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <!-- ===== Iconscout CSS ===== -->
     <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
     <!-- ===== CSS ===== -->
     <link rel="stylesheet" href="../static/css/logreg.css">

     <!--<title>Login & Registration Form</title>-->
 </head>

 <body>
     <header>

         <nav class="navbar">
             <h3 style="color: white;">PROJECT</h3>
             <a href="../index.html">HOME</a>
             <a href="">Contact</a>
             <a href="">login</a>
         </nav>
     </header>

     <div class="container">

         <div class="forms">

             <div class="form login">
                 <h4 style="color: red; text-align:center">
                     <?php


                        if (isset($_SESSION['loginunsucess'])) {
                            echo $_SESSION['loginunsucess'];
                            session_unset();
                            session_destroy();
                        }

                        ?>
                 </h4>

                 <span class="title">Login </span>

                 <form action="testlogreg.php" method="POST">

                     <div class="input-field">
                         <input type="text" name="log-email" placeholder="Enter your email" required>
                         <i class="uil uil-envelope icon"></i>
                     </div>

                     <div class="input-field">
                         <input type="password" class="password" name="log-pass" placeholder="Enter your password" required>
                         <i class="uil uil-lock icon"></i>
                         <i class="uil uil-eye-slash showHidePw"></i>
                     </div>

                     <!-- <div class="checkbox-text">
                            <div class="checkbox-content">
                                <input type="checkbox" id="logCheck">
                                <label for="logCheck" class="text">Remember me</label>
                            </div>

                            <a href="#" class="text">Forgot password?</a>
                        </div> -->

                     <div class="input-field button">
                         <input type="submit" value="Login" name="log-submit">
                     </div>

                 </form>

                 <div class="login-signup">
                     <span class="text">Not a member?
                         <a href="#" class="text signup-link">Signup Now</a>
                     </span>
                 </div>
             </div>


             <!-- Registration Form -->


             <div class="form signup">
                 <h4 style="color: red; text-align:center">
                     <?php


                        if (isset($_SESSION['mismatch'])) {
                            echo $_SESSION['mismatch'];
                            session_unset();
                            session_destroy();
                        }
                        if (isset($_SESSION['emailexists'])) {
                            echo $_SESSION['emailexists'];
                            session_unset();
                            session_destroy();
                        }

                        ?>
                 </h4>
                 <span class="title">Registration</span>

                 <form action="testlogreg.php" method="POST">

                     <div class="input-field">
                         <input type="text" placeholder="Enter your name" required name="sign-name">
                         <i class="uil uil-user"></i>
                     </div>

                     <div class="input-field">
                         <input type="text" placeholder="Enter your email" required name="sign-email">
                         <i class="uil uil-envelope icon"></i>
                     </div>

                     <div class="input-field">
                         <input type="password" class="password" placeholder="Create a password" required name="sign-pass">
                         <i class="uil uil-lock icon"></i>
                     </div>

                     <div class="input-field">
                         <input type="password" class="password" placeholder="Confirm a password" required name="sign-cpass">
                         <i class="uil uil-lock icon"></i>
                         <i class="uil uil-eye-slash showHidePw"></i>
                     </div>

                     <!-- <div class="checkbox-text">
                        <div class="checkbox-content">
                            <input type="checkbox" id="termCon">
                            <label for="termCon" class="text">I accepted all
                                terms and conditions</label>
                        </div>
                    </div> -->

                     <div class="input-field button">
                         <input type="submit" value="Signup" name="sign-submit">
                     </div>

                 </form>

                 <div class="login-signup">
                     <span class="text">Already a member?
                         <a href="#" class="text login-link">Login Now</a>
                     </span>
                 </div>
             </div>
         </div>
     </div>

     <script src="../static/javascript/logreg.js"></script>

 </body>

 </html>
