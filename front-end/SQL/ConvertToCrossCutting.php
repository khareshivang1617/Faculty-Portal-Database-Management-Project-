<?php

$fac_id=$_POST["fac_id"];
$desig=$_POST["designation"];

$db_connection = pg_connect("host=localhost dbname=leave_db user=postgres password=1109");

$sql_convert="SELECT normal_to_cross_cutting('$fac_id','$desig');";
$res_convert=pg_query($db_connection,$sql_convert);

echo "Faculty Converted Successfully!!!";

?>