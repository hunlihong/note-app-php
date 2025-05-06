<?php
    include "../config/dbConfig.php";
    include "../server/modules/noteServer.php";
    include "../server/headers/apiHeader.php";

    $method = $_SERVER["REQUEST_METHOD"];
    $id = $_REQUEST["id"] ?? false;

    switch ($method) {
        case "GET":
            if ($id) 
                getNoteById($connection, $id);
            else 
                getAllNotes($connection, true);
            break;
        case "POST":
            createNote($connection, false, json_decode(file_get_contents("php://input"), true));
            break;
        case "PUT":
            updateNote($connection, false, json_decode(file_get_contents("php://input"), true));
            break;
        case "DELETE":
            deleteNote($connection);
            break;
    }
?>