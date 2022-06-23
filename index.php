<?php
    header('Access-Control-Allow-Origin: *');
    // Connecting to the database
    $mysqli = new mysqli("localhost","root","ronaldofan123","portfolio2");
    if ($mysqli -> connect_errno) {
    echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
    exit();
    }

    include('import.php');
    //Execution of SQL query 
    $sql = "SELECT *
    FROM weather
    ORDER BY weather_when DESC limit 1";
    $result = $mysqli -> query($sql);
    // Obtaining data, converting into json and printing 
    $row = $result -> fetch_assoc();
    print json_encode($row);
    // Free result set and close connection
    $result -> free_result();
    $mysqli -> close();
?>