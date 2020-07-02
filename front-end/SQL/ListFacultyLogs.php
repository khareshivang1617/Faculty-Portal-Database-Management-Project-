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

$sql="SELECT id, first_name, last_name, gender, joining_date, leaving_date FROM faculty;";
$res=pg_query($db_connection,$sql);
$row=pg_fetch_array($res);

//echo "first_name last_name gender joining_date<br>";
echo "The Faculty Logs are : "; 

echo "<table border='1'>

<tr>
<th> ID </th>
<th>Name</th>
<th>Designation</th>
<th>From-To</th>

</tr>";

while($row)
{
    echo "<tr>";
    echo "<td>" . $row['id'] . "</td>";
    echo "<td>" . $row['first_name'] ." ".   $row['last_name'] ."</td>";
    echo "<td>" . $row['gender'] . "</td>";

    if ($row['leaving_date'])
        echo "<td>" . $row['joining_date'] . " - ".$row['leaving_date'] . "</td>";   

    else
        echo "<td>" . $row['joining_date'] . " - CURRENT" . "</td>";   


    echo "</tr>";
    $row=pg_fetch_array($res);
} 

echo "<br><br>";
echo '<button><a href="http://localhost/LeavePortal/GetLoginDetails.php">Go Back</a>';

?>

</body>
</html>