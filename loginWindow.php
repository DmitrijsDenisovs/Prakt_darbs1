<?php
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
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
        <form  action="login.php" autocomplete="off" method="POST">
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
                <input class = "form-control" name = "email" id = "email" type = "text"/>
            </div>
            <label for="passowrd">Parole</label>
            <div class = "d-flex form-group">
                <input class = "form-control" name = "password" id = "password" type = "password"/>
                <input class="mx-2 mt-2" type = "checkbox" onclick='togglePasswordVisibility("password")'/>
            </div>
            <br>
            <button class = "my-2 btn-primary" type = "submit">Ienākt</button>
        </form>
     
    </div>
    <?php
        include "blocks\\footer.php";
    ?>  
</body>   