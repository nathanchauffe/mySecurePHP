</div>
		      
	
	
	<div class="col-lg-4">
				<div class="panel panel-default">
					<div class="panel-heading"> Most Recent Logins</div>
						
                        <!-- /.panel-heading -->
                        		
                        		<div class="list-group">
                        		
             <?php 
                     $qry_useract = "SELECT username, id, action, date, Time(date) AS time FROM userlog WHERE action = 'LOGIN' ORDER BY date DESC LIMIT 30"; 
                        		$resultqy = mysqli_query($con, $qry_useract); 
                        		
while ($row = mysqli_fetch_array($resultqy,MYSQLI_ASSOC)){
                        	echo "
				<a class='list-group-item' href='logdet.php?id={$row['id']}'>{$row['username']}<span class='pull-right text-muted small'><em>{$row['time']}</em> </span> </a>
			   
			  ";
			  }
			 echo " </div> "; ?>
                        		
                            <a href="/login/admin/tables/user_log.php" class="btn btn-default btn-block">View All Alerts</a>
                        			</div>
                        <!-- /.panel-body -->
                    			</div>