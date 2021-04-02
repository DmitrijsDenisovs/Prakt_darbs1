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
            <?php
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
                    header("Location: index.php");
                    exit();
                }
                $id = $_GET["id"];
                
                $sql = "SELECT * FROM message WHERE ThemeID = '$id'";
                $messages = $conn->query($sql);
                $sql = "SELECT TopicName FROM topic WHERE ID = '$id'";
                $result = $conn->query($sql);
                $topic = $result->fetch_assoc();
            ?>
        <h3>
            <?php
                echo $topic["TopicName"];
            ?>
        </h3>    
            <?php
                while($row = $messages->fetch_assoc()):
                    $email = $row["Email"];
                    $sql = "SELECT Name from client WHERE Email = '$email'";
                    $result = $conn->query($sql);
                    $record = $result->fetch_assoc();
                    $name = $record["Name"];
 
            ?>
                    <div class="d-flex">
                        <?php 
                            echo $name. " uzrakstīja";
                        ?>
                    </div>
                    <div class="container border-top border-dark">
                        <p style = "word-wrap: break-word" class="post text-wrap">
                            <?php 
                                echo $row["Text"];
                            ?> 
                        </p> 
                    </div>
            <?php
                endwhile;
                $conn->close();
            ?> 
        <?php 
            if(isset($_SESSION["name"]) && isset($_SESSION["email"])):                               
        ?>  
            <div class = "form-container container border">
                <form  action="createMessage.php" autocomplete="off" method="POST">
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
                        <h5> Izveidot jaunu ziņojumu</h5>
                        <input type="hidden" name="topicId" id="topicId" value="<?php echo $id;?>"/>
                        <textarea class="w-100" name="message" id="message"></textarea>
                    </div>
                    <br>
                    <button class = "my-2 btn-primary" type = "submit">Atsūtīt</button>
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