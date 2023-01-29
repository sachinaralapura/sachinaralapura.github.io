<?php
    // Start a new session or resume an existing one
    session_start();
    // Set the user's ID in the session to null, effectively logging them out
    $SESSION['userid'] = null;
    // End the session and delete the session data
    session_destroy();
    // Redirect the user to the logreg.php page
    header("location:../logreg/logreg.php");
?>
 