<?php

$fac_id=$_POST["fac_id"];
$desig=$_POST["designation"];

$db_connection = pg_connect("host=localhost dbname=leave_db user=postgres password=1109");

$sql_change_por="SELECT change_por('$fac_id','$desig');";
$res_change_por=pg_query($db_connection,$sql_change_por);

echo "!!! <br>";
echo '<a href="http://localhost/LeavePortal/AdminsPage.php">To go back!!!</a>'; 

?>