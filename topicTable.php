<?php
    require "functions\connectToDatabase.php";
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
    <div class = "container">
    <?php
        $conn = connectToDatabase("admin.php");
        if(isset($_GET["order"]))
            $sqlQuery = "SELECT * FROM Topic ORDER BY ". $_GET["order"]. " ASC";
        else
            $sqlQuery = "SELECT * FROM Topic";
        $topics = $conn->query($sqlQuery);
    ?>
        <table class = "table">
            <thead>
                <tr>
                    <th scope="col"><a href = "topicTable.php?order=ID" >ID</a></th>
                    <th scope="col"><a href = "topicTable.php?order=TopicName">Nosaukums</a></th>
                    <th scope="col"><a href = "topicTable.php?order=Email">Izveidotājs</a></th>
                </tr>
            </thead>
            <tbody>
            <?php
                while($record = $topics->fetch_assoc()):
                    $id = $record["ID"];
                    $topicName = $record["TopicName"];
                    $email = $record["Email"];
            ?>
                <tr>
                    <th scope="row"><?php echo $id; ?></th>
                    <td><?php echo $topicName; ?></td>
                    <td><?php echo $email; ?></td>
                    <td><a class="w-100 btn btn-danger" href="deleteRecord.php?table=Topic&key=<?php echo $id;?>">Dzēst</a></td>
                </tr>
            <?php
                endwhile;
            ?>
            </tbody>
        </table>
    </div>
</body>