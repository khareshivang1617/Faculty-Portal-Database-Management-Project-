<?php

echo "Here are Status of your Requests : <br>";

session_start();
$fac_id=$_SESSION["fac_id"];

$db_connection = pg_connect("host=localhost dbname=leave_db user=postgres password=1109");

$sql_approved="SELECT DISTINCT d.request_id,p.project_name, e.expenditure_type, e.cost_per_unit, e.num_of_units,d.comments FROM decisions_trail as d, expenditure as e, project as p WHERE d.request_id = e.request_id AND p.project_id = d.project_id AND d.pi_id = '$fac_id';";
$res_approved=pg_query($db_connection,$sql_approved);
$row_approved=pg_fetch_array($res_approved);

echo "<br><br> Approved Requests : <br>";

while ($row_approved)
{   

    echo "Request ID : ".$row_approved["request_id"]." ; Project Name : ".$row_approved["project_name"]." ; Expenditure Type : ".$row_approved["expenditure_type"]." ; CPU : ".$row_approved["cost_per_unit"]." ; No. of units : ".$row_approved["num_of_units"]." ; Comments : ".$row_approved["comments"]."<br>";
    $row_approved=pg_fetch_array($res_approved);
}

$sql_rejected="SELECT DISTINCT d.request_id,p.project_name, r.expenditure_type, r.cost_per_unit, r.num_of_units,f.id,f.first_name, f.last_name, d.comments FROM decisions_trail AS d, rejected_requests AS r, faculty AS f, project as p WHERE d.request_id = r.request_id AND r.last_holder_id = f.id AND p.project_id = d.project_id AND d.pi_id = '$fac_id';";
$res_rejected=pg_query($db_connection,$sql_rejected);
$row_rejected=pg_fetch_array($res_rejected);


echo "<br><br> Rejected Requests : <br>";

while ($row_rejected)
{
    echo "Request ID : ".$row_rejected["request_id"]." ; Project Name : ".$row_rejected["project_name"]." ; Expenditure Type : ".$row_rejected["expenditure_type"]." ; CPU : ".$row_rejected["cost_per_unit"]." ; No. of unit : ".$row_rejected["num_of_units"]." ; Rejected By => ".$row_rejected["id"]." : ".$row_rejected["first_name"]." ".$row_rejected["last_name"]." ; Comments : ".$row_rejected["comments"]."<br>";
    $row_rejected=pg_fetch_array($res_rejected);

}

$sql_pending="SELECT DISTINCT d.request_id,p.project_name, c.expenditure_type, c.cost_per_unit, c.num_of_units,f.id,f.first_name, f.last_name,d.comments FROM decisions_trail AS d, current_request AS c, faculty AS f,project as p WHERE d.request_id = c.request_id AND c.current_holder_id = f.id AND p.project_id = d.project_id AND d.pi_id = '$fac_id';";
$res_pending=pg_query($db_connection,$sql_pending);
$row_pending=pg_fetch_array($res_pending);



echo "<br><br> Pending Requests : <br>";

while ($row_pending)
{
    echo "Request ID : ".$row_pending["request_id"]." ; Project Name : ".$row_pending["project_name"]." ; Expenditure Type : ".$row_pending["expenditure_type"]." ; CPU : ".$row_pending["cost_per_unit"]." ; No. of unit : ".$row_pending["num_of_units"]." ; Pending At => ".$row_pending["id"]." : ".$row_pending["first_name"]." ".$row_pending["last_name"]." ; Comments : ".$row_pending["comments"]."<br>";
    $row_pending=pg_fetch_array($res_pending);
}
echo"<br><br>";

echo '<button><a href="http://localhost/LeavePortal/ProjectPage.php">Go Back</a>';

?>
