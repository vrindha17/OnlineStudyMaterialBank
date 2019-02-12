<?php
    session_start();
    require('credentials1.php');
    $link=new mysqli($servername,$dbUserName,$dbPassword,$dbName);
    
    if(!$link)
    {   die('couldnt connect' .mysqli_error($link));
    }
    $db_selected=mysqli_select_db($link,$dbName);
    if(!$db_selected)
    {die('couldnt connect' .mysqli_error($link));
    }

    if(isset($_POST['department'])&&isset($_POST['course'])&&isset($_POST['resource_type']))
    {
        $dept=$_POST['department'];  
        $course=$_POST['course'];
        $rtype=$_POST['resource_type'];

        if($rtype=='question_paper')
        {   if(isset($_POST['test_type'])&&isset($_POST['year']))
            {
                   $ttype=$_POST['test_type'];
                   $year=$_POST['year'];        
                   if(isset($_POST['login']))
                   {  
                      $file = $_FILES['file'];  //name
                      $fileName = $_FILES['file']['name'];
                      $fileTmpName = $_FILES['file']['tmp_name'];
                      $fileSize = $_FILES['file']['size'];
                      $fileError = $_FILES['file']['error'];
                      $fileType = $_FILES['file']['type'];
                      $fileExt = explode('.',$fileName);
                      $fileActualExt = strtolower(end($fileExt));
                      $allowed = array('jpg','jpeg','png','pdf');
                      if(in_array($fileActualExt,$allowed))
                      {
                         if($fileError === 0) //no errors
                         {
                            $name=$course.'_'.$ttype.'_'.$year.'.'.$fileActualExt;
                            $fileDestination = 'up/'.$dept.'/'. $name;
                            move_uploaded_file($fileTmpName,$fileDestination);
                         }
                         else
                         {echo "there was an error";	
                         }
                      }
                      else
                        {echo "u cannot upload files of this type";
                        }
                    }

                    $sql="SELECT* FROM `question_paper` where test_type='$ttype' and year='$year'";
                    $result=mysqli_query($link,$sql);

                    while ($row = mysqli_fetch_array($result))
                    {   $blah=$row['Rid'];
                        $sql1="SELECT* FROM `resource` WHERE Rid='$blah'";
                        $result1=mysqli_query($link,$sql1);
                        $row1 = mysqli_fetch_array($result1);
                        if($row1['Cid']==$course)
                        {   echo "<script>alert('Resource already exists.. Your efforts are appreciated');</script>";
                            echo "<script>window.location.href = 'upload.php';</script>";
                            $flg=1;
                        }
                        
                    }
                    if($flg==1){
                        echo "<script>window.location.href = 'upload.php';</script>";
                    }
                    else{$flg=0;
                    $sql="INSERT INTO `resource` (`Rid`, `Rtype`, `Flag`, `Cid`) VALUES (NULL, 'Q', '0', '$course')";
                    $result=mysqli_query($link,$sql);
                    if(!$result)
                    { die('Error: ' .mysqli_error($link));
                    }
                    $sql1="SELECT `Rid` FROM `resource`";
                    $result1=mysqli_query($link,$sql1);
                    if(!$result1)
                        {die('Error: ' .mysqli_error($link));}

                    while ($row = mysqli_fetch_array($result1))
                    {$valid_row=$row['Rid'];
                    }    
                    $valid_link="http://localhost/DBMS/".$fileDestination;
                    $sql="INSERT INTO `question_paper` (`Qid`, `Rid`, `Test_type`, `Year`,`Link`) VALUES (NULL, '$valid_row', '$ttype', '$year', '$valid_link')";	
                    $result=mysqli_query($link,$sql);

                    if(!$result)
                        {die('Error: ' .mysqli_error($link));}
                    echo "<script>alert('Successfully uploaded... Thank you for contributing');</script>";
                    echo "<script>window.location.href = 'upload.php';</script>";
                    }
            }
         }
    
    
    
        
        if($rtype=='material')
        {	
            if(isset($_POST['text_name']))
               {    $textname=$_POST['text_name'];
                    if(isset($_POST['login']))
                    {
                        $file = $_FILES['file'];  //name
                        $fileName = $_FILES['file']['name'];
                        $fileTmpName = $_FILES['file']['tmp_name'];
                        $fileSize = $_FILES['file']['size'];
                        $fileError = $_FILES['file']['error'];
                        $fileType = $_FILES['file']['type'];
                        $fileExt = explode('.',$fileName);
                        $fileActualExt = strtolower(end($fileExt));
                        $allowed = array('jpg','jpeg','png','pdf');
                        if(in_array($fileActualExt,$allowed))
                        {
                            if($fileError === 0) //no errors
                            {   $name=$course.'_'.$textname.'.'.$fileActualExt;
                                $fileDestination = 'up/'.$dept.'/'. $name;
                                move_uploaded_file($fileTmpName,$fileDestination);
                            }
                            else
                            {
                                echo "there was an error";	
                            }
                        }
                        else
                        {
                            echo "u cannot upload files of this type";
                        }
                    }

                    $sql="SELECT* FROM `text_book` where tname='$textname'";
                    $result=mysqli_query($link,$sql);
                    while ($row = mysqli_fetch_array($result))
                    {   $blah=$row['Rid'];
                        $sql1="SELECT* FROM `resource` WHERE Rid='$blah'";
                        $result1=mysqli_query($link,$sql1);
                        $row1 = mysqli_fetch_array($result1);
                        if($row1['Cid']==$course)
                        {   echo "<script>alert('Resource already exists.. Your efforts are appreciated');</script>";
                            echo "<script>window.location.href = 'upload.php';</script>";
                            $flg=1;
                        }
                    }
                    if($flg==1){
                     echo "<script>window.location.href = 'upload.php';</script>";   
                    }
                    else{$flg=0;
                    $sql="INSERT INTO `resource` (`Rid`, `Rtype`, `Flag`, `Cid`) VALUES (NULL, 'T', '0', '$course')";
                    $result=mysqli_query($link,$sql);
                    if(!$result)
                    {
                        die('Error: ' .mysqli_error($link));
                    }

                    $sql1="SELECT `Rid` FROM `resource`";
                    $result1=mysqli_query($link,$sql1);
                    if(!$result1)
                        {die('Error: ' .mysqli_error($link));}
                    while ($row = mysqli_fetch_array($result1))
                    {
                        $valid_row=$row['Rid'];
                    }    

                    $valid_link="http://localhost/DBMS/".$fileDestination;
                    $sql="INSERT INTO `text_book` (`Tid`, `Tname`, `Link`, `Rid`) VALUES (NULL, '$textname', '$valid_link', '$valid_row')";	
                    $result=mysqli_query($link,$sql);

                    if(!$result)
                        {die('Error: ' .mysqli_error($link));}

                    echo "<script>alert('Successfully uploaded!! Thank You for contributing :)');</script>";
                    echo "<script>window.location.href = 'upload.php';</script>";
                    }
               
            }
        }
    }
mysqli_close($link);
?>

