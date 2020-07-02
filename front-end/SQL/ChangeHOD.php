<?php

$db_connection = pg_connect("host=localhost dbname=leave_db user=postgres password=1109");
$fac_id=$_POST["fac_id"];

$sql="SELECT change_hod('$fac_id');";
$res=pg_query($db_connection,$sql);

echo "!!! <br>";
echo '<a href="http://localhost/LeavePortal/AdminsPage.php">Go Back</a>';

?>