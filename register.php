<?php
    if(session_status() != PHP_SESSION_ACTIVE){
        session_start();
    }
    if ($_SERVER["REQUEST_METHOD"] == "POST"){
        $inputName = $_POST["name"];
        $inputEmail = $_POST["email"];
        $inputPass = $_POST["password"];
        $inputRepPass = $_POST["rep-password"];
        if($inputRepPass != $inputPass){
            $_SESSION["error"] = "Paroles nesakrīt";
            header("Location: registerWindow.php");
            exit();
        }
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "forumdatabase";

        $inputName = ucfirst(htmlspecialchars(stripslashes(trim($inputName))));
        $inputEmail = htmlspecialchars(stripslashes(trim($inputEmail)));
        if($inputPass == null){
            $_SESSION["error"] = "Ievadiet paroli";
            $conn->close();
            header("Location: registerWindow.php");
            exit();
        }
        $inputPass = md5($inputPass);
        if(!filter_var($inputEmail, FILTER_VALIDATE_EMAIL)){
            $_SESSION["error"] = "Nepareizi ievadīts epasts";
            $conn->close();
            header("Location: registerWindow.php");
            exit();
        }
        if(strlen($inputName) > 50){
            $_SESSION["error"] = "Vārds ir parāk garš";
            $conn->close();
            header("Location: registerWindow.php");
            exit();
        }
        if(strlen($inputEmail) > 60){
            $_SESSION["error"] = "Epasts ir parāk garš";
            $conn->close();
            header("Location: registerWindow.php");
            exit();
        }

        
        $conn = new mysqli($servername, $username, $password, $dbname);
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
            $_SESSION["error"] = "Problēmas ar datu bāzes pieslēgumu";
            header("Location: registerWindow.php");
            exit();
        }
        else{  
            
            $sql = "SELECT Email FROM client WHERE Email = '$inputEmail'";
            $duplicate = $conn->query($sql);
            if($duplicate->num_rows > 0){
                $_SESSION["error"] = "Lietotājs ar tādu e-pastu jau eksistē";
                $conn->close();
                header("Location: registerWindow.php");
                exit();
            }
            $sql = "INSERT INTO client (Email, Name, Password)
                VALUES ('$inputEmail', '$inputName', '$inputPass');";

            if ($conn->query($sql) === TRUE) {
                $_SESSION["name"] = $inputName;
                $_SESSION["email"] = $inputEmail;
                setcookie("email", $inputEmail, time() + 3600, "/");
                setcookie("name", $record["Name"], time() + 3600, "/");
            } 
            else {
                $conn->close();
                $_SESSION["error"] = "Error: " . $sql . "<br>" . $conn->error;
            }

            $conn->close();
            
        }
    }
    unset($_SESSION["error"]);
    header("Location: index.php");
    exit();
?>