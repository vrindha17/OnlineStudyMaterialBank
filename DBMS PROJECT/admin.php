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
          <link rel="stylesheet" href="browseraction.css">


<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">

<link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">


</head>
<body>
<div class = "container-fluid custom-container">

<?php
 include('header.php');
    require('credentials1.php');
    if(isset($_SESSION['username'])){
        
        echo "<script>$('#login-button').text('logout');</script>";
    }
    else {
        header("location: adminlogin.php");
    }
    
    
     $link=new mysqli($servername,$dbUserName,$dbPassword,$dbName);
    
    if(!$link)
    {die('couldnt connect' .mysqli_error($link));
    }
    $db_selected=mysqli_select_db($link,$dbName);
    
    if(!$db_selected)
    {die('couldnt connect' .mysqli_error($link));}
    
echo "<br><br><br>";
  //  echo "successfully connected to db";
    echo "<br>";
    
    $sql1="SELECT `Rid`,`Rtype` FROM `resource` WHERE  Flag='1'";
     $result1=mysqli_query($link,$sql1);
     
     if(!$result1)
       die('Error: ' .mysqli_error($link));
       echo "<h2>QUESTION PAPERS</h2><br>";

         echo '<div class="row">';
    while ($row = mysqli_fetch_array($result1))
    {      // echo $row['Rtype'];
            
            if($row['Rtype']=='Q')
            {   $blah=$row['Rid'];
                //echo $blah;
                //echo "appu";
                $sql="SELECT `Qid`, `Rid`, `Test_type`, `Year`, `Link` FROM `question_paper` WHERE Rid=$blah";
                
                $result=mysqli_query($link,$sql);
                $row1 = mysqli_fetch_array($result);
                $sql1="SELECT `Cid` FROM `resource` WHERE Rid=$blah";
                $result2=mysqli_query($link,$sql1);
               $row2 = mysqli_fetch_array($result2);

                echo '<div class="col-md-9">'.$row1['Test_type'].'_'.$row1['Year'].'_'.$row2['Cid'].'</div>
            <div class="col-md-1"><a href='.$row1['Link'].' style = "color: blue; text-decortion: none;"> view</a></div>
            <div class="col-md-1"><a href="deleteqp.php?data1='.$row1['Rid'].'&data2='.$row1['Qid'].'" style = "color: red; text-decoration: none;" > delete</a></div>
            <div class="col-md-1"><a href="unflag.php?data1='.$row1['Rid'].'" style = "color: green; text-decoration: none;"> unflag</a></div>';
                
            }
     
     
     
     
     if($row['Rtype']=='T')
            {   $blah=$row['Rid'];
                //echo $blah;
                //echo "appu";
                
                $sql="SELECT `Tid`, `Tname`, `Link`, `Rid` FROM `text_book` WHERE Rid=$blah";
                $result=mysqli_query($link,$sql);
                $row1 = mysqli_fetch_array($result);
                echo '<div class="col-md-9">'.$row1['Tname'].'</div>
            <div class="col-md-1"><a href='.$row1['Link'].' style = "color: blue; text-decoration: none;"> view</a></div>
            <div class="col-md-1"><a href="deletetb.php?data1='.$row1['Rid'].'&data2='.$row1['Tid'].'" style = "color: red; text-decoration: none;" > delete</a></div>
            <div class="col-md-1"><a href="unflag.php?data1='.$row1['Rid'].'" style = "color: green; text-decoration: none;" > unflag</a></div>
        ';
                
            }

    }
    echo '</div>';
    include('footer.php');
?>
</body>
</html>