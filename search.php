<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8"); 
require('includes/config.inc.php');

$q = $_GET['q'];
$dep = $_GET['dep'];
$status = $_GET['status'];
$name = $_GET['name'];

$dep = mysqli_real_escape_string($connecDB,$dep);
$status = mysqli_real_escape_string($connecDB,$status);
$name = mysqli_real_escape_string($connecDB,$name);

/*$result = mysqli_query($connecDB,"SELECT * FROM  people where status ='".$status."' and name like '%".$name."%' and  status like '%".$status."%' ORDER BY id ");*/
$result = mysqli_query($connecDB,"SELECT * FROM  people where name like '%".$name."%' ORDER BY id ");

if(mysqli_num_rows($result)>0)
	{
	$data = "[";
	while($row = mysqli_fetch_array($result))
		{
		if ($data != "[") {$data .= ",";}
		$data .= '{"Name":"'  . $row["name"] . '",';
		$data .= '"Address":"'. $row["address"]     . '"}'; 
		}
	$data .= "]";	
	}
else{
	$data = '';
	}

echo ($data);


?>