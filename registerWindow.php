<?php
    session_start();
    if(isset($_COOKIE["name"])){
        $_SESSION["name"] = $_COOKIE["name"];
    }
    if(isset($_COOKIE["email"])){
        $_SESSION["email"] = $_COOKIE["email"];
    }
?>   
<!DOCTYPE html>
<head>
    <title>Unreal Login</title>
    <meta charset="UTF8"/>
    <script src="js\scripts.js"></script>
    <link href="style\style.css" rel = "stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" 
        rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

</head>
<body>
    <?php
        include "blocks\header.php";
    ?>
    <div class = "form-container container border">
        <form action="register.php" autocomplete="off" method="POST">
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
            <div class = "form-group">
                <label for="email">E-pasts</label>
                <input class = "form-control" name = "email" id = "email" type = "email" required/>
            </div>
            <div class = "form-group">
                <label for="name">Vārds</label>
                <input class = "form-control" name = "name" id = "name" type = "text" required/>
            </div>
            <label for="passowrd">Parole</label>
            <div class = "d-flex form-group">
                <input class = "form-control" name = "password" id = "password" type = "password"required/>
                <input class="mx-2 mt-2" type = "checkbox" onclick='togglePasswordVisibility("password")'/>
            </div>
            <label for="rep-passowrd">Atkārtota parole</label>
            <div class = "d-flex form-group">
                <input class = "form-control" name = "rep-password" id = "rep-password" type = "password"required/>
                <input class="mx-2 mt-2" type = "checkbox" onclick='togglePasswordVisibility("rep-password")'/>
            </div>
            <br>
            <button class = "my-2 btn-primary" type = "submit">Piereģistrēties</button>
        </form>
     
    </div>
    <?php
        include "blocks\\footer.php";
    ?>  
</body>   