<?php
    // $config = json_decode(file_get_contents("../config.json"), true);

    $hostname = $config["database"]["hostname"] ?? "localhost";
    $username = $config["database"]["username"] ?? "root";
    $password = $config["database"]["password"] ?? "";
    $database = $config["database"]["name"] ?? "note_db";

    $connection = new mysqli($hostname, $username, $password, $database);

    if ($connection->connect_error) {
        die("Connection Failed ".$connection->connect_error);
    }
?>