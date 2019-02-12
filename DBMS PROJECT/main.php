<?php
    session_start();
?>
<!DOCTYPE html>
<html>
<head>
    
    <title>Study Material Bank</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="UTF-8"/>
     <link rel="stylesheet" href="main.css">

<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">

<link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">


</head>
<body>
<?php
    include('header.php');
    require('credentials1.php');
    if(isset($_SESSION['username'])){
                echo "<script>$('#navbar-hello').text('hello ".$_SESSION['username']."');</script>";
        echo "<script>$('#login-button').text('logout');</script>";
    }
    else {
        header("location: login.php");
    }
?>
<div class = "container-fluid custom-container">
<!--<div class="row" style="padding-top: 80px; text-align: center;"><h1>Study Material Bank</h1></div>-->
<div class="row"><a href="browse.php" style="color: inherit;">
    <div class="col-md-6" id = "browse">
        <h3 class="color-header center">Browse</h3>
        <p id = "about-us-content-writeup center">To view different resources sorted according to department and course.
        </p>   
    </div></a>

    <a href="upload.php" style="color: inherit;">
    <div class="col-md-6" id = "upload">
        <h3 class="color-header center">Upload</h3>
    
        <p id = "about-us-content-writeup center">To upload question papers and other resources.
        </p>     
    </div></a>
</div>
</div>


</body>
<?php
   include('footer.php'); 
 ?>
</html>