<?php session_start(); ?>
<!DOCTYPE html>
<html>
<title>W3.CSS</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<body >

<header class="w3-container w3-teal" style="text-align: center;">
  <h1>Parents Monitoring System</h1>
</header>

<div class="w3-container w3-half w3-margin-top" style="margin:auto;float:none;">

<form class="w3-container w3-card-4" method="post" action="login_sub.php" id="frm" onsubmit="return validateForm()">
	<?php if(isset($_SESSION['success']) && $_SESSION['success'] != ''){ ?>
<p style="color:green"><?php echo $_SESSION['success']; ?></p>
<?php $_SESSION['success'] = '';} ?>
<?php if(isset($_SESSION['error']) && $_SESSION['error'] != ''){ ?>
<p style="color:green"><?php echo $_SESSION['error']; ?></p>
<?php $_SESSION['error'] = '';} ?>
<p id="error" style="color:red;display: none;"></p>

<p>
<label>Email</label>
<input class="w3-input" type="text" id="email" name="email" style="width:90%" ></p>
<label>Password</label>
<input class="w3-input" type="text" id="password" name="password" style="width:90%" ></p>
<p>
<button class="w3-button w3-section w3-teal w3-ripple" type="submit" style="text-align: center;"> Log in </button></p>

</form>

</div>
<script type="text/javascript">
	function validateForm() {
		 var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    
  var email = document.forms["frm"]["email"].value;

  var password = document.forms["frm"]["password"].value;

  if (email == "" || password == "") {
    document.getElementById('error').innerHTML = 'all fields are required';
    document.getElementById("error").style.display = "block";
    return false;
  }
  if(!re.test(email)){
  	document.getElementById('error').innerHTML = 'Enter valid email address';
    document.getElementById("error").style.display = "block";
    return false;
  }
  
}
</script>
</body>
</html> 
