<?php

session_start();
$fac_id=$_SESSION["fac_id"];
$designation=$_SESSION["designation"];
$sender_id=$_SESSION["sender_id"];
$comments=$_SESSION["comments"];

$db_connection = pg_connect("host=localhost dbname=leave_db user=postgres password=1109");

$sql_fwd="SELECT send_back('$sender_id','$designation','$comments')";
$res_fwd=pg_query($db_connection,$sql_fwd);

echo "Send Back Done!!! <br>";
echo '<button><a href="http://localhost/LeavePortal/PendingLeavesAtLevel.php">Go Back</a>';


?>