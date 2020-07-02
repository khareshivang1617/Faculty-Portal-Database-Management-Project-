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

$sql="SELECT * FROM project AS p, expenditure AS e WHERE p.project_id=e.project_id";
$res=pg_query($db_connection,$sql);
$row=pg_fetch_array($res);



echo "<table border='1'>

<tr>
<th>Request ID </th>
<th>Project ID </th>
<th>Project Name</th>
<th> Requested by ID </th>
<th> Name </th>
<th>Expenditure Type</th>
<th>CPU</th>
<th>Qty</th>

</tr>";

echo "<br><br><b> Details Regarding Expenditures : </b><br>"; 

while($row)
{
    $req_id=$row['request_id'];
    $sql1="select distinct pi_id , first_name , last_name from decisions_trail , faculty where pi_id = id and request_id = $req_id";
    $res1=pg_query($db_connection,$sql1);
    $row1=pg_fetch_array($res1);
    echo "<tr>";
    echo "<td>" . $row['request_id'] . "</td>";
    echo "<td>" . $row['project_id'] . "</td>";
    echo "<td>" . $row['project_name'] . "</td>";
    echo "<td>" . $row1['pi_id'] . "</td>";
    echo "<td>" . $row1['first_name'] . " " . $row1['last_name'] . "</td>";

    echo "<td>" . $row['expenditure_type'] . "</td>";
    echo "<td>" . $row['cost_per_unit'] . "</td>";
    echo "<td>" . $row['num_of_units'] . "</td>";

    //echo "Project ID : ".$row["project_id"]." ; Project Name : ".$row["project_name"]." ; Budget Type : ".$row["budget_type"]." ; Budget Amount : ".$row["budget_amount"]."<br>";
    $row=pg_fetch_array($res);
}

echo '<button><a href="http://localhost/LeavePortal/ProjectPage.php">Go Back</a></button> ';
//echo "<br><br>";

?>


</body>
</html>