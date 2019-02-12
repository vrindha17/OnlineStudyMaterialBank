<?php
    session_start();
    require('credentials1.php');
    if(isset($_SESSION['username'])){
        session_unset();
        session_destroy();
        echo '<script>window.location.href="admin.php";</script>';
        die();
  }
?>

<!DOCTYPE html>
<html>
<head>
    
    <title>Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="UTF-8"/>
    
    
<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
<link rel="stylesheet" href="adminlogin.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">

</head>
<body>
   
<?php 
  include('header.php');  
?>

    <div class = "container-fluid" id="login-wrapper">
    <div class="header">
        <h2><center> ADMIN LOGIN </center> </h2><br>
</div>
         <form class="form-horizontal" method="post" target="login.php">
  <div class="form-group">
    <label class="control-label col-sm-2" for="email">Username:</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="email" placeholder="Enter username" name="username">
    </div>
  </div>    
  <div class="form-group">
    <label class="control-label col-sm-2" for="pwd">Password:</label>
    <div class="col-sm-10">
      <input type="password" class="form-control" id="pwd" placeholder="Enter password" name="password">
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10 submit-button">
      <button type="submit" class="btn btn-danger" name="login" id="login-submit-button">Login</button>
    </div>
  </div>
</form> 
    
    </div>   
</body>
 
<?php 
  if(isset($_POST['username'])&&isset($_POST['password'])){
      $username = $_POST['username'];
      $password = $_POST['password'];
      $conn = new mysqli($servername,$dbUserName,$dbPassword,$dbName);
      if($conn->connect_error){
            die("connection failed ".$conn->connect_error);
      }
      $sqlQuery = "Select * from admin where AdminId='".$username."' and Password='".$password."'";
                    $result = $conn->query($sqlQuery);
                    if($result->num_rows>0){
                       $_SESSION['username']=$username;
                       $year = substr($username,1,2);
                       switch($year){
                           case $year4:
                               $_SESSION['semester'] = $sem_4;
                               break;
                           case $year3:
                               $_SESSION['semester'] = $sem_3;
                               break;
                           case $year2:
                               $_SESSION['semester'] = $sem_2;
                               break;
                           case $year1:
                               $_SESSION['semester'] = $sem_1;
                               break;
                       }
                        echo $_SESSION['semester'];
                       $_SESSION['branch'] = substr($username,-2);
                       if(isset($_SESSION['semester']) && isset($_SESSION['branch'])){   
                           echo '<script>window.location.href="admin.php";</script>';
                       }
                       die();
                }
              else {
                  echo "<script>alert('wrong email/password');</script>";
              }
  }  
?>
    <?php
        include('footer.php');
    ?>
    
</html>

