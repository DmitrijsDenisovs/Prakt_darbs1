<?php
    if(session_status() != PHP_SESSION_ACTIVE){
        session_start();
    }
    if ($_SERVER["REQUEST_METHOD"] == "POST"){
        $inputEmail = $_POST["email"];
        $inputPass = $_POST["password"];
       
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "forumdatabase";

        $conn = new mysqli($servername, $username, $password, $dbname);
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
            $_SESSION["error"] = "Problēmas ar datu bāzes pieslēgumu";
            header("Location: loginWindow.php");
            exit();
        }
        else{  
            $inputEmail = htmlspecialchars(stripslashes(trim($inputEmail)));
            $inputPass = md5($inputPass);

            $sql = "SELECT Name, Password FROM client WHERE Email = '$inputEmail'";
            $result = $conn->query($sql);

            if($result->num_rows == 0){
                $conn->close();
                $_SESSION["error"] = "Lietotājs ar tādu e-pastu neeksistē";
                header("Location: loginWindow.php");
                exit();
            }
            else {
                $record = $result->fetch_assoc();
                if($record["Password"] != $inputPass){     
                    $conn->close();
                    $_SESSION["error"] = "Nepareiza parole";
                    header("Location: loginWindow.php");
                    exit(); 
                }
                else{
                    $_SESSION["name"] = $record["Name"];
                    $_SESSION["email"] = $inputEmail;
                }
            }

            $conn->close();
            
        }
    }
    unset($_SESSION["error"]);
    header("Location: index.php");
    exit();
?>