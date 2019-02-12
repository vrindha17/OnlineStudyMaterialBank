<?php
    session_start();

?>
<!DOCTYPE html>
<html>
<head>
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <link rel="stylesheet" href="browseraction.css">
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
    if(isset($_SESSION['username']))
    {   echo "<script>$('#navbar-hello').text('hello ".$_SESSION['username']."');</script>";
        echo "<script>$('#login-button').text('logout');</script>";
    }
    else 
    {    header("location: login.php");
    }
    $link=new mysqli($servername,$dbUserName,$dbPassword,$dbName);
    if(!$link)
    {die('couldnt connect' .mysqli_error($link));
    }
    $db_selected=mysqli_select_db($link,$dbName);
    if(!$db_selected)
    {die('couldnt connect' .mysqli_error($link));
    } if(isset($_POST['department'])&&isset($_POST['course'])&&isset($_POST['resource_type'])&&isset($_POST['test_type']))
    {   $dept=$_POST['department']; 
        $course=$_POST['course'];
        $rtype=$_POST['resource_type'];
        $ttype=$_POST['test_type'];
        $_SESSION['department'] = $dept;
        $_SESSION['course'] = $course;
        $_SESSION['rtype'] = $rtype;
        $_SESSION['ttype'] = $ttype;
        $_SESSION['department'] = $dept;
    }
    if(isset($_SESSION['department']) && isset($_SESSION['course'])&& isset($_SESSION['rtype'])&& isset($_SESSION   ['ttype']))
    {
        $dept=$_SESSION['department']; 
        $course=$_SESSION['course'];
        $rtype=$_SESSION['rtype'];
        $ttype=$_SESSION['ttype'];
        $flg = 0;
        if($rtype=='question_paper')
        {    
            echo "<h2>QUESTION PAPERS</h2><br>";
            $sql1="SELECT `Rid` FROM `resource` WHERE Cid='$course' AND Rtype='Q' AND Flag='0'";
            $result1=mysqli_query($link,$sql1);
            if(!$result1)
                {die('Error: ' .mysqli_error($link));}
            while ($row = mysqli_fetch_array($result1))
            {
                $flg = 1;
                $blah=$row['Rid'];
                $sql="SELECT `Qid`, `Rid`, `Test_type`, `Year`, `Link`  FROM `question_paper` WHERE Test_type='$ttype' AND Rid=$blah ";
                 $result=mysqli_query($link,$sql);
                 if(!$result)
                    {die('Error: ' .mysqli_error($link));}
                 echo '<div class="row">';
                 echo "<script>alert('low');</script>";
                while ($row = mysqli_fetch_array($result))
                {
                    echo '
                    <div class="col-md-8">'.$row['Test_type'].'_'.$row['Year'].'_'.$course.'</div> <div class="col-md-2"><a href='.$row['Link'].' style = "color: green; text-decoration: none;" target="_blank" >View</a></div> <div class="col-md-2"><a href="flag.php?data1='.$row['Rid'].'" style = "color: red; text-decoration: none;">Flag</a></div>';
                }    
                echo '</div>';
            }
    
            if($flg==0)
                {echo"SORRY! No results available right now :(";
                }
        
        }

        if($rtype=='material')
        {    echo "<h2>TEXT BOOKS</h2><br>";
             $sql1="SELECT `Rid` FROM `resource` WHERE Cid='$course' AND Rtype='T' AND Flag='0'";
             $result1=mysqli_query($link,$sql1);
             if(!$result1)
                {die('Error: ' .mysqli_error($link));}
            while ($row = mysqli_fetch_array($result1))
            {
                $flg = 1;
                $blah=$row['Rid'];
                $sql="SELECT `Tid`, `Rid`, `Tname`, `Link` FROM `text_book` WHERE  Rid=$blah ";
                $result=mysqli_query($link,$sql);
                if(!$result)
                    {die('Error: ' .mysqli_error($link));}
                echo '<div class="row">';
                while ($row = mysqli_fetch_array($result))
                {   echo '
                    <div class="col-md-8">'.$row['Tname'].'</div> <div class="col-md-2"><a href='.$row['Link'].' style = "color: green; text-decoration: none;" target="_blank" >View</a></div> <div class="col-md-2"><a href="flag.php?data1='.$row['Rid'].'" style = "color: red; text-decoration: none;">Flag</a></div>';
                  }
                echo '</div>';
            }
            if($flg==0){echo"SORRY! No results available right now :(";
                        }

        }
     }
    include('footer.php');  
    mysqli_close($link);
    ?>
    </div>
    </body>
</html>