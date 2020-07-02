<?php

$comments=$_POST["comments"];
$from_date=$_POST["from_date"];
$till_date=$_POST["till_date"];

$db_connection = pg_connect("host=localhost dbname=leave_db user=postgres password=1109");

session_start();
$fac_id=$_SESSION["fac_id"];

$sql_leave="SELECT request_leave('$fac_id','$from_date','$till_date','$comments')";
$res_leave=pg_query($db_connection,$sql_leave); 
//$row=pg_fetch_row()
//echo
if ($res_leave)
    echo "Leave Request Initiated";

    echo '<button><a href="http://localhost/LeavePortal/GetLoginDetails.php">Go Back</a>';
?>