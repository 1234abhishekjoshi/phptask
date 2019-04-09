<?php 
session_start();
require('Database.php');
$crud =new Database();

?>
<!DOCTYPE html>
<html>
<title>W3.CSS</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<body >

<header class="w3-container w3-teal" >
	<button class="w3-button w3-teal w3-xlarge" onclick="w3_open()" style="position: absolute;top:10px;">☰</button>
  <h1 style="text-align: center;">Parents Monitoring System</h1>
</header>
<!-- Sidebar -->
<div class="w3-sidebar w3-bar-block w3-border-right" style="display:none" id="mySidebar">
  <button onclick="w3_close()" class="w3-bar-item w3-large">Close &times;</button>
  <a href="javascript:;" class="w3-bar-item w3-button">User :-<?php echo $_SESSION['name']; ?></a>
  <?php if($_SESSION['user_type'] == 2){ ?>
  <a href="children_dashboard.php" class="w3-bar-item w3-button">Dashboard</a>
<?php }?>
<?php if($_SESSION['user_type'] == 1){ ?>
  <a href="task.php" class="w3-bar-item w3-button">Dashboard</a>
<?php }?>
  <a href="logout.php" class="w3-bar-item w3-button">Logout</a>
</div>
<div class="w3-container w3-half w3-margin-top" style="margin:auto;float:none;">

<form class="w3-container w3-card-4" name="frm"  method="post" action="change_password_sub.php" onsubmit="return validateForm()">
		<?php if(isset($_SESSION['success']) && $_SESSION['success'] != ''){ ?>
<p style="color:green"><?php echo $_SESSION['success']; ?></p>
<?php $_SESSION['success'] = '';} ?>
<?php if(isset($_SESSION['error']) && $_SESSION['error'] != ''){ ?>
<p style="color:red"><?php echo $_SESSION['error']; ?></p>
<?php $_SESSION['error'] = '';} ?>
<p id="error" style="color:red;"></p>
<p>
<label>Old Password</label>
<input class="w3-input" type="text" id="" name="old_password"  style="width:90%"  placeholder="old password"></p>
<p>
<label>New Password</label>
<input class="w3-input" type="text" id="taskDetail" name="new_password" style="width:90%"  placeholder="New password"></p>
<p>
<label>Confirm Password</label>
<input class="w3-input" type="text" id="taskDetail" name="confirm_password" style="width:90%"  placeholder="Confirm password"></p>
<p>
<button class="w3-button w3-section w3-teal w3-ripple" style="margin:5px;" type="submit"> Submit </button></p>

</form>


</div>
<script type="text/javascript">
	
	function w3_open() {
  document.getElementById("mySidebar").style.display = "block";
}

function w3_close() {
  document.getElementById("mySidebar").style.display = "none";
}
function validateForm() {
		
    
  var old_password = document.forms["frm"]["old_password"].value;

  var new_password = document.forms["frm"]["new_password"].value;
  var confirm_password = document.forms["frm"]["confirm_password"].value;

  if (old_password == "" || new_password == "" || confirm_password == "") {
    document.getElementById('error').innerHTML = 'all fields are required';
    document.getElementById("error").style.display = "block";
    return false;
  }
  if(new_password != confirm_password){
  	document.getElementById('error').innerHTML = 'Password and confirm password does not match';
    document.getElementById("error").style.display = "block";
    return false;
  }
  
}
</script>
  
</body>
</html> 
