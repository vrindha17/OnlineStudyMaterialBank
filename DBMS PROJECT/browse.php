<?php
    session_start();
?>
<html>
<head>
   
    <title>browse</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="UTF-8"/>
    <link rel="stylesheet" href="browse.css">
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js" ></script>
    <script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.2/jquery-ui.min.js"></script>‌​
    <script>
    function populate(s1,s2){
	var s1 = document.getElementById(s1);
	var s2 = document.getElementById(s2);
	s2.innerHTML = "";
	if(s1.value == "CSE"){
		var optionArray = ["|","DSA|DSA","DBMS|DBMS","DS|DS","OS|OS"];
	} else if(s1.value == "ECE"){
		var optionArray = ["|","EC1|EC1","EC2|EC2","EC3|EC3"];
	} else if(s1.value == "EEE"){
		var optionArray = ["|","EEE1|EEE1","EEE2|EEE2","EEE3|EEE3"];
	} else if(s1.value == "CE"){
		var optionArray = ["|","CE1|CE1","CE2|CE2","CE3|CE3"];
	} else if(s1.value == "ME"){
		var optionArray = ["|","ME1|ME1","ME2|ME2","ME3|ME3"];
	} else if(s1.value == "EP"){
		var optionArray = ["|","EP1|EP1","EP2|EP2","EP3|EP3"];
	} else if(s1.value == "BT"){
		var optionArray = ["|","BT1|BT1","BT2|BT2","BT3|BT3"];
	} else if(s1.value == "CHE"){
		var optionArray = ["|","CHE1|CHE1","CHE2|CHE2","CHE3|CHE3"];
	}
     
	for(var option in optionArray){
		var pair = optionArray[option].split("|");
		var newOption = document.createElement("option");
		newOption.value = pair[0];
		newOption.innerHTML = pair[1];
		s2.options.add(newOption);
	}
}
</script>
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
<div class = "container-fluid custom-container" id="login-wrapper">
<h2>SEARCH FOR STUDY MATERIALS </h2></font>

<form class="form-horizontal" method="post" action="browseaction.php" name="browse">
<div class="form-group">
<label class="control-label col-sm-2" for="department">Department :</label>
<div class="col-sm-10">
 <select id="department" name="department" onchange="populate(this.id,'course')" aria-describedby="passwordHelpBlock">
  <option disabled selected value>--select--</option>
  <option value="CSE">Computer Science and Engineering</option>
  <option value="ECE">Electronics Communication And Engineering</option>
  <option value="EEE">Electrical And Electronics Engineering</option>
  <option value="CE">Civil Engineering</option>
  <option value="ME">Mechanical Engineering</option>
  <option value="BT">Bio Technology</option>
  <option value="CHE">Chemical Engineering</option>
  <option value="EP">Engineering Physics</option>
  </select>
<small id="passwordHelpBlock" class="form-text text-muted">
  select the desired department.
</small>
   </div>
</div>


<div class="form-group">
<label class="control-label col-sm-2" for="course">Course :</label>
<div class="col-sm-10">
 <select name="course" id="course" aria-describedby="passwordHelpBlock1">
   <option disabled selected value>--select--</option>
  </select>
  <small id="passwordHelpBlock1" class="form-text text-muted">
  select your course. </div>
</div>


<div class="form-group">
<label class="control-label col-sm-2" for="resource_type">Resource Type :</label>
<div class="col-sm-10">
 <select name="resource_type" id="resource_type" required aria-describedby="passwordHelpBlock2">
  <option value="material">Text Book</option>
    <option value="question_paper">Question Paper</option>
  </select>
  <small id="passwordHelpBlock2" class="form-text text-muted">
  select the resource type. </div>
</div>
<script>$('#resource_type').on('change',function(){
        if( $(this).val()==="question_paper"){
        $("#test").show()
        }
        else{
        $("#test").hide()
        }
    });</script>

<div class="form-group" id="test" style="display:none;">
<label class="control-label col-sm-2" for="test_type">Test Type :</label>
<div class="col-sm-10">
 <select name="test_type" id="test_type" aria-describedby="passwordHelpBlock3">
  <option value="t1">T1</option>
  <option value="t2">T2</option>
  <option value="end_sem">End Semester</option>
  </select> 
  <small id="passwordHelpBlock3" class="form-text text-muted">
  select the test type.</div>
</div>
<br><br>
<div class="col-sm-offset-2 col-sm-10 submit-button" id="submit-button">
      <button type="submit" class="btn btn-danger" name="login" id="login-submit-button">submit</button> 
    </div>

</form>
</div>
</body>
<?php
   include('footer.php'); 
 ?>
</html>








