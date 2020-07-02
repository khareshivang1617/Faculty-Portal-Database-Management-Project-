<?php

$db_connection = pg_connect("host=localhost dbname=leave_db user=postgres password=1109");

$sql="SELECT * FROM faculty;";
$res=pg_query($db_connection,$sql);
$row=pg_fetch_array($res);

echo "List of all the faculties with their faculty ids : <br>";

while($row)
{
    echo $row['id'];
    echo " : ";
    echo $row['first_name'];
    echo $row['last_name']; 
    echo "<br>";
    $row=pg_fetch_array($res);
}

?>

<html>
<body>

<h1>Type in the Faculty ID to fire the Faculty</h1>
<form action="FireFaculty.php" method="post">
<b>Faculty Id : <b> <input type="integer" name="fac_id">
<br>
<input type="submit">
</form>

</body>
</html>