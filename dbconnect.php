<?php
    // turn on error reporting
    error_reporting(E_ALL);
	ini_set('display_errors', 'On');

    // set db connection parameters
    $dbhost = 'oniddb.cws.oregonstate.edu';
    $dbname = 'giesbral-db';
    $dbuser = 'giesbral-db';
    $dbpass = 'WyhjbgvA37uDCGHh';

    $mysqli = new mysqli($dbhost, $dbuser, $dbpass, $dbname);

    if ($mysqli->connect_errno)
    {
        die("Database Connection Error: " . $mysqli->connection_errno . " " . $mysqli->connect_error);
    }
    else
    {
        $success = ("Successfully connected to " . $dbname . " on " . $dbhost);
    }
?>