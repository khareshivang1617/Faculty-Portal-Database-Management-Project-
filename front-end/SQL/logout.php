<?php
    if(session_status()==PHP_SESSION_NONE)
    {
        session_start();
    }

    //echo "Logging out the session!!!<br>";

    session_unset();
    session_destroy();
    include"home.php";
?>