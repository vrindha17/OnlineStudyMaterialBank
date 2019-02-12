<?php
    session_start();
?>
<?php
    require('header.php');
    require('credentials1.php');
    if(isset($_SESSION['username'])){
        echo "<script>$('#navbar-hello').text('hello ".$_SESSION['username']."');</script>";
        echo "<script>$('#login-button').text('logout');</script>";
    }
    else {
        header("location: login.php");
    }
?>
