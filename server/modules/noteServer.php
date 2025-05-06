<?php
    function getAllNotes($connection, $fromClient = false) {
        $query = "SELECT * FROM note_tbl ORDER BY note_id DESC";
        $select = $connection->query($query);
        $response = array();
        $data = array();

        if ($select) {
            while ($note = $select->fetch_assoc()) {
                array_push($data, $note);
            }

            $response = ["status" => 200, "data" => $data];
        } else
            $response = ["status" => 500];
        
        if ($fromClient) {
            echo json_encode($response);
            return;
        }

        return $data;
    }

    function getNoteById($connection, $note_id) {
        $query = "SELECT * FROM note_tbl WHERE note_id = '$note_id'";
        $select = $connection->query($query);
        $response = array();

        if ($select)
            $response = ["status" => 200, "data" => $select->fetch_assoc()];
        else
            $response = ["status" => 500];

        echo json_encode($response);
    }

    function createNote($connection, $fromClient = false, $data = []) {
        $title = $fromClient ? $_POST["title"] : $data["title"];
        $description = $fromClient ? $_POST["description"] : $data["description"];
        $type = $fromClient ? $_POST["type"] : $data["type"]; 
        $status = 1;

        $query = "INSERT INTO note_tbl VALUES (NULL, '$title', '$description', '$type', '$status')";
        $insert = $connection->query($query);
        $response = array();
        $data = getAllNotes($connection);
    
        if ($insert)
            $response = ["status" => 200, "data" => $data];
        else
            $response = ["status" => 500];

        echo json_encode($response);
    }

    function updateNote($connection, $fromClient = false, $data = []) {
        $note_id = $fromClient ? $_POST["note_id"] : $_REQUEST["id"];
        $title = $fromClient ? $_POST["title"] : $data["title"];  
        $description = $fromClient ? $_POST["description"] : $data["description"];  
        $type = $fromClient ? $_POST["type"] : $data["type"];
        $status = $fromClient ? $_POST["status"] : $data["status"];

        $query = "UPDATE note_tbl SET title = '$title', description = '$description', type = '$type', status = '$status' WHERE note_id = '$note_id'";
        $update = $connection->query($query);
        $response = array();
        $data = getAllNotes($connection);
    
        if ($update)
            $response = ["status" => 200, "data" => $data];
        else
            $response = ["status" => 500];

        echo json_encode($response);
    }


    function deleteNote($connection, $fromClient = false) {
        $note_id = $fromClient ? $_POST["note_id"] : $_REQUEST["id"];

        $query = "DELETE FROM note_tbl WHERE note_id = '$note_id'";
        $delete = $connection->query($query);
        $response = array();
        $data = getAllNotes($connection);
    
        if ($delete)
            $response = ["status" => 200, "data" => $data];
        else
            $response = ["status" => 500];

        echo json_encode($response);
    }
?>