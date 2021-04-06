<?php
    require "functions\connectToDatabase.php";
    if(session_status() != PHP_SESSION_ACTIVE){
        session_start();
    }
    if ($_SERVER["REQUEST_METHOD"] == "POST"){
        $inputPass = $_POST["password"];
        $inputRepPass = $_POST["rep-password"];
        if($inputRepPass != $inputPass){
            $_SESSION["error"] = "Paroles nesakrīt";
            header("Location: updateUser.php");
            exit();
        }
        

        if($inputPass == null){
            $_SESSION["error"] = "Ievadiet paroli";
            header("Location: updateUser.php");
            exit();
        }
        $inputPass = md5($inputPass);

        /*$servername = "localhost";
        $username = "root";
        $dataFile = fopen("confidentialData\password.txt", "r");
        $password = fread($dataFile, filesize("confidentialData\password.txt"));
        fclose($dataFile);
        $dbname = "forumdatabase";
        $conn = new mysqli($servername, $username, $password, $dbname);*/
        $conn = connectToDatabase("updateUser.php");
        
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
            $_SESSION["error"] = "Problēmas ar datu bāzes pieslēgumu";
            header("Location: updateUser.php");
            exit();
        }
        else{  
            $email = $_SESSION["email"];
            $sql = "UPDATE client SET Password = '$inputPass' WHERE Email = '$email'";
            if($conn->query($sql) === FALSE){
                $_SESSION["error"] = "Error: " . $sql . "<br>" . $conn->error;
            }
            $conn->close();
            
        }
    }
    unset($_SESSION["error"]);
    header("Location: index.php");
    exit();
?>