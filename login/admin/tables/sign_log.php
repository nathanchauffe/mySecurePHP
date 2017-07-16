<?php

// Get the full length header

require($_SERVER['DOCUMENT_ROOT'] . '/login/admin/sys/fl_header.php');

	?><head>
	
		
		<script type="text/javascript" language="javascript" >
			$(document).ready(function() {
				var dataTable = $('#sign_log-grid').DataTable( {
					"processing": true,
					"serverSide": true,
					"order": [[ 0, "desc" ]],
					"ajax":{
						url :"sign_log_data.php", // json datasource
						type: "post",  // method  , by default get
						error: function(){  // error handling
							$(".sign_log-grid-error").html("");
							$("#sign_log-grid").append('<tbody ><tr><th colspan="6">No data found in the server</th></tr></tbody>');
							$("#sign_log-grid_processing").css("display","none");
							
						}
					}
				} );
			} );
		</script>
		
	</head>
	<body><div class="panel panel-default">
		<div class="panel-heading"><h4>Failed Sign-In Log</h4></div>
		<div class="table-responsive">
			<table id="sign_log-grid"  cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" width="100%">
					<thead>
						<tr>
							<th>ID</th>
							<th style='max-width:5%;'>Date</th>
							<th>Username</th>
							<th>Sign-In</th>
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


   