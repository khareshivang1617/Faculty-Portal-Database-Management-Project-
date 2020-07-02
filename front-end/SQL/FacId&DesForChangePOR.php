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

$sql="SELECT  f.id, f.first_name, f.last_name, c.designation FROM faculty AS f, cross_cutting_faculty_details AS c WHERE f.id = c.faculty_id;";
$res=pg_query($db_connection,$sql);
$row=pg_fetch_array($res);



echo "<table border='1'>

<tr>
<th> ID </th>
<th>Name</th>
<th>Designation</th>
</tr>";

while ($row)
{
    echo "<tr>";
    echo "<td>" . $row['id'] . "</td>";
    echo "<td>" . $row['first_name'] ." ".   $row['last_name'] ."</td>";
    
    if ($row['designation'])
        echo "<td>" . $row['designation'] . "</td>";
    
    else
    echo "<td>" . "N" . "</td>";
            
    echo "</tr>";

    $row=pg_fetch_array($res);
}
?>



<html>
<body>

<h1>Enter the faculty Id and Designation to update</h1>
<form action="ChangePOR.php" method="post">
<b>Faculty Id : <b> <input type="integer" name="fac_id">
<b>Designation : <b> <input type="text" name="designation">
<br>
<input type="submit">
</form>

</body>
</html>