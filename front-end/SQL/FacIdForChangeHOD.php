<html>
<head>
<style>
table

{
border-style:solid;
border-width:2px;
border-color:white;
}

</style>
</head>
<body bgcolor="#EEFDEF">

<?php

$db_connection = pg_connect("host=localhost dbname=leave_db user=postgres password=1109");

$dept=$_POST["department"];

$sql="SELECT DISTINCT f.id,f.first_name,f.last_name,n.department_name from faculty as f, normal_faculty_details as n where n.department_name = '$dept' AND f.id=n.faculty_id;";

$res=pg_query($db_connection,$sql);

$row=pg_fetch_array($res);

echo "Faculties in the department with their faculty ids : <br>";


echo "<table border='1'>


<tr>
<th> ID </th>
<th>Name</th>
<th>Department</th>
</tr>";

while ($row)
{
    echo "<tr>";
    echo "<td>" . $row['id'] . "</td>";
    echo "<td>" . $row['first_name'] ." ".   $row['last_name'] ."</td>";
    echo "<td>" . $row["department_name"] ."</td>";
    $row=pg_fetch_array($res);
}

?>

<html>
<body>

<h1>Select from the above departments</h1>
<form action="ChangeHOD.php" method="post">
<b>Faculty Id  : <b> <input type="integer" name="fac_id">
<br>
<input type="submit">
</form>

</body>
</html>