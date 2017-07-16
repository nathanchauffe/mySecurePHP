<?php

// Get the full length header

require($_SERVER['DOCUMENT_ROOT'] . '/login/admin/sys/fl_header.php');

	?><head>
	
		
		<script type="text/javascript" language="javascript" >
			$(document).ready(function() {
				var dataTable = $('#profile-grid').DataTable( {
					"processing": true,
					"serverSide": true,
					"ajax":{
						url :"profile_data.php", // json datasource
						type: "post",  // method  , by default get
						error: function(){  // error handling
							$(".profile-grid-error").html("");
							$("#profile-grid").append('<tbody ><tr><th colspan="6">No data found in the server</th></tr></tbody>');
							$("#profile-grid_processing").css("display","none");
							
						}
					}
				} );
			} );
		</script>
		
	</head>
	<body><div class="panel panel-default">
		<div class="panel-heading"><h4>User Table</h4></div>
		<div class="table-responsive">
			<table id="profile-grid"  cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" width="100%">
					<thead>
						<tr>
							<th>ID</th>
							<th>Username</th>
							<th>First Name</th>
							<th>Last Name</th>
							<th>Join Date</th>
							<th>Join IP</th>
						</tr>
					</thead>
			</table>
		</div>
	
	</div>
<?php
//Get the footer.
require($_SERVER['DOCUMENT_ROOT'] . '/login/admin/sys/t_footer.html');

?>


   