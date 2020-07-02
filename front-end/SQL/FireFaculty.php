<?php

$fac_id=$_POST['fac_id'];

$db_connection = pg_connect("host=localhost dbname=leave_db user=postgres password=1109");

    $sql_fire="SELECT remove_faculty('$fac_id')";
$res_fire=pg_query($db_connection,$sql_fire);

echo "Faculty Fired Successfully!!! <br>";
echo '<a href="http://localhost/LeavePortal/AdminsPage.php">Go Back</a>';

?>