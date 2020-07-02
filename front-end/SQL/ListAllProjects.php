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


echo "<table border='1'>

<tr>
<th>Project ID </th>
<th>Project Name</th>
<th>Starting Date</th>
<th>Ending Date</th>
<th>Main PI</th>
<th>Name</th>

</tr>";

echo "<br><br><b>Projects : </b>";


$sql="SELECT p.project_id, p.project_name,p.main_pi_id ,f.first_name, f.last_name,  p.starting_date, p.ending_date FROM faculty AS f, project AS p WHERE p.main_pi_id = f.id;";
$res=pg_query($db_connection,$sql);
$row=pg_fetch_array($res);

echo "<b>List of all the Projects : </b><br>";
while($row)
{

    echo "<tr>";
    echo "<td>" . $row['project_id'] . "</td>";
    echo "<td>" . $row['project_name'] . "</td>";
    echo "<td>" . $row['starting_date'] . "</td>";

    if ($row['ending_date'])
        echo "<td>" . $row['ending_date'] . "</td>";

    else
        echo "<td>" . "CURRENT" . "</td>";

    echo "<td>" . $row['main_pi_id'] . "</td>";
    echo "<td>" . $row['first_name'] . " " . $row['last_name'] . "</td>";

    $row=pg_fetch_array($res);
}

echo '<button><a href="http://localhost/LeavePortal/ProjectPage.php">Go Back</a></button> ';


?>


</body>
</html>