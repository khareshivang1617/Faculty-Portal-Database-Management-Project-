<?php

    $db_connection = pg_connect("host=localhost dbname=leave_db user=postgres password=1109");

    echo "No. of leaves updated successfully!!! <br>";     

    
    $sql_replenish="SELECT replenish_leaves();";
    $res=pg_query($db_connection,$sql_replenish);

    echo "All leaves replenished!!! <br>";
    echo '<a href="http://localhost/LeavePortal/AdminsPage.php">Go-Back</a>';
    echo "<br>";
    echo '<a href="http://localhost/LeavePortal/Home.php">Home</a>';


?>