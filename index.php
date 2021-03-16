<?php
    if(session_status() != PHP_SESSION_ACTIVE){
        session_start();
        if(isset($_COOKIE["name"])){
            $_SESSION["name"] = $_COOKIE["name"];
        }
        if(isset($_COOKIE["email"])){
            $_SESSION["email"] = $_COOKIE["email"];
        }
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
        <h3>
            Tēmas
        </h3>
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
                    header("Location: index.php");
                    exit();
                }
                $sql = "SELECT * FROM topic";
                $topics = $conn->query($sql);
            ?>
            <?php
                while($row = $topics->fetch_assoc()):
                    $email = $row["Email"];
                    $sql = "SELECT Name from client WHERE Email = '$email'";
                    $result = $conn->query($sql);
                    $record = $result->fetch_assoc();
                    $name = $record["Name"];
                    $id = $row["ID"];
 
                    echo '<a class = "btn" href="topic.php?id='. $id .'">';
            ?>
                <li class = "list-group-item">
                    <div class="d-grid">
                        <div class="row">
                            <div class="col-md-12 text-primary">
                                <?php 
                                    echo $row["TopicName"];
                                ?>  
                            </div>
                            <div class="col-md-12">
                                <?php 
                                    echo "Izveidoja ". $name;
                                ?>
                            </div>
                        </div>    
                    </div>
                </li>
                </a>
            <?php
                endwhile;
            ?>
            </ul>       
        <?php 
            if(isset($_SESSION["name"]) && isset($_SESSION["email"])):                               
        ?>  
            <div class = "form-container container border">
                <form  action="createTopic.php" autocomplete="off" method="POST">
                    <?php
                        if(isset($_SESSION["topicError"])):
                    ?>
                            <div class = "mt-1 alert alert-danger">
                                <?php
                                    echo $_SESSION["topicError"];
                                ?>    
                            </div>
                    <?php
                            unset($_SESSION["topicError"]);
                        endif;
                    ?>      
                    <div class = "form-group">
                        <h5> Izveidot jaunu tēmu</h5>
                        <label for="topicName">Tēmas nosaukums</label>
                        <input class = "form-control" name = "topicName" id = "topicName" type = "text"/>
                    </div>
                    <br>
                    <button class = "my-2 btn-primary" type = "submit">Izveidot tēmu</button>
                </form>
            </div>
        <?php
            endif;
        ?>
    </div>
    <?php
        include "blocks\\footer.php";
    ?>  
</body>   