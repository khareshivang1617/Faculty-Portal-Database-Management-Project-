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

$sql="SELECT d.request_id, d.project_id,  d.pi_id, f1.first_name AS f_n1, f1.last_name AS l_n1, d.decision_maker_id, f2.first_name AS f_n2, f2.last_name AS l_n2, d.date_of_decision, d.comments FROM   decisions_trail as d, faculty as f2, faculty as f1 where   d.pi_id = f1.id and d.decision_maker_id = f2.id;";
$res=pg_query($db_connection,$sql);
$row=pg_fetch_array($res);

echo "<table border='1'>

<tr>
<th>Reuqest ID</th>
<th>Project ID</th>
<th>Project Name</th>
<th>Faculty ID (Initiater)</th>
<th>Name (Initiater)</th>
<th>Faculty ID (Decision-Maker)</th>
<th>Name (Decision Maker)</th>
<th>Date of decision</th>
<th>Comments</th>
</tr>";

while ($row)
{
    $proj_id=$row['project_id'];
    $sql1="SELECT project_name FROM project WHERE project_id=$proj_id;";
    $res1=pg_query($db_connection,$sql1);
    $row1=pg_fetch_array($res1);

    echo "<tr>";
    echo "<td>" . $row['request_id'] . "</td>";
    echo "<td>" . $row['project_id'] . "</td>";
    echo "<td>" . $row1['project_name'] . "</td>";
    echo "<td>" . $row['pi_id'] . "</td>";
    echo "<td>" . $row['f_n1'] . " " . $row['l_n1'] ."</td>";
    echo "<td>" . $row['decision_maker_id'] . "</td>";
    echo "<td>" . $row['f_n2'] . " " . $row['l_n2'] ."</td>";
    echo "<td>" . $row['date_of_decision'] . "</td>";
    echo "<td>" . $row['comments'] . "</td>";

    $row=pg_fetch_array($res);
}

echo '<button><a href="http://localhost/LeavePortal/AdminsPage.php">Go Back</a>'; 
?>

</body>
</html>