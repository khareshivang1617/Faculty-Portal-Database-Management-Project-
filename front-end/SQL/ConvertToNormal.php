<?php

$fac_id=$_POST["fac_id"];
$dept=$_POST["department"];

$db_connection = pg_connect("host=localhost dbname=leave_db user=postgres password=1109");

$sql_convert="SELECT cross_cutting_to_normal('$fac_id','$dept');";
$res_convert=pg_query($db_connection,$sql_convert);

echo "Faculty Converted Successfully!!! <br>";

?>