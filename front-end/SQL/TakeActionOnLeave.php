<?php

session_start();
$fac_id=$_SESSION["fac_id"];
$designation=$_SESSION["designation"];

$db_connection = pg_connect("host=localhost dbname=leave_db user=postgres password=1109");

$sender_id=$_POST["sender_id"];
$comments=$_POST["comments"];

$_SESSION["comments"]=$comments;
$_SESSION["sender_id"]=$sender_id;


//check if the id entered belongs to him pending only
$sql_check="SELECT * FROM leave_pending WHERE sender_id='$sender_id';";
$res_check=pg_query($db_connection,$sql_check);
$row=pg_fetch_array($res_check);

if ($row['current_holder_id']===$fac_id)
{
    if ($designation!="director")
        echo '<button><a href="http://localhost/LeavePortal/LeaveForward.php">Forward</a>';      

    if ($sender_id!=$fac_id)
    {
        echo '<button><a href="http://localhost/LeavePortal/LeaveSendBack.php">Sendback</a>';
        echo '<button><a href="http://localhost/LeavePortal/LeaveApprove.php">Approve</a>';
        echo '<button><a href="http://localhost/LeavePortal/LeaveReject.php">Reject</a>';
    }
}

else
{
    echo "Please enter valid sender Id";
    echo '<button><a href="http://localhost/LeavePortal/PendingLeavesAtLevel.php">Go Back</a>';
}

?>