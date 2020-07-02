<?php

$user_name=$_POST["username"];
$pass_word=$_POST["password"];

session_start();
$_SESSION["uname"]=$user_name;
$_SESSION["pass"]=$pass_word;

if (isset($_POST["username"]) && isset($_POST["password"]))
{
    if (empty($user_name) || empty($pass_word))
    {
        echo "Please entert all the fields<br>";
        echo '<a href="http://localhost/LeavePortal/LoginPortal.php">Re-login</a>';
    }

    else{

        $db_connection = pg_connect("host=localhost dbname=leave_db user=postgres password=1109");

        $sql_normal_fac="SELECT * FROM normal_faculty_details WHERE login_name='$user_name' AND password_hash='$pass_word'";
        $res_normal_fac=pg_query($db_connection,$sql_normal_fac);
        $row_normal_fac=pg_fetch_array($res_normal_fac);

        if (!empty($row_normal_fac))
        {
           echo "<br><br><b>Welcome Dear Normal Faculty</b> <br><br>";
    /*What fields to display? */
    /* Options for leave application*/
    
            $fac_id=$row_normal_fac['faculty_id'];
            echo "Faculty Id : ";
            echo $fac_id;
        
            $sql_fac="SELECT * FROM faculty WHERE id='$fac_id';";
            $res_fac=pg_query($db_connection,$sql_fac);
            $row_fac=pg_fetch_array($res_fac);
    
            echo "<br>Name : ";
            echo $row_fac['first_name'];
            echo " ";
            echo $row_fac['last_name'];
            echo "<br>";
            echo "Gender : ";
            echo $row_fac['gender'];
            echo "<br>";
            echo "Department : ";
            echo $row_normal_fac['department_name'];
            echo "<br>";
            echo "Remaining Leaves : ";
            echo $row_normal_fac['remaining_leaves'];

            $dept=$row_normal_fac['department_name'];
            $sql_hod="SELECT hod_id FROM department WHERE department_name='$dept';";
            $res_hod=pg_query($db_connection,$sql_hod);
            $row_hod=pg_fetch_array($res_hod);

            echo"<br><br><br>";

            echo '<button><a href="http://localhost/LeavePortal/ListCurrentFaculties.php">Current Faculty Details</a>';      
            echo '<button><a href="http://localhost/LeavePortal/ListCurrentHODs.php">Current HODs</a>';
            echo '<button><a href="http://localhost/LeavePortal/ListCurrentPORs.php">Current PORs</a>';

                  


            echo "<br>";

            
            $_SESSION["designation"]="faculty";
            if ($fac_id===$row_hod['hod_id'])
            {
                $_SESSION["designation"]="HOD";
                //HOD Privilages : See or approve pending lists page///
            }
    
            $_SESSION["fac_id"]=$fac_id;

            echo '<button><a href="http://localhost/LeavePortal/LeaveRequestPortal.php">Request for leave</a>'; 
            echo '<button><a href="http://localhost/LeavePortal/PendingLeavesAtLevel.php">Pending leaves at your level</a>';
            echo '<button><a href="http://localhost/LeavePortal/CurrentLeaveStatus.php">Current Status of your leave</a>';
            echo '<button><a href="http://localhost/LeavePortal/ProjectPage.php">Access Your Project Privilages</a>';
            echo "<button><a href ='logout.php'>Logout</a></button><br>"; 
        }

        else
        {
            $sql="SELECT * FROM cross_cutting_faculty_details WHERE login_name='$user_name' AND password_hash='$pass_word'";
            $res=pg_query($db_connection,$sql);
            $row=pg_fetch_array($res);

            if (!empty($row))
            {
                echo "<br><br><b>Welcome Dear Cross Cutting Faculty </b><br>";
            
                $fac_id=$row["faculty_id"];
                $sql_fac="SELECT * FROM faculty WHERE id=$fac_id;";
                $res_fac=pg_query($db_connection,$sql_fac);
                $row_fac=pg_fetch_array($res_fac);
                
                echo "Faculty Id : ";
                echo $fac_id;
                echo "<br>Name : ";
                echo $row_fac['first_name'];
                echo " ";
                echo $row_fac['last_name'];
                echo "<br>";
                echo "Gender : ";
                echo $row_fac['gender'];
                echo "<br>";
                echo "Designation : ";
                echo $row['designation'];
                echo "<br>";
                echo "Remaining Leaves : ";
                echo $row['remaining_leaves'];
                echo "<br><br><br>";

                echo '<button><a href="http://localhost/LeavePortal/ListCurrentFaculties.php">Current Faculty Details</a>';      
                echo '<button><a href="http://localhost/LeavePortal/ListCurrentHODs.php">Current HODs</a>';
                echo '<button><a href="http://localhost/LeavePortal/ListCurrentPORs.php">Current PORs</a>';      
                //A button to check the list of leaves pending at your level;
                
                if ($row['designation']==="director")
                {
                    echo '<button><a href="http://localhost/LeavePortal/ListFacultyLogs.php">Faculty Logs</a>';      
                    echo '<button><a href="http://localhost/LeavePortal/ListHODLogs.php">HOD Logs</a>';
                    echo '<button><a href="http://localhost/LeavePortal/ListPORLogs.php">POR Logs</a>';      
            
                }

                if ($row['designation']==="dean")
                {
                    echo '<button><a href="http://localhost/LeavePortal/ListHODLogs.php">HOD Logs</a>';
                }

                $_SESSION["fac_id"]=$row['faculty_id'];
                $_SESSION["designation"]=$row['designation'];
                echo '<button><a href="http://localhost/LeavePortal/LeaveRequestPortal.php">Request for leave</a>'; 
                echo '<button><a href="http://localhost/LeavePortal/PendingLeavesAtLevel.php">Pending leaves at your level</a>';
                echo '<button><a href="http://localhost/LeavePortal/CurrentLeaveStatus.php">Current Status of your leave</a>';

                echo '<button><a href="http://localhost/LeavePortal/ProjectPage.php">Access Your Project Privilages</a>';
                /*What fields to display? */
                /* Options for leave application*/

                // IF - ELSE corresponding to each designation posts and their correspoding privilages in it!!!;

        /* list all leaves pending at hod level and an HTML I/P to take action on a particular leave!!!
        */
        //click here to list all normal faculties
                echo "<button><a href ='logout.php'>Logout</a></button><br>";
            }

            else
            {
                $sql_admin="SELECT * FROM admin WHERE login_name='$user_name' AND password_hash='$pass_word'";
                $res_admin=pg_query($db_connection,$sql_admin);
                $admin_det=pg_fetch_array($res_admin);
        
                if (!empty($admin_det))
                {
                    echo "<br><br><b>Welcome dear admin!!! </b><br><br><br>";
                    

                    echo '<button><a href="http://localhost/LeavePortal/ListFacultyLogs.php">Faculty Logs</a>';
                    echo '<button><a href="http://localhost/LeavePortal/ListHODLogs.php">HOD Logs</a>';
                    echo '<button><a href="http://localhost/LeavePortal/ListPORLogs.php">POR Logs</a>';
                    echo '<button><a href="http://localhost/LeavePortal/AdminsPage.php">More Privilages</a>';
                    echo "<button><a href ='logout.php'>Logout</a></button>";
                }
        
                else
                {
                    echo "Either username or password is incorrect!!! <br>";
                    echo '<a href="http://localhost/LeavePortal/LoginPortal.php">Re-login</a>';
                }
            }  
        }

    }
}

else
{
    echo "Please entert all the fields<br>";
    echo '<a href="http://localhost/LeavePortal/LoginPortal.php">Re-login</a>';
}


?>