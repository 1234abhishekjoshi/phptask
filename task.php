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
<header class="w3-container w3-teal" style="text-align: center;">
  <h1><a style="
  position: absolute;left:30px;top:20px;"><div></div>
<div></div>
<div></div></a>Parents Monitoring System</h1>
</header>

<div class="w3-container w3-half w3-margin-top" style="margin:auto;float:none;">

<form class="w3-container w3-card-4">
	<p>
<label>Name</label>
<input class="w3-input" type="text" id="taskDetail" style="width:90%" required placeholder="write a task"><button class="w3-button w3-section w3-teal w3-ripple" type="button" style="position: relative;float: right;bottom:53px;"  onclick="addTask()"> ADD </button></p>
<ul id="task">
	<?php 
		$q = 'SELECT * FROM tasks WHERE parentId='.$_SESSION['user_id'];
		$rs = $crud->getAllData($q);
		$task_id = '';
		foreach($rs as $key=>$value){
          		$task_id .= $value['id'].',';

	?>
	<li><span><?php echo $value['detail']; ?></span><span style="height: 50px;width: 50px;border-radius: 
	50%;background: red;color:white;padding: 5px;margin:5px;"><a onclick="removeTask(<?php echo $value['id'] ?>)" >-</a></span></li>
	<?php }?>
</ul>
<p><button class="w3-button w3-section w3-teal w3-ripple" type="button" style="float: right;" onclick="document.getElementById('id01').style.display='block'"> SEND </button></p>

</form>

</div>
<div id="id01" class="w3-modal">
    <div class="w3-modal-content w3-card-4 w3-animate-zoom" style="max-width:600px">
  
      <div class="w3-center"><br>
        <span onclick="document.getElementById('id01').style.display='none'" class="w3-button w3-xlarge w3-transparent w3-display-topright" title="Close Modal">×</span>
      </div>

      <form class="w3-container">
        <div class="w3-section">
          <select name="user" id="user" class="w3-input">
          	<option value="">Select users</option>
          	<?php 
          		$q ='SELECT * FROM users WHERE user_type=2';
          		$rs = $crud->getAllData($q);
          		
          	foreach($rs as $Key=>$value){ 
          	?>
          	<option  value="<?php echo $value['id'] ?>"><?php echo $value['name']; ?></option>
          	<?php }?>
          </select>
          <button type="button" class="w3-button w3-section w3-teal w3-rippl"  onclick="AssignToChildren()">Schedule a task</button>
        </div>
      </form>

      <!-- <div class="w3-container w3-border-top w3-padding-16 w3-light-grey">
        <button onclick="document.getElementById('id01').style.display='none'" type="button" class="w3-button w3-red">Cancel</button>
        <span class="w3-right w3-padding w3-hide-small">Forgot <a href="#">password?</a></span>
      </div> -->

    </div>
  </div>
  <script type="text/javascript">
  		

  	function addTask(){
  		var taskDetail = document.getElementById('taskDetail').value;
  		var node = document.createElement("LI"); 
  		var textnode = document.createTextNode(taskDetail); 
  		node.appendChild(textnode);                              // Append the text to <li>
		document.getElementById("task").appendChild(node);
		var xhttp = new XMLHttpRequest();
  		xhttp.open("POST", "add_task.php", true);
		xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		var user_id = '<?php echo $_SESSION['user_id']; ?>';
		xhttp.send("task="+taskDetail+"&userId="+user_id);
		window.location.reload();
  	}
  	function removeTask(id){
  		var xhttp = new XMLHttpRequest();
  		xhttp.open("POST", "remove_task.php", true);
		xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		xhttp.send("id="+id+"");
		window.location.reload();

  	}
  	function AssignToChildren(){
  		console.log('<?php echo $task_id; ?>');
  		var xhttp = new XMLHttpRequest();
  		xhttp.open("POST", "assign_task.php", true);
		xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		var task = '<?php echo $task_id; ?>';
		var children = document.getElementById('user').value;
		var user_id = '<?php echo $_SESSION['user_id']; ?>';
		xhttp.send("task_id="+task+"&parentId="+user_id+"&childrenId="+children);
		alert('task assign successfully');
		window.location.reload();
  	}
  </script>
</body>
</html> 
