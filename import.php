<?php
    header('Access-Control-Allow-Origin: *');
    // Connecting to database
    $servername="localhost";
    $username="root";
    $password="ronaldofan123";
    $database="portfolio2";
    $mysqli = new mysqli($servername,$username,$password,$database);
    // Handling database connectivity error
    if ($mysqli -> connect_errno) {    
    echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
    exit();
    }
    // Selecting the weather data from the provided parameters 
    $sql = "SELECT *
    FROM weather
    WHERE weather_when >= DATE_SUB(NOW(), INTERVAL 3600 SECOND)
    ORDER BY weather_when DESC limit 1";
    $result = $mysqli -> query($sql);
    // Running the loop if no existing database is found
    if ($result->num_rows == 0) {
        $url = 'https://api.openweathermap.org/data/2.5/weather?q=Washington&appid=ac651546c8b3daa4e05af06afa285e70';
        // Obtaining the data from json and storing it 
        $data = file_get_contents($url);
        $json = json_decode($data, true);
        // Fetching required datas
        $weather_description = $json['weather'][0]['description'];
        $weather_temperature = $json['main']['temp'];
        $weather_wind = $json['wind']['speed'];
        $city = $json['name'];
        $pressure = $json['main']['pressure'];
        $weather_humidity= $json['main']['humidity'];
        // Inserting into database 
        $sql = "INSERT INTO weather (weather_description, weather_temperature, weather_wind, city,pressure,weather_humidity)
        VALUES('{$weather_description}', '{$weather_temperature}', '{$weather_wind}', '{$city}','{$pressure}','{$weather_humidity}')";
        // Running sql statement and handling errors 
        if (!$mysqli -> query($sql)) {
            echo("<h4>SQL error description: " . $mysqli -> error . "</h4>");
        }
    }
    
?>