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
    <?php
        include "blocks\header.php";
    ?>
    <div class = "container">
        <div class="d-grid  p-3 px-md-4 mb-3 bg-white">
            <div class = "row">
                <div class="my-md-2 col-sm">
                <a class="w-100 btn btn-outline-primary" href="clientTable.php" target = "outputFrame">Lietotāji</a>
                </div>
                <div class="my-md-2 col-sm">
                <a class="w-100 btn btn-outline-primary" href="topicTable.php" target = "outputFrame">Tēmas</a>
                </div>   
                <div class="my-md-2 col-sm">
                <a class="w-100 btn btn-outline-primary" href="messageTable.php" target = "outputFrame">Ziņojumi</a>
                </div> 
            </div>
        </div>
        <div class="embed-responsive embed-responsive-16by9">
            <iframe name = "outputFrame" style="width:100%; min-height: 400px;"  class="embed-responsive-item"></iframe>
        </div>  
    </div>
    <?php
        include "blocks\\footer.php";
    ?>  
</body>