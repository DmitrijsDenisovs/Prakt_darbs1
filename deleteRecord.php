<?php
    require "functions\connectToDatabase.php";
    $tableName = $_GET["table"];
    $primaryKeyValue = $_GET["key"];
    switch ($tableName){
        case "Client":
            $conn = connectToDatabase("clientTable.php");
            $deleteQuery = "DELETE FROM Client WHERE Email = '$primaryKeyValue'";
            $conn->query($deleteQuery);
            $conn->close();
            header("clientTable.php");
            break;
        case "Message":
            $conn = connectToDatabase("messageTable.php");
            $deleteQuery = "DELETE FROM Message WHERE ID = '$primaryKeyValue'";
            $conn->query($deleteQuery);
            $conn->close();
            header("messageTable.php");
            break;
        case "Topic":
            $conn = connectToDatabase("topicTable.php");
            $deleteQuery = "DELETE FROM Topic WHERE ID = '$primaryKeyValue'";
            $conn->query($deleteQuery);
            $conn->close();
            header("admin.php");
            break;
    }
?>