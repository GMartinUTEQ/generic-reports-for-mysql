<?php

$servername = "localhost";
$username = "root";
$password = "desarrollo";
$dbname = "genreportbuilder";

// Create connection
$MyGRBConn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($MyGRBConn->connect_error) {
    die("Connection failed: " . $MyGRBConn2->connect_error);
}
