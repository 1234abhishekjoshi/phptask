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
<style type="text/css">
	header div {
  width: 35px;
  height: 5px;
  background-color: white;
  margin: 6px 0;
}
</style>
<header class="w3-container w3-teal" >
	<button class="w3-button w3-teal w3-xlarge" onclick="w3_open()" style="position: absolute;top:10px;">☰</button>
  <h1 style="text-align: center;">Parents Monitoring System</h1>
</header>
<!-- Sidebar -->
<div class="w3-sidebar w3-bar-block w3-border-right" style="display:none" id="mySidebar">
  <button onclick="w3_close()" class="w3-bar-item w3-large">Close &times;</button>
  <a href="javascript:;" class="w3-bar-item w3-button">User :-<?php echo $_SESSION['name']; ?></a>
  <a href="change_password.php" class="w3-bar-item w3-button">Change Password</a>
  <a href="logout.php" class="w3-bar-item w3-button">Logout</a>
</div>
<div class="w3-container w3-half w3-margin-top" style="margin:auto;float:none;">


<table id="task" border="1" class="w3-table">
	<tr><th>Description</th><th>Upload</th><th>status</th></tr>
	<?php 
		$q = 'SELECT * FROM tasks WHERE childrenId='.$_SESSION['user_id'];
		$rs = $crud->getAllData($q);
		$task_id = '';
		foreach($rs as $key=>$value){
          	$task_id .= $value['id'].',';	

	?>
	<tr><td><?php echo $value['detail']; ?></td><td><form method="post" id="<?php echo $key; ?>" action="assignment_upload.php"  enctype="multipart/form-data"><input type="file" name="image" onchange="submitForm(<?php echo $key; ?>)" accept="pdf,png"><input type="hidden" value="<?php echo $value['id']; ?>" name="id"></form></td><td><?php if($value['status'] == 2){ echo '<span style="background-color:#16ea16;color:white;padding:10px;border-radius:50%;">✓</span>Completed';}else if($value['status'] ==1){ echo 'Assigned';} ?></td></tr>
	<?php }?>
</table>
<p>
	<form method="post" id="frm" action="change_status.php"><input type="hidden" name="task_id" value="<?php echo rtrim($task_id,','); ?>">
<button class="w3-button w3-section w3-teal w3-ripple" type="submit" style="text-align: center;"> DONE </button></form></p>

</div>
<script type="text/javascript">
	function submitForm(id){
		document.getElementById(id).submit();
	}
	function w3_open() {
  document.getElementById("mySidebar").style.display = "block";
}

function w3_close() {
  document.getElementById("mySidebar").style.display = "none";
}
</script>
  
</body>
</html> 
