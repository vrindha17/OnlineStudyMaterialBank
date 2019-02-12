<?php
if (isset($_GET["data1"]))
{
    $rid=$_GET["data1"];

    
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
    
    echo "<br>";

    

    $sql1="UPDATE `resource` SET `Flag`='0' WHERE Rid='$rid'";
    $result1=mysqli_query($link,$sql1);
     
     if(!$result1)
     {die('Error: ' .mysqli_error($link));}
    
header("Location: admin.php");
mysqli_close($link);
    
    
    
    
?>