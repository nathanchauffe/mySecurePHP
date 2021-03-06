<?php
include($_SERVER['DOCUMENT_ROOT'] . '/frame/include/dbco.inc');      


/* Database connection end */


// storing  request (ie, get/post) global array to a variable  
$requestData= $_REQUEST;


$columns = array( 
// datatable column index  => database column name
	0 =>'id', 
	1 => 'date',
	2=> 'username',
	3=> 'failed',
	4=> 'userip',
	5=> 'useragent'

);

// getting total number records without any search
$sql = "SELECT id, date, username, failed, userip, useragent  ";
$sql.=" FROM signlog";
$query=mysqli_query($con, $sql) or die("profile_data.php: get users");
$totalData = mysqli_num_rows($query);
$totalFiltered = $totalData;  // when there is no search parameter then total number rows = total number filtered rows.


$sql = "SELECT id, date, username, failed, userip, useragent ";
$sql.=" FROM signlog WHERE 1=1";
if( !empty($requestData['search']['value']) ) {   // if there is a search parameter, $requestData['search']['value'] contains search parameter
	$sql.=" AND ( id LIKE '".$requestData['search']['value']."%' ";    
	$sql.=" OR date LIKE '".$requestData['search']['value']."%' ";
	$sql.=" OR username LIKE '".$requestData['search']['value']."%' ";
	$sql.=" OR failed LIKE '".$requestData['search']['value']."%' ";
	$sql.=" OR userip LIKE '".$requestData['search']['value']."%' ";
	$sql.=" OR useragent LIKE '".$requestData['search']['value']."%' )";
}
$query=mysqli_query($con, $sql) or die("sign_log_data.php: get users");
$totalFiltered = mysqli_num_rows($query); // when there is a search parameter then we have to modify total number filtered rows as per search result. 
$sql.=" ORDER BY ". $columns[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir']."  LIMIT ".$requestData['start']." ,".$requestData['length']."   ";
/* $requestData['order'][0]['column'] contains colmun index, $requestData['order'][0]['dir'] contains order such as asc/desc  */	
$query=mysqli_query($con, $sql) or die("sign_log_data.php: get users");

$data = array();
while( $row=mysqli_fetch_array($query) ) {  // preparing an array
	$nestedData=array(); 

	$nestedData[] = $row["id"];
	$nestedData[] = $row["date"];
	$nestedData[] = $row["username"];
	$nestedData[] = $row["failed"];
	$nestedData[] = $row["userip"];
	$nestedData[] = $row["useragent"];
	$data[] = $nestedData;
}



$json_data = array(
			"draw"            => intval( $requestData['draw'] ),   // for every request/draw by clientside , they send a number as a parameter, when they recieve a response/data they first check the draw number, so we are sending same number in draw. 
			"recordsTotal"    => intval( $totalData ),  // total number of records
			"recordsFiltered" => intval( $totalFiltered ), // total number of records after searching, if there is no searching then totalFiltered = totalData
			"data"            => $data   // total data array
			);

echo json_encode($json_data);  // send data as json format

?>