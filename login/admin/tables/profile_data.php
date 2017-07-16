<?php
include($_SERVER['DOCUMENT_ROOT'] . '/frame/include/dbco.inc');      


/* Database connection end */


// storing  request (ie, get/post) global array to a variable  
$requestData= $_REQUEST;


$columns = array( 
// datatable column index  => database column name
	0 =>'id', 
	1 => 'username',
	2=> 'firstname',
	3=> 'lastname',
	4=> 'joindate',
	5=> 'joinip'

);

// getting total number records without any search
$sql = "SELECT id, username, firstname, lastname, joindate, joinip ";
$sql.=" FROM prof";
$query=mysqli_query($con, $sql) or die("profile_data.php: get users");
$totalData = mysqli_num_rows($query);
$totalFiltered = $totalData;  // when there is no search parameter then total number rows = total number filtered rows.


$sql = "SELECT id, username, firstname, lastname, joindate, joinip ";
$sql.=" FROM prof WHERE 1=1";
if( !empty($requestData['search']['value']) ) {   // if there is a search parameter, $requestData['search']['value'] contains search parameter
	$sql.=" AND ( id LIKE '".$requestData['search']['value']."%' ";    
	$sql.=" OR username LIKE '".$requestData['search']['value']."%' ";
	$sql.=" OR firstname LIKE '".$requestData['search']['value']."%' ";
	$sql.=" OR lastname LIKE '".$requestData['search']['value']."%' ";
	$sql.=" OR joindate LIKE '".$requestData['search']['value']."%' ";
	$sql.=" OR joinip LIKE '".$requestData['search']['value']."%' )";
}
$query=mysqli_query($con, $sql) or die("profile_data.php: get users");
$totalFiltered = mysqli_num_rows($query); // when there is a search parameter then we have to modify total number filtered rows as per search result. 
$sql.=" ORDER BY ". $columns[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir']."  LIMIT ".$requestData['start']." ,".$requestData['length']."   ";
/* $requestData['order'][0]['column'] contains colmun index, $requestData['order'][0]['dir'] contains order such as asc/desc  */	
$query=mysqli_query($con, $sql) or die("profile_data.php: get users");

$data = array();
while( $row=mysqli_fetch_array($query) ) {  // preparing an array
	$nestedData=array(); 

	$nestedData[] = $row["id"];
	$nestedData[] = $row["username"];
	$nestedData[] = $row["firstname"];
	$nestedData[] = $row["lastname"];
	$nestedData[] = $row["joindate"];
	$nestedData[] = $row["joinip"];
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