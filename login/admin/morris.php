<?php

// Get the Header
require('sys/header.php');

$query = "SELECT HOUR(`date`) AS h, COUNT(*) AS number FROM userlog GROUP BY h";
$result = mysqli_query($con, $query);
$chart_data = '';
while($row = mysqli_fetch_array($result))
{
 $chart_data .= "{ hour:'".$row["h"]."', qty:".$row["number"]."}, ";
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

   <h3 align="center">Login Distribution Across 24 Hours</h3>   
   <br /><br />
   <div id="bchart"></div>
  </div>


<script>

Morris.Bar({
 element : 'bchart',
 data:[<?php echo $chart_data; ?>],
 xkey:'hour',
 ykeys:['qty'],
 labels:['qty'],
 hideHover:'auto',
 stacked:true
});
</script>
<?php
$query2 = "SELECT DATE_FORMAT( date, '%Y-%m-%d' ) AS the_date, COUNT( * ) AS count
FROM userlog
GROUP
BY the_date
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

   <h3 align="center">Login Distribution YTD</h3>   
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

// Get the recent login panel.
require('sys/loginpanel.php');


// Get the footer.
require('sys/footer.php');
          
?>
           	
	