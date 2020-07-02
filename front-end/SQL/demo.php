<?php

try{
    
    $db_connection = pg_connect("host=localhost dbname=leave_db user=postgres password=1109");

    echo "YES!!! <br>";
    
    $sql="SELECT create_faculty();";
    $res=pg_query($db_connection,$sql);
    $row = pg_fetch_row($res);
    echo $row;
    //echo $row['first_name'];
    echo $res;

    if ($row['first_name']==='Shivang')
        echo "wuhu <br>";

    /*foreach($db_connection->query($sql) as $row)
    {
        print $row['gender'].'<br>';

    }*/

}catch(PDOException $e){
 echo "NO!!! <br>";
}


/*try{

    $myPDO = new PDO("pgsql:host=localhost,dbname=testbb","","1109");
    echo "Connected !!! <br>";

}catch(PDOException $e){

    echo $e->getMessage();
}*/


?>