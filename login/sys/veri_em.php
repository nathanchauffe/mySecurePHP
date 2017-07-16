<?php

// Inialize session.
session_start();

//Get the blank header.
require('bl_head.html');

// Include secure common files.
require($_SERVER['DOCUMENT_ROOT'] . '/frame/coms.php');

// Grab text fields from html form on previous page.
$id = $_POST['id'];
$username = $_POST['username'];



// Verify the hash.
$sql = "SELECT * FROM userlog WHERE username = '$username' AND hash = '$id' AND action = 'VEREM'";

if ($result=mysqli_query($con,$sql)){
// Return the number of rows in result set
  $rowcount=mysqli_num_rows($result);
  
}

if(mysqli_num_rows($result)==1) {
$sql2 = " INSERT INTO userlog (username, userip, useragent, action )

	 			           VALUES

	   			         ('$username', '$user_ip', '$user_agent', 'VERIFIED' )";  

if ($con->query($sql2) === TRUE) {
    echo "

    <title>Email Verified</title>
	<div align='center'>
	
			
				<div style='padding-top:30px'><h2 >Success</h2></div>   
				
					<div style='padding-top:10px'><br>Your email was sucessfully verified.<br><br>You can try and <a href='/login/index.php'>login</a> now.</div>
					</div><br>
		
 ";
 
 require('footer.html');
 
} else {
    echo "Error updating record: " . $con->error;
}

} else {
// Free result set
  mysqli_free_result($result);
  
echo "<title>No Match Found</title>


<div align='center'>
	
		
			<div style='padding-top:30px'><h2 >No Match Found</h2></div>   
			<br>
				<div style='padding-top:10px'>No match exists for username $username.<br><br><br></div>
			
		</div>


";

 require('footer.html');

}

?> 
<html>
</div>
    <div class="col-xs-1 col-sm-2 col-md-4"></div>
  </div>
</div></html>
