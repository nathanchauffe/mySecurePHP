<?php

// Get the Header
require('sys/header.php');
?>



<div class='panel panel-default'>
			<div class='panel-heading'>All Users</div> 

			  
			

	<div class='list-group'>
	<?php
	$query = "SELECT * FROM prof";

$result = mysqli_query($con, $query);
while ($row = mysqli_fetch_array($result,MYSQLI_ASSOC))
{
	echo "
		
		
			
 
<a class='list-group-item' href='details.php?user={$row['username']}'>{$row['username']}<span class='pull-right text-muted small'><em>{$row['joindate']}</em> </span> </a> ";
			
}


?>
</div>
</div>



<?php

// Get the recent login panel.
require('sys/loginpanel.php');


// Get the footer.
require('sys/footer.php');
          
?>


	