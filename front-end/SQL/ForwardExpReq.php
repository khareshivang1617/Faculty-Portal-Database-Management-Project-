<?php

session_start();
$req_id=$_SESSION["request_id"];
$comments=$_SESSION["comments"];

$db_connection = pg_connect("host=localhost dbname=leave_db user=postgres password=1109");

// to check if teh request id inputted belongs for his action only


$sql_fwd="SELECT forward_expenditure('$req_id','$comments')";
$res_fwd=pg_query($db_connection,$sql_fwd);
echo "Forwarded Successfully!!! <br>";
echo '<button><a href="http://localhost/LeavePortal/ExpReqAtLevel.php">Go Back</a>';


?>