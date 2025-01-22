<?php
session_start();
if(isset($_SESSION["url"]))
{
    session_unset();
    session_destroy();
    header('location:../index.php');
}
else
{
    session_unset();
    session_destroy();
    echo '<img src="signouttt.gif">';
    header("refresh: 5; url=login.php");
}
?>