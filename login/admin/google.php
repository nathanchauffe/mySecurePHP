<?php

// Get the Header
require('sys/header.php');

$query = "SELECT HOUR(`date`) AS h, COUNT(*) AS number FROM userlog GROUP BY h";
$result = mysqli_query($con, $query);
?>
<html>

		<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
		<script type="text/javascript">
		google.charts.load('current', {'packages':['corechart']});
		google.charts.setOnLoadCallback(drawChart);
		function drawChart()
		{
			var data = google.visualization.arrayToDataTable([
					['Hour', 'Number'],
					<?php
					while($row = mysqli_fetch_array($result))
					{	
						echo "['".$row["h"]."', ".$row["number"]."],";
					}
					?>
				]);
			var options = {
          				title: 'Login Distrubution Across 24 Hours',
       					legend: { position: 'bottom' },
       					
        };

			var chart = new google.visualization.LineChart(document.getElementById('chart_div'));
			chart.draw(data, options);
		}
		</script>


		<div >
			
			
			<div id="chart_div" style="width:100%"></div>
		</div>
 <?php
$pquery = "SELECT useragent, COUNT(*) AS number FROM userlog GROUP BY useragent";
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
				title: 'Browsers'
				};
			var chart = new google.visualization.PieChart(document.getElementById('pieChart'));
			chart.draw(data, options);
		}
		</script>
	
		<div style="width:100%;">
			<h3 align="center">User Browsers</h3>
			<br />
			<div id='pieChart'></div>
		</div>








	

		      
	
	
	
<?php

// Get the recent login panel.
require('sys/loginpanel.php');


// Get the footer.
require('sys/footer.php');
          
?>

