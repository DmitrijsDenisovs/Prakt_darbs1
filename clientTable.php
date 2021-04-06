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
            $sqlQuery = "SELECT * FROM Client ORDER BY ". $_GET["order"]. " ASC";
        else
            $sqlQuery = "SELECT * FROM Client";
        $clients = $conn->query($sqlQuery);
    ?>
        <table class = "table">
            <thead>
                <tr>
                    <th scope="col"><a href = "clientTable.php?order=Email" >E-pasts</a></th>
                    <th scope="col"><a href = "clientTable.php?order=Name">Vārds</a></th>
                    <th scope="col"><a href = "clientTable.php?order=Password">Parole</a></th>
                </tr>
            </thead>
            <tbody>
            <?php
                while($record = $clients->fetch_assoc()):
                    $email = $record["Email"];
                    $name = $record["Name"];
                    $password = $record["Password"];
            ?>
                <tr>
                    <th scope="row"><?php echo $email; ?></th>
                    <td><?php echo $name; ?></td>
                    <td><?php echo $password; ?></td>
                    <?php
                        $dataFile = fopen("confidentialData\admin.txt", "r");
                        $adminEmail = fread($dataFile, filesize("confidentialData\admin.txt"));
                        fclose($dataFile);
                        if($email != $adminEmail):
                    ?>
                        <td><a class="w-100 btn btn-danger" href="deleteRecord.php?table=Client&key=<?php echo $email;?>">Dzēst</a></td>
                    <?php
                        endif;
                    ?>
                    
                </tr>
            <?php
                endwhile;
            ?>
            </tbody>
        </table>
    </div>
</body>