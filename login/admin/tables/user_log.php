<?php

// Get the full length header

require($_SERVER['DOCUMENT_ROOT'] . '/login/admin/sys/fl_header.php');

	?><head>
	
		
		<script type="text/javascript" language="javascript" >
			$(document).ready(function() {
				var dataTable = $('#user_log-grid').DataTable( {
					"processing": true,
					"serverSide": true,
					"order": [[ 0, "desc" ]],
					"ajax":{
						url :"user_log_data.php", // json datasource
						type: "post",  // method  , by default get
						error: function(){  // error handling
							$(".user_log-grid-error").html("");
							$("#user_log-grid").append('<tbody ><tr><th colspan="6">No data found in the server</th></tr></tbody>');
							$("#user_log-grid_processing").css("display","none");
							
						}
					}
				} );
			} );
		</script>
		
	</head>
	<body><div class="panel panel-default">
		<div class="panel-heading"><h4>User Log Table</h4></div>
		<div class="table-responsive">
			<table id="user_log-grid"  cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" width="100%">
					<thead>
						<tr>
							<th>ID</th>
							<th style='max-width:5%;'>Date</th>
							<th>Username</th>
							<th>Action</th>
							<th>User IP</th>
							<th style='max-width:35%;'>User Agent</th>
						</tr>
					</thead>
			</table>
		</div>
	
	</div>
<?php
//Get the footer.
require($_SERVER['DOCUMENT_ROOT'] . '/login/admin/sys/footer.php');

?>


   