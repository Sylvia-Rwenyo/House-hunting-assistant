<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://kit.fontawesome.com/2751fbc624.js" crossorigin="anonymous"></script>
    <script src="script.js" async></script>
    <link rel="stylesheet" href="style.css">
    <title>Upload Unit</title>
</head>
<body class="addUnit">
    <div class="header">
        <h1>New upload</h1>
        <div class="search">
        <form>
            <input name="keyword" type="text"/>
            <button type="submit"><i class="fa-solid fa-search"></i></button>
        </form>
         </div> 
        <span class="menuBar" id="menuBars" onClick="showMenu()"><i class="fa-solid fa-bars"></i></span>
        <div class="menu" id="menu">
            <span class="menuBar" id="menuBar" onClick="closeMenu()"><i class="fa-solid fa-x"></i></span>
            <ul>
                <a href="listing.php"><li  class="active">Active Listings</li></a>
                <a href="userProfile.php"><li  class="active">Profile</li></a>
                <a href="tools.php"><li  class="active">Tools</li></a>
                <a href="contacts.php"><li  class="active">Help</li></a>
            </ul>
        </div>
    </div>
    </div>
    <div class="addUnitForm">
        <form class="card" id="mainAddform" method="post" enctype="multipart/form-data" action="processing.php">
            <?php
            include_once 'conn.php';
            session_start();
            if(empty($_GET)){
            ?>
                    <select name="category">
                        <option disabled selected>category</option>
                        <option value="forSale">For sale</option>
                        <option value="rental">For renting</option>
                    </select>
                    <input type="hidden" value='<?php echo $_SESSION['userID']?>'   name="userID"/>
                    <input type="text" placeholder="Cost"   name="cost"/>
                    <input type="text" placeholder="location"  name="location"/>
                    <input type="text" placeholder="Size in sqft"  name="size"/>
                    <input type="text" placeholder="Bedrooms"  name="bedroomNo"/>
                    <div id="others" >
                        <label>Select other perks</label>
                        <span>Parking Space<input type="checkbox" name="others[]" value="Parking Space"/></span>
                        <span>Playground<input type="checkbox" name="others[]" value="Playground"/></span>
                    </div>
                  <div id="virtualTour">
                    <label>Upload Virtual Tour</label>  
                    <input type="file" placeholder="" name="virtualTour[]" multiple accept=".jpg, .jpeg, .mp4, .png "/>
                </div>
                <?php
            }else if($_GET['action'] == 'edit'){
                ?>
                 <select name="category" value="<?php echo $_SESSION['category']?>">
                        <option disabled selected>category</option>
                        <option value="forSale">For sale</option>
                        <option value="rental" >For renting</option>
                    </select>
                    <input type="hidden" value='<?php echo $_SESSION['userID']?>'   name="userID"/>
                    <input type="text" placeholder="Cost"   name="cost" value="<?php echo $_SESSION['cost']?>" />
                    <input type="text" placeholder="location"  name="location" value="<?php echo $_SESSION['location']?>"/>
                    <input type="text" placeholder="Size in sqft"  name="size" value="<?php echo $_SESSION['size']?>"/>
                    <input type="text" placeholder="Bedrooms"  name="bedroomNo" value="<?php echo $_SESSION['bedroomNo']?>"/>
                    <div id="others" >
                        <label>Select other perks</label>
                        <?php
                        for($i = 0; $i <count($_SESSION['others']); $i++){
                        ?>
                        <span><?php echo $_SESSION['others'][$i]?><input type="checkbox" name="others[]" value="<?php echo $_SESSION['others'][$i]?>"/></span>
                        <?php
                        }
                        ?>
                    </div>
                  <div id="virtualTour">
                    <label>Upload Virtual Tour</label>  
                    <input type="text" placeholder="" id="prevTour" name="virtualTour[]" value="<?php
                    for($i =0; $i < count($_SESSION['virtualTour']); $i++){
                        echo $_SESSION['virtualTour'][$i] . ' ';
                    }?>" multiple accept=".jpg, .jpeg, .mp4, .png "/>
                </div>
            <?php
             }else if($_GET['action'] == 'editUpload'){
                $uploadID = $_GET['id'];
                $records = mysqli_query($conn,"SELECT * FROM  units where id= '$uploadID'");
                if (mysqli_num_rows($records) > 0) {
                $i=0;
                while($result = mysqli_fetch_array($records)) {
            ?>
             <select name="category" value="<?php echo $result['category']?>">
                    <option disabled selected>category</option>
                    <option value="forSale">For sale</option>
                    <option value="rental" >For renting</option>
                </select>
                <input type="hidden" value='<?php echo $_SESSION['userID']?>'   name="userID"/>
                <input type="text" placeholder="Cost"   name="cost" value="<?php echo $result['cost']?>" />
                <input type="text" placeholder="location"  name="location" value="<?php echo $result['location']?>"/>
                <input type="text" placeholder="Size in sqft"  name="size" value="<?php echo $result['size']?>"/>
                <input type="text" placeholder="Bedrooms"  name="bedroomNo" value="<?php echo $result['bedroomNo']?>"/>
                <div id="others" >
                    <label>Select other perks</label>
                    <?php
                    $others = explode('*', $result['others']);
                    for($i = 0; $i <count($others); $i++){
                    ?>
                    <span><?php echo $others[$i]?><input type="checkbox" name="others[]" value="<?php echo $result['others'][$i]?>"/></span>
                    <?php
                    }
                    ?>
                </div>
              <div id="virtualTour">
                <label>Upload Virtual Tour</label>  
                <input type="text" placeholder="" id="prevTour" name="virtualTour[]" value="<?php
                $tour = explode('*', $result['virtualTour']);
                for($i =0; $i < count($tour); $i++){
                    echo $tour[$i] . ' ';
                }?>" multiple accept=".jpg, .jpeg, .mp4, .png "/>
            </div>
        <?php
        $i++;
        }}}
        ?>
           
                <button class="btn lg logIn" type="submit" name="preview">Preview</button>
            </form>
        </div>
</body>
</html>
<script>
    let prevTour = document.getElementById('prevTour');
prevTour.onclick = () =>{
    prevTour.type = 'file';
}
</script>