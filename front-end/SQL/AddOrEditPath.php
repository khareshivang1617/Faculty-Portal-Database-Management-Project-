<html>
<body>

<h1>Input the path</h1>
<form action="AddOrEditPath.php" method="post">
<b> 1 : <b> <input type=text name=txt[] >
<b> 2 : <b> <input type=text name=txt[] >
<b> 3 : <b> <input type=text name=txt[] >
<b> 4 : <b> <input type=text name=txt[] >
<b> 5 : <b> <input type=text name=txt[] >
<b> 6 : <b> <input type=text name=txt[] >
<b> 7 : <b> <input type=text name=txt[] >
<b> 8 : <b> <input type=text name=txt[] >
<br>
<input type="submit" value="submit">
</form>

</body>
</html>

<?php

echo "<br>";

if (isset($_POST['txt']))
{
    $array=$_POST['txt'];
    
    foreach($array as $key => $value)          
    if(empty($value)) 
        unset($array[$key]);
    
    $db_connection = pg_connect("host=localhost dbname=leave_db user=postgres password=1109");  

    $sql_delete="DELETE FROM path_table WHERE designation='$array[0]'";
    $res_delete=pg_query($db_connection,$sql_delete);
    $row_delete=pg_fetch_array($res_delete);

    $sql_insert="INSERT INTO path_table VALUES('$array[0]','{".implode(',', $array)."}' );";
    $res_insert=pg_query($db_connection,$sql_insert);
    
    echo "Path inserted/updated Successfully!!! <br>";
}
?>


<?php

$db_connection = pg_connect("host=localhost dbname=leave_db user=postgres password=1109");  

$sql_curr_path="SELECT * FROM path_table;";
$res_curr_path=pg_query($db_connection,$sql_curr_path);
$row_curr_path=pg_fetch_array($res_curr_path);

echo "<br><br> Current Paths Are : <br>";

while ($row_curr_path)
{
    $arr=$row_curr_path['path'];
    echo "Designation : ".$row_curr_path['designation']." ; Path = $arr <br>";
    
    $row_curr_path=pg_fetch_array($res_curr_path);
}

?>