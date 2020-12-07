<?php
    session_start();
    session_destroy();
    // Shut Session and Redirect to Home...
    header('location: index.php');
?>