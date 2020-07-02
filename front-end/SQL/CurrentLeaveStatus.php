<?php

$db_connection = pg_connect("host=localhost dbname=leave_db user=postgres password=1109");

session_start();
$fac_id=$_SESSION["fac_id"];

$sql1="SELECT * FROM leave_pending WHERE sender_id='$fac_id'";
$res1=pg_query($db_connection,$sql1);
$row1=pg_fetch_array($res1);

if (!empty($row1))
{
    echo "Date of leave : ";
    echo $row1['date_of_leave'];
    echo "<br> Current Holder : ";//display/
    echo $row1['current_holder_id'];
    echo " : ";
    echo $row1['current_holder_designation'];
    echo "<br> Comments : ";
    echo $row1['comments'];

}

else
{
    $sql2="SELECT * FROM finalised_leaves WHERE original_sender_id='$fac_id'";
    $res2=pg_query($db_connection,$sql2);
    $row2=pg_fetch_array($res2);

    while(!empty($row2))
    {   
        echo "Dates of leave : ";
        echo "(".$row2['date_of_leave1']." to ".$row2['date_of_leave2'].")";
        echo "<br> Final Holder : ";//display/
        echo $row2['final_holder_id'];
        echo " : ";
        echo $row2['final_holder_designation'];
        echo "<br> Final Comments : ";
        echo $row2['final_comment'];
        echo "<br> Status : ";
        echo $row2['final_result'];
        $row2=pg_fetch_array($res2);

        echo "<br><br>";
        //display
    }
}

echo "<br>";
echo '<button><a href="http://localhost/LeavePortal/GetLoginDetails.php">Go Back</a>';
?>