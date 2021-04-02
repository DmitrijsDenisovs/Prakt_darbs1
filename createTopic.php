<?php
    if(session_status() != PHP_SESSION_ACTIVE){
        session_start();
    }
    if ($_SERVER["REQUEST_METHOD"] == "POST"){
        $inputTopicName = $_POST["topicName"];
        $inputTopicName = ucfirst(htmlspecialchars(stripslashes(trim($inputTopicName))));
        if(strlen($inputTopicName) == 0){
            $_SESSION["topicError"] = "Ievadiet tēmas nosaukumu";
            header("Location: index.php");
            exit();
        }
        if(strlen($inputTopicName) > 255){
            $_SESSION["topicError"] = "Nosaukums ir parāks garš";
            echo strlen($inputTopicName);
            header("Location: index.php");
            exit();
        }
        $servername = "localhost";
        $username = "root";
        $dataFile = fopen("confidentialData\password.txt", "r");
        $password = fread($dataFile, filesize("confidentialData\password.txt"));
        fclose($dataFile);
        $dbname = "forumdatabase";

        $conn = new mysqli($servername, $username, $password, $dbname);
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
            $_SESSION["topicError"] = "Problēmas ar datu bāzes pieslēgumu";
            header("Location: index.php");
            exit();
        }
        else{
            $email = $_SESSION["email"];
            $sql = "INSERT INTO topic (TopicName, Email)
                VALUES ('$inputTopicName', '$email')";
            if ($conn->query($sql) != TRUE) {
                $conn->close();
                $_SESSION["topicError"] = "Error: " . $sql . "<br>" . $conn->error;
             }   
             $conn->close();
        }

    }   
    unset($_SESSION["topicError"]);
    header("Location: index.php");
    exit();
?>