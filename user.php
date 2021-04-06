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
        <form autocomplete="off">    
            <div class = "form-group">
                <label for="email">E-pasts</label>
                <input class = "form-control" name = "email" id = "email" type = "email" value = "<?php echo $_SESSION["email"]; ?>" disabled/>
            </div>
            <div class = "form-group">
                <label for="name">Vārds</label>
                <input class = "form-control" name = "name" id = "name" type = "text" value = "<?php echo $_SESSION["name"]?>" disabled/>
            </div>
                 
        </form>
     <a class = "my-2 btn btn-secondary" href="updateUser.php">Mainīt paroli</a>
    </div>
    <?php
        include "blocks\\footer.php";
    ?>  
</body>