<html><title>Create Profile</title>
<?php

// Secure this page.
require($_SERVER['DOCUMENT_ROOT'] . '/login/sys/secure_me.php');
require($_SERVER['DOCUMENT_ROOT'] . '/login/sys/s_head.php');

$user_id = "$user_current";
$query = "SELECT * FROM userlog WHERE username = '$user_id' ORDER BY date ASC LIMIT 1";
$result = mysqli_query($con, $query);

while ($row = mysqli_fetch_array($result,MYSQLI_ASSOC))
{
$join_date = "{$row['date']}";
$join_agent = "{$row['useragent']}";
$join_ip = "{$row['userip']}";
			 
		
}	
mysqli_free_result($result);


if ($_POST['status']){



$firstname = mysqli_real_escape_string($con, $_POST['firstname']);
$lastname = mysqli_real_escape_string($con, $_POST['lastname']);
$joindate = mysqli_real_escape_string($con, $_POST['joindate']);
$joinagent = mysqli_real_escape_string($con, $_POST['joinagent']);
$joinip = mysqli_real_escape_string($con, $_POST['joinip']);
$username = mysqli_real_escape_string($con, $_POST['username']);
$status = mysqli_real_escape_string($con, $_POST['status']);
$qry_cpro = "INSERT INTO prof (username, firstname, lastname, joinip, joinagent, status, joindate)

	            VALUES

	            ('$username','$firstname','$lastname', '$joinip', '$joinagent', '$status', '$joindate')";



// Create a new profile
$result = mysqli_query($con, $qry_cpro); 


if ($result) {
    echo "<br><br><div align='center'>Profile created successfully.</div>";
 } 

	} else {
	echo "
<div class='container' style='padding-top:30px;'>
        <div class='row'>
            <div class='col-md-4 col-md-offset-4'>
                <div class='login-panel panel panel-default'>
                    <div class='panel-heading'>
                        <h3 class='panel-title'>New Profile</h3>
                    </div>
                    <div class='panel-body'>
                    <div style='padding-bottom:20px'>Please fill out the fields below to create a profile.</div>
                        <form role='form' method='POST' action='$_SERVER[PHP_SELF]'>
                            <fieldset>
                                <div class='form-group'>
                            
                                	 <input type='hidden' name='status' value='new'/>
                                    	 <input type='hidden' name='joindate' value='$join_date'/>
                                    	 <input type='hidden' name='joinagent' value='$join_agent'/>
                                    	 <input type='hidden' name='joinip' value='$join_ip'/>
                                    	 <input type='hidden' name='username' value='$user_id'/>
					
					<input class='form-control'  type='text' placeholder='First Name' name='firstname'/>
                                </div>
                       <div class='form-group'>
                                
					
					
                	<input class='form-control'  type='text' placeholder='Last Name' name='lastname'/>
                                </div>
  
                                <div class='checkbox'>
                                	 
                                </div>
                                <!-- Change this to a button or input when using this as a form -->
                               <input type='submit' class='btn btn-lg btn-success btn-block' />
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

				

";
	
}
include($_SERVER['DOCUMENT_ROOT'] . '/login/sys/footer.html');

?>