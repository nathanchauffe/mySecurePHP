<?php

//Get the header.
require('sys/header.php');


	$query = "SELECT HOUR(date) AS time, action, COUNT(*) AS number FROM userlog WHERE DATE(date) = CURDATE() GROUP BY time";
$result = mysqli_query($con, $query);
?>
<html><h3 align="center">Logins Today</h3>

		<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
		<script type="text/javascript">
		google.charts.load('current', {'packages':['corechart']});
		google.charts.setOnLoadCallback(drawChart);
		function drawChart()
		{
			var data = google.visualization.arrayToDataTable([
					['time', 'Number'],
					<?php
					while($row = mysqli_fetch_array($result))
					{	
						echo "['".$row["time"]."', ".$row["number"]."],";
					}
					?>
				]);
			var options = {
          				title: 'Login Distrubution ',
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
$pquery = "SELECT useragent, COUNT(*) AS number FROM userlog WHERE DATE(date) = CURDATE() GROUP BY useragent";
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
			
			<br />
			<div id='pieChart'></div>
		</div>


	
<?php
$query2 = "SELECT DATE_FORMAT( date, '%Y-%m-%d' ) AS the_date, COUNT( * ) AS count
FROM userlog GROUP BY the_date
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

   <h3 align="center">User Login Distribution YTD</h3>   
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
 







	
			

<div class='panel panel-default'>
<div class='panel-heading'>Logins Today</div> 
<div class='list-group'>
<?php
	$query = "SELECT id, username, TIME(date) AS date FROM userlog WHERE action = 'LOGIN' AND DATE(date) = CURDATE()";

$result = mysqli_query($con, $query);
while ($row = mysqli_fetch_array($result,MYSQLI_ASSOC))
{
	echo "
 
<a class='list-group-item' href='logdet.php?id={$row['id']}'>{$row['username']}<span class='pull-right text-muted small'><em>{$row['date']}</em> </span> </a>";
			
}
?>
</div></div>
<?php
//Get the recent login panel.
require('sys/loginpanel.php');

//Get the footer.
require('sys/footer.php');
?>