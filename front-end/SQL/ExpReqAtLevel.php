<?php

session_start();
$fac_id=$_SESSION["fac_id"];
$designation=$_SESSION["designation"];

$db_connection = pg_connect("host=localhost dbname=leave_db user=postgres password=1109");


// A query that shows requests pending at your level;

$sql="SELECT * FROM current_request WHERE current_holder_id='$fac_id';";
$res=pg_query($db_connection,$sql);
$row=pg_fetch_array($res);

echo "Requests Pending at Your Level : <br>";

while ($row)
{       
    echo "Request ID : ";
    echo $row['request_id'];
    echo " ; Project ID : "; 
    echo $row['project_id'];
    echo " ; PI ID : ";
    echo $row['pi_id'];
    echo " ; Expenditure Type : ";
    echo $row['expenditure_type'];
    echo " ; CPU : ";
    echo $row['cost_per_unit'];
    echo " ; No. of Units : ";
    echo $row['num_of_units'];
    echo " ; Comments : ";
    echo $row['comments'];
    echo "<br>";
    /*?>
    <tr>
        <td><?php echo $row['request_id']; ?></td> 
        <td><?php echo $row['project_id']; ?></td> 
        <td><?php echo $row['pi_id']; ?></td> 
        <td><?php echo $row['cost_per_unit']; ?></td>
        <td><?php echo $row['num_of_units']; ?></td>   
    </tr>
    <?php*/
    $row=pg_fetch_array($res);
}

/*session_start();
$fac_id=$_SESSION["fac_id"];
$designation=$_SESSION["designation"];
echo '<button><a href="http://localhost/LeavePortal/ForwardExpReq.php">Forward Expenditure Request</a>';
echo '<button><a href="http://localhost/LeavePortal/RejectExpReq.php">Reject Expenditure Request</a>';

if($designation==="DEAN_SP")
    echo '<button><a href="http://localhost/LeavePortal/ApproveExpReq.php">Approve Expenditure Request</a>';
*/
?>

<html>
<body>

<h1>Type in the Request ID to take action</h1>
<form action="TakeActionOnPendingExpReq.php" method="post">
<b> Request Id : <b> <input type="integer" name="request_id">
<b> Comments : <b> <input type="text" name="comments">
<br>
<input type="submit" value="submit">
</form>

</body>
</html>