<?php

$db_connection = pg_connect("host=localhost dbname=leave_db user=postgres password=1109");

//The query to list all the cross_cutting faculties data

?>

<html>
<body>

<h1>Type in the Faculty ID and Department to Convert the Faculty</h1>
<form action="ConvertToNormal.php" method="post">
<b>Faculty Id : <b> <input type="integer" name="fac_id">
<b>Department : <b> <input type="text" name="department">
<br>
<input type="submit">
</form>

</body>
</html>
