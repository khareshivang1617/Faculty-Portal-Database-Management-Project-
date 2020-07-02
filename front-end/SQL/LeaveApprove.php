<?php

session_start();
$fac_id=$_SESSION["fac_id"];
$sender_id=$_SESSION["sender_id"];

$db_connection = pg_connect("host=localhost dbname=leave_db user=postgres password=1109");

$sql_approve="SELECT approve_leave('$sender_id','$fac_id');";
$res_approve=pg_query($db_connection,$sql_approve);

echo "Leave approved successfully!!! <br>";
echo '<button><a href="http://localhost/LeavePortal/PendingLeavesAtLevel.php">Go Back</a>';


?>