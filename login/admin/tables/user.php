<?php

// Get the full length header

require($_SERVER['DOCUMENT_ROOT'] . '/login/admin/sys/fl_header.php');

	?><head>
	
		
		<script type="text/javascript" language="javascript" >
			$(document).ready(function() {
				var dataTable = $('#user-grid').DataTable( {
					"processing": true,
					"serverSide": true,
					"ajax":{
						url :"user_data.php", // json datasource
						type: "post",  // method  , by default get
						error: function(){  // error handling
							$(".user-grid-error").html("");
							$("#user-grid").append('<tbody ><tr><th colspan="3">No data found in the server</th></tr></tbody>');
							$("#user-grid_processing").css("display","none");
							
						}
					}
				} );
			} );
		</script>
		
	</head>
	<body><div class="panel panel-default">
		<div class="panel-heading"><h4>User Table</h4></div>
		<div class="table-responsive">
			<table id="user-grid"  cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" width="100%">
					<thead>
						<tr>
							<th>ID</th>
							<th>Username</th>
							<th>Password (b_crypt)</th>
						</tr>
					</thead>
			</table>
		</div>
	
	</div>
<?php
//Get the footer.

require($_SERVER['DOCUMENT_ROOT'] . '/login/admin/sys/footer.php');

?>


   