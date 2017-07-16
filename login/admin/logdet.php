<?php
// Get the header,

require('sys/header.php');
?>

<?php
$id = $_GET['id'];
	
$qry_logdet = "SELECT DATE_FORMAT(date,'%H:%i:%s') AS ts, username, userip, useragent FROM userlog WHERE id ='$id'";
$result_ld = mysqli_query($con, $qry_logdet);
while ($row = mysqli_fetch_array($result_ld, MYSQLI_ASSOC)){
	  
echo "<table class='gridTable' style='width:100%;'><tr><th>Time</th><th>Username</th><th>User IP</th></tr>";
echo "<tr><td style='width:20%;'>{$row['ts']}</td><td><a href='details.php?user={$row['username']}'>{$row['username']}</a></td><td><a href='https://freegeoip.net/?q={$row['userip']}'>{$row['userip']}</td><td> </td>

</tr></table>";
$username = "{$row['username']}";	
$useragent = "{$row['useragent']}";	
$userip ="{$row['userip']}";
}	

	
	mysqli_free_result($result);
echo "<h5><b>User Broswer</b><br><br>$useragent</h5>";



	
$pquery = "SELECT useragent, COUNT(*) AS number FROM userlog WHERE userip = '$userip' GROUP BY useragent";
$presult = mysqli_query($con, $pquery);

?>

		<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
		<script type="text/javascript">
		google.charts.load('current', {'packages':['corechart']});
		google.charts.setOnLoadCallback(drawChart);
		function drawChart()
		{
			var data = google.visualization.arrayToDataTable([
					['Useragent', 'Number'],
					<?php
					while($row = mysqli_fetch_array($presult))
					{	
						echo "['".$row["useragent"]."', ".$row["number"]."],";
					}
					?>
				]);
			var options = {
				title: 'Browsers from this IP'
				};
			var chart = new google.visualization.PieChart(document.getElementById('pieChart'));
			chart.draw(data, options);
		}
		</script>
	
		<div style="width:100%;">
			
			<br />
			<div id='pieChart'></div>
		</div>


	
<?php
$query2 = "SELECT date_FORMAT( date, '%Y-%m-%d' ) AS the_date, COUNT( * ) AS count
FROM userlog WHERE userip = '$userip' GROUP BY the_date
";
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

   <h3 align="center">Login activity from this IP</h3>   
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

//Get the recent login panel.
require('sys/loginpanel.php');

//Get the footer.
require('sys/footer.php');
?>