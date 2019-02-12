<?php
if (isset($_GET["data1"])&&isset($_GET["data2"]))
{
    $rid=$_GET["data1"];
    $qid=$_GET["data2"];
    echo $rid;
    echo $qid;
}

require('credentials1.php');


    $link=new mysqli($servername,$dbUserName,$dbPassword,$dbName);
    
    if(!$link)
    {die('couldnt connect' .mysqli_error($link));
    }
    $db_selected=mysqli_select_db($link,$dbName);
    
    if(!$db_selected)
    {die('couldnt connect' .mysqli_error($link));}
    
    echo "<br><br><br>";
    echo "successfully connected to db";
    echo "<br>";

    $sql1="DELETE FROM `resource` WHERE Rid='$rid'";
    $result1=mysqli_query($link,$sql1);
     
     if(!$result1)
     {die('Error: ' .mysqli_error($link));}

    $sql3="SELECT `Qid`, `Rid`, `Test_type`, `Year`, `Link` FROM `question_paper` WHERE  Qid='$qid'";
    $result3=mysqli_query($link,$sql3);
    $row3=mysqli_fetch_array($result3);
    $valid_link=$row3['Link'];
    echo $valid_link;

    $sql2="DELETE FROM `question_paper` WHERE Qid='$qid'";
    $result2=mysqli_query($link,$sql2);
     
     if(!$result2)
     {die('Error: ' .mysqli_error($link));}
    echo "deleted successfully";

    $file = $valid_link;
    $fileExt = explode('http://localhost/DBMS/',$file);
    echo $fileExt[1];
    if (!unlink($fileExt[1]))
      {
    echo ("Error deleting $file");
    }
    else
    {
     echo ("Deleted $file");
    }
  header("Location: admin.php");
mysqli_close($link);
    
    
    
    
?>