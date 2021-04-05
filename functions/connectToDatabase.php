<?php
    function &connectToDatabase($location = "index.php"){
        $servername = "localhost";
        $username = "root";
        $dataFile = fopen("confidentialData\password.txt", "r");
        $password = fread($dataFile, filesize("confidentialData\password.txt"));
        fclose($dataFile);
        $dbname = "forumdatabase";
        $conn = new mysqli($servername, $username, $password, $dbname);
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
            $_SESSION["error"] = "Problēmas ar datu bāzes pieslēgumu";
            header("Location: " + $location);
            exit();
            return null;
        }
        return $conn; 
    }
?>