<?php
    session_start();
?>
<link rel="stylesheet" type="text/css" href="index.css">
<html>
<body>

	<!--CSS Spinner-->
<div id="spinner-wrapper">
<div id="spinner"></div>
</div>
<?php 
  include('login.php');
  ?>
  <script>
$("#spinner-wrapper").delay(1000).fadeOut('slow');
</script>

</body>
</html>html>
