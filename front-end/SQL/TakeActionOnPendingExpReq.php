<?php

$req_id=$_POST["request_id"];
$comments=$_POST["comments"];

$db_connection = pg_connect("host=localhost dbname=leave_db user=postgres password=1109");

session_start();
$fac_id=$_SESSION["fac_id"];
$designation=$_SESSION["designation"];
$_SESSION["request_id"]=$req_id;
$_SESSION["comments"]=$comments;

if ($designation!="DEAN_SP")
    echo '<button><a href="http://localhost/LeavePortal/ForwardExpReq.php">Forward Expenditure Request</a>';

    echo '<button><a href="http://localhost/LeavePortal/RejectExpReq.php">Reject Expenditure Request</a>';

if($designation==="DEAN_SP")
    echo '<button><a href="http://localhost/LeavePortal/ApproveExpReq.php">Approve Expenditure Request</a>';

?>