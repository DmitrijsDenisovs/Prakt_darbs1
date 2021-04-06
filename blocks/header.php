<div class="d-grid  p-3 px-md-4 mb-3 bg-white border-bottom shadow-sm">
  <div class = "row">  
    <div class = "col-8 heading-div">
        <h3>Bazēts forums</h3>
    </div>
      <div class="col toolbar d-grid my-2 my-md-0 ">
        <div class = "row">
          <div class="my-md-2 col-sm">
              <a class="w-100 btn btn-outline-primary" href="index.php">Sākumlapa</a>
            </div>  
            <?php
              if(!isset($_SESSION["name"]) && !isset($_SESSION["email"])):
            ?>    
              <div class="my-md-2 col-sm">
                <a class="w-100 btn btn-outline-primary" href="loginWindow.php">Ienākt</a>
              </div>    
              <div class="my-md-2 col-sm">
                <a class="w-100 btn btn-success" href="registerWindow.php">Reģistrācija</a>
              </div>  
            <?php
              else:
                $dataFile = fopen("confidentialData\admin.txt", "r");
                $adminEmail = fread($dataFile, filesize("confidentialData\admin.txt"));
                fclose($dataFile);
                if($_SESSION["email"] == $adminEmail):
            ?>
              <div class="my-md-2 col-sm">
                <a class="w-100 btn btn-secondary" href = "admin.php">Admin</a>
              </div>  
              <?php
                else:
              ?>
                <div class="my-md-2 col-sm">
                <a class="w-100 btn btn-secondary" href = "user.php">Mans konts</a>
              </div>  
              <?php
                endif;
              ?>
              <div class="my-md-2 col-sm">
                <a class="w-100 btn btn-warning" href = "logout.php">Iznākt</a>
              </div>  
            <?php
              endif;
            ?>  
          </div> 
      </div>
  </div> 
 </div>
