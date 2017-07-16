<?php

// Get the Header
require('sys/header.php');

$username = $_GET['user'];

if ($_POST[all]){
$username = $_POST['username'];
$query = "SELECT * FROM userlog WHERE username = '$username' ";
$result = mysqli_query($con, $query);

		
echo "<h4>User Login History</h4><table class='gridTable' style='width:100%'>
	<tr><th>Date</th><th><div align='center'>Browser</div></th><th><div align='center'>IP</div></th></tr>";



while ($row = mysqli_fetch_array($result,MYSQLI_ASSOC))
{
		echo "<tr>
			<td style='width:10%;'>{$row['date']}</td>
			
			 <td><div align='center'>   {$row['useragent']}</div></td>
			  <td><a href='https://freegeoip.net/?q={$row['userip']}'>{$row['userip']}</td></tr> ";
			 
		
}	
mysqli_free_result($result);
echo "</table>";



} else {

$query2 = "SELECT DATE_FORMAT( date, '%Y-%m-%d' ) AS the_date, COUNT( * ) AS count FROM userlog WHERE username ='$username' GROUP BY the_date";
$result2 = mysqli_query($con, $query2);
$chart_data2 = '';
while($row = mysqli_fetch_array($result2))
{
 $chart_data2 .= "{ date:'".$row["the_date"]."', qty:".$row["count"]."}, ";
}

 ?>
 
  <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
  <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
  <script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
  <script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>
  
 </head>
 <body>
  <br /><br />
  <div class="container" style="width:100%;">

   <h3 align="center">Login Distribution YTD</h3>   
   <br /><br />
   <div id="lchart"></div>
  </div>


<script>

Morris.Line({
 element : 'lchart',
 data:[<?php echo $chart_data2; ?>],
 xkey:'date',
 ykeys:['qty'],
 labels:['qty'],
 hideHover:'auto',
 stacked:true
});
</script>
<?php
$query = "SELECT * FROM userlog WHERE username = '$username' LIMIT 10";
$result = mysqli_query($con, $query);

		
echo "<h4>User Login History</h4><table class='gridTable' style='width:100%'>
	<tr><th>Date</th><th><div align='center'>Browser</div></th><th><div align='center'>IP</div></th></tr>";



while ($row = mysqli_fetch_array($result,MYSQLI_ASSOC))
{
		echo "<tr>
			<td style='width:10%;'>{$row['date']}</td>
			
			 <td><div align='center'>   {$row['useragent']}</div></td>
			  <td><a href='https://freegeoip.net/?q={$row['userip']}'>{$row['userip']}</td></tr> ";
			 
		
}	
mysqli_free_result($result);
echo "</table>";

echo "<div class='panel'><form action='$_SERVER[PHP_SELF]' method='POST'><input type='hidden' name='username' value='$username'/>
	<br><input type='hidden' name='all' value='all'/><input type='SUBMIT' class='btn btn-default btn-block' value='Show All'></form> </div>";

}





?>

</div>
	<div class="col-lg-4">
	   <h4> Update User Profile</h4>
	<?php
if ($_POST[oldname]){

$id = $_POST['id'];
$username = $_POST['username'];
$firstname = $_POST['firstname'];
$lastname = $_POST['lastname'];
$joindate = $_POST['joindate'];
$joinagent = $_POST['joinagent'];
$joinip = $_POST['joinip'];
$oldname = $_POST['oldname'];
$user_id = $_POST['id'];
$status = $_POST['status'];
$sql = " UPDATE prof SET joindate = '$joindate', username ='$username', firstname = '$firstname', lastname = '$lastname', joinip = '$joinip', joinagent ='$joinagent', status ='$status' WHERE  id='$id' ";  



if ($con->query($sql) === TRUE) {
    echo "<br>Profile updated successfully<br>";
 } else { echo "Profile name already in use";
 }

$sql2 = " UPDATE user SET username ='$username' WHERE username = '$oldname'";
if ($con->query($sql2) === TRUE) {
   echo "<br>User updated successfully<br>";
    } else {echo "Profile name already in use";
    }
$sql3 = "UPDATE userlog SET username='$username' WHERE username ='$oldname'";
if ($con->query($sql3) === TRUE) {
   echo "<br>Userlogs updated successfully<br>";
    }
}
 else {




$query = "SELECT * FROM prof WHERE username = '$username'";

$result = mysqli_query($con, $query);


while ($row = mysqli_fetch_array($result,MYSQLI_ASSOC))
{
		echo "<div class='panel-body'><form action=$_SERVER[PHP_SELF] method=POST>
			 <input type='hidden' name='oldname' value='{$row['username']}'/>
			  <input type='hidden' name='id' value='{$row['id']}'/>
			 <div class='form-group'> <h4 class='panel-title'>Username: </h4> <input class='form-control' type='text' name='username' value='{$row['username']}'/></div>
	 <div class='form-group'> <h4 class='panel-title'>First Name:</h4> <input class='form-control' type='text' name='firstname' value='{$row['firstname']}'/>  </div>
			 <div class='form-group'> <h4 class='panel-title'>Last Name: </h4><input  class='form-control'type='text' name='lastname' value='{$row['lastname']}'/> </div>
			<div class='form-group'> <h4 class='panel-title'>Join Date:</h4> <input  class='form-control' type='text' name='joindate' value='{$row['joindate']}'/> </div>
			<div class='form-group'> <h4 class='panel-title'>Join Agent:</h4> <input class='form-control' type='text' name='joinagent' value='{$row['joinagent']}'/></div>
			<div class='form-group'> <h4 class='panel-title'>Join IP:</h4> <input  class='form-control' type='text' name='joinip' value='{$row['joinip']}'/></div>
			<input type='hidden' name='status' value='updated'/>
	<input type='submit' name='SUBMIT'  class='btn btn-success btn-block' value='Update Profile Info'/></form></div>
	
	
	
	
	
	
	<div class='panel-body'><form action=$_SERVER[PHP_SELF] method=POST name='adform'>
			 <input type='hidden' name='oldname' value='{$row['username']}'/>
			  <input type='hidden' name='id' value='{$row['id']}'/>
			 <div class='form-group'>  <input class='hidden' type='text' name='username' value='{$row['username']}'/></div>
	 <div class='form-group'> <input class='hidden' type='text' name='firstname' value='{$row['firstname']}'/>  </div>
			 <div class='form-group'><input  class='hidden'type='text' name='lastname' value='{$row['lastname']}'/> </div>
			<div class='form-group'>  <input  class='hidden' type='text' name='joindate' value='{$row['joindate']}'/> </div>
			<div class='form-group'>  <input class='hidden' type='text' name='joinagent' value='{$row['joinagent']}'/></div>
			<div class='form-group'> <h4 class='panel-title'>Make an Admin?</h4> <input  class='hidden' type='text' name='joinip' value='{$row['joinip']}'/></div>
			<input type='hidden' name='status' value='ADMIN'/>
	<input type='submit' name='SUBMIT'  class='btn btn-warning btn-block' value='Yes, Im sure.'/></form></div>
	
	
	
	<div class='panel-body'><form action='sys/delete.php' method=POST name='adform'>
			
			  <input type='hidden' name='id' value='{$row['id']}'/>
			 <div class='form-group'>   <h4 class='panel-title'>Delete User?</h4> <input class='hidden' type='text' name='username' value='{$row['username']}'/></div>
	
			<input type='hidden' name='status' value='DELETE'/>
	<input type='submit' name='SUBMIT'  class='btn btn-danger btn-block' value='Yes, Im sure.'/></form></div>
	
	";

		$username = "{$row['username']}";	 
}	
mysqli_free_result($result);
}

include('sys/footer.php');

?>
