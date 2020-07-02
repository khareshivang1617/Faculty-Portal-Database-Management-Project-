<?php

$db_connection = pg_connect("host=localhost dbname=leave_db user=postgres password=1109");

//SAME QUERY AS WAS USED TO DISPLAY NORMAL FACULTIES

?>


<html>
<body>

<h1>Type in the Faculty ID and Designation to Convert the Faculty</h1>
<form action="ConvertToCrossCutting.php" method="post">
<b>Faculty Id : <b> <input type="integer" name="fac_id">
<b>Designation : <b> <input type="text" name="designation">
<br>
<input type="submit">
</form>

</body>
</html>
