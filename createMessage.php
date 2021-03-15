<?php
    if(session_status() != PHP_SESSION_ACTIVE){
        session_start();
    }
    if ($_SERVER["REQUEST_METHOD"] == "POST"){
        $inputMessage = $_POST["message"];
        $inputTopicId = $_POST["topicId"];
        $inputMessage = ucfirst(htmlspecialchars(stripslashes(trim($inputMessage))));
        if(strlen($inputMessage) == 0){
            $_SESSION["topicError"] = "Ievadiet tēmas nosaukumu";
            header("Location: topic.php?id=".$inputTopicId);
            exit();
        }
        if(strlen($inputMessage) > 21844){
            $_SESSION["topicError"] = "Nosaukums ir parāks garš";
            echo strlen($inputMessage);
            header("Location: topic.php?id=".$inputTopicId);
            exit();
        }
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "forumdatabase";

        $conn = new mysqli($servername, $username, $password, $dbname);
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
            $_SESSION["topicError"] = "Problēmas ar datu bāzes pieslēgumu";
            header("Location: topic.php?id=".$inputTopicId);
            exit();
        }
        else{
            $email = $_SESSION["email"];
            $sql = "INSERT INTO message (ThemeID, Email, Text)
                VALUES ('$inputTopicId','$email', '$inputMessage')";
            if ($conn->query($sql) != TRUE) {
                $conn->close();
                $_SESSION["topicError"] = "Error: " . $sql . "<br>" . $conn->error;
             }   
             $conn->close();
        }

    }   
    unset($_SESSION["topicError"]);
    header("Location: topic.php?id=".$inputTopicId);
    exit();
?>