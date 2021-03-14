<?php
    if(session_status() != PHP_SESSION_ACTIVE){
        session_start();
    }
?>
<!DOCTYPE html>
<head>
    <title>Unreal Login</title>
    <meta charset="UTF8"/>
    <link href="style\style.css" rel = "stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" 
        rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

</head>
<body>
    <?php
        include "blocks\header.php";
    ?>
    <div class = "container">
            <?php
                if(isset($_SESSION["error"])):
            ?>
                    <div class = "mt-1 alert alert-danger">
                        <?php
                            echo $_SESSION["error"];
                        ?>    
                    </div>
            <?php
                    unset($_SESSION["error"]);
                endif;
            ?>       
        <?php 
            if(isset($_SESSION["name"]) && isset($_SESSION["email"])):                
        ?>
                <ul class="list-group">
                    <?php
                        $servername = "localhost";
                        $username = "root";
                        $password = "";
                        $dbname = "forumdatabase";
                        $conn = new mysqli($servername, $username, $password, $dbname);
                        if ($conn->connect_error) {
                            die("Connection failed: " . $conn->connect_error);
                            $_SESSION["error"] = "Problēmas ar datu bāzes pieslēgumu";
                            header("Location: registerWindow.php");
                            exit();
                        }
                    ?>
                </ul>
        <?php
            endif;
        ?>
    </div>
    <?php
        include "blocks\\footer.php";
    ?>  
</body>   