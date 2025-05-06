<?php
    include "../config/dbConfig.php";
    include "../server/modules/noteServer.php";

    $method = $_POST["method"]; 

    switch ($method) {
        case "GET":
            getAllNotes($connection, true);
            break;
        case "GET_ID":
            getNoteById($connection, $_POST["note_id"]);
            break;
        case "INS":
            createNote($connection, true);
            break;
        case "EDI":
            updateNote($connection, true);
            break;
        case "DEL":
            deleteNote($connection, true);
            break; 
    }
?>