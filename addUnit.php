<?php
 session_start();
 include_once 'conn.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
   
    <!-- bootstrap cdn links -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://kit.fontawesome.com/2751fbc624.js" crossorigin="anonymous"></script>
    
    <script src="script.js" ></script>
    <link rel="stylesheet" href="style.css">
    <title>Upload Unit</title>
</head>
<body class="addUnit">
    <div class="header">
        <h1>New upload</h1>
        <span class="menuBar" id="menuBars" onClick="showMenu()"><i class="fa-solid fa-bars"></i></span>
        <?php
            include_once 'menu.php';
        ?>
    </div>
    </div>
    <div class="progress-section ">
                <p class="Msg1">This form has four parts, fill all sections accordingly</p>
                <div class="progress-bars">
                    <span id="sec-one"><span id="sec-one-x"></span></span>
                    <span id="sec-two"><span id="sec-two-x"></span></span>
                    <span id="sec-three"><span id="sec-three-x"></span></span>
                    <span id="sec-four"><span id="sec-three-x"></span></span>
                </div>
            </div>
    <div class="addUnitForm">
            <?php
            echo '<style>
            a{
                text-decoration: none;
                color: white;
            </style>';
            if(!isset($_GET['action'])){
                if(!isset($_GET['a'])){
            ?>
                <form class="card mainAddform" method="post" enctype="multipart/form-data" action="processing.php">
                        <select name="category" required>
                            <option disabled selected>category</option>
                            <option id="saleOpt" value="forSale">For sale</option>
                            <option value="rental">For renting</option>
                        </select>
                        <select name="payPlan" id="payPlan">
                            <option disabled selected>payment plan</option>
                            <option value="mortgage">Mortgage</option>
                            <option value="opt2">Opt 2</option>
                        </select>
                        <input type="hidden" value='<?php echo $_SESSION['id']?>'   name="userID" />
                        <input type="text" placeholder="Cost"   name="cost" required/>
                        <input type="text" placeholder="location"  name="location" required/>
                        <input type="text" placeholder="Size in sqft"  name="size" required/>
                        <input type="number" placeholder="Bedrooms"  name="bedroomNo" required/>
                        <input type="number" placeholder="Bathrooms"  name="bathroomNo" required/>
                        <button class="btn lg logIn" type="submit" name="next1">Next</button>
                </form>
                <?php
                 }
                 else if(isset($_GET['a'])){
                  if($_GET['a'] == 4 && isset($_SESSION['next1'])){
                    echo '<style> 
                    .progress-section div #sec-one{
                        background-color: #c89364;
                    }
                    .progress-section div #sec-two{
                        background-color: #a69a8b;
                    }                    
                    </style>';
                ?>
                 <form class="card mainAddform"  method="post" enctype="multipart/form-data" action="processing.php">
                    <select name="category" required>
                        <?php
                         if($_SESSION['unitCategory'] == "forSale"){?>
                        <option selected><?php echo $_SESSION['unitCategory']?></option>
                        <option value="rental" >For renting</option>
                        <?php
                        }else{
                        ?>
                        <option selected><?php echo $_SESSION['unitCategory']?></option>
                        <option value="forSale" >For sale</option>
                        <?php } ?>
                    </select>
                    <input type="hidden" value='<?php echo $_SESSION['userID']?>'   name="userID"/>
                    <input type="text" placeholder="Cost"   name="cost" value="<?php echo $_SESSION['cost']?>" required />
                    <input type="text" placeholder="location"  name="location" value="<?php echo $_SESSION['location']?>" required/>
                    <input type="text" placeholder="Size in sqft"  name="size" value="<?php echo $_SESSION['size']?>" required/>
                    <input type="text" placeholder="Bedrooms"  name="bedroomNo" value="<?php echo $_SESSION['bedroomNo']?>" required/>
                    <input type="text" placeholder="Bathrooms"  name="bathroomNo" value="<?php echo $_SESSION['bathroomNo']?>" required/>
                    <input type="hidden" value='back'   name="state"/>
                    <button class="btn lg logIn" type="submit" name="next1">Next</button>
                </form>
                <?php
                }
                 if($_GET['a'] == 2)  {
                    echo '<style> 
                    .progress-section div #sec-one{
                        background-color: #c89364;
                    }
                    .progress-section div #sec-two{
                        background-color: #a69a8b;
                    }                    
                    </style>';
                ?>
                <form class="card mainAddform" method="post" enctype="multipart/form-data" action="processing.php">
                        <a href="addUnit.php?a=4">Back</a>
                        <select name="condition" required>
                            <option disabled selected>What is the condition of this unit</option>
                            <option  value="move-in ready">Move-in ready</option>
                            <option value="fixer upper">Fixer upper</option>
                            <option  value="new construction">New construction</option>
                            <option value="pre-owned">Pre-owned</option>
                        </select> 
                        <div class="others">  
                            <label>Select the accessible features available on this unit</label>     
                            <select name="accessibility[]" id="accessibility" multiple size="3" required>
                                <option value="ramp">Ramp</option>
                                <option value="elevator">Elevator</option>
                                <option value="single storey building">Single storey building</option>
                            </select>

                        </div>
                        <button class="btn lg logIn" type="submit" name="next2-1">Next</button>
                </form>
                <?php
                 }
                  if($_GET['a'] == 3)  {
                    echo '<style> 
                    .progress-section div #sec-one, .progress-section div #sec-two {
                        background-color: #c89364;
                    }
                    .progress-section div #sec-three{
                        background-color: #a69a8b;                    
                    </style>';
                ?>
                <form class="card mainAddform" id="section-two-two" method="post" enctype="multipart/form-data" action="processing.php">
                    <a href="addUnit.php?a=5">Back</a>
                    <div class="others">  
                        <label>Select the available amenities</label>
                        <select name="amenities[]" multiple required size="8">
                            <option value="Running water">Running water</option>
                            <option value="Gym">Gym </option>
                            <option value="Storage area">Storage Area </option>
                            <option value="Parking space">Parking space </option>
                            <option value="Playground">Playground </option>
                            <option value="Laundry machine">Laundry machine </option>
                            <option  value="High speed internet">High speed internet</option>
                            <option  value="Home office">Home office</option>
                        </select>
                    </div>
                    <div class="others"> 
                        <label>Select other perks</label> 
                        <select name="others[]" multiple required size="4">
                            <option value="fireplace">Fireplace</option>
                            <option value="pets allowed">Pets allowed</option>
                            <option value="Swimming pool">Swimming pool</option>
                            <option value="furnished">Furnished</option>
                        </select>
                    </div>
                        <button class="btn lg logIn" type="submit" name="next2">Next</button>
                </form>
                <?php
                 }else if($_GET['a'] == 5){
                    echo '<style> 
                    .progress-section div #sec-one,
                    .progress-section div #sec-two{
                        background-color: #c89364;
                    }   
                    .progress-section div #sec-three{
                        background-color: #a69a8b;
                    }                    
                    </style>';
                ?>
                <form class="card mainAddform" id="section-two-a" method="post" enctype="multipart/form-data" action="processing.php">
                    <a href="addUnit.php?a=4">Back</a>
                    <div class="others">
                        <label>Select the condition of this unit</label>
                        <select name="condition" required>
                            <?php
                                $selectedCondition = $_SESSION['condition'];
                                $unitConditions = array(
                                    'Move-in ready',
                                    'Fixer-upper',
                                    'New construction',
                                    'Pre-owned'
                                );
                                
                                foreach ($unitConditions as $condition) {
                                    $selected = ($condition === $selectedCondition) ? 'selected' : '';
                                    echo '<option value="' . $condition . '" ' . $selected . '>' . $condition . '</option>';
                                }
                            ?>
                        </select>
                    </div>
                    <div class="others">
                        <label>Select the accessible features available on this unit</label>
                        <select name="accessibility[]" id="accessibility"multiple required size="3">
                            <?php
                            echo (implode(' ',  $_SESSION['accessibility']));
                                $selectedAccessibility = $_SESSION['accessibility'];
                                $availableAccessibility = array(
                                    'Ramp',
                                    'Elevator',
                                    'Single storey building'
                                );
                                
                                foreach ($availableAccessibility as $accessibility) {
                                    $selected = (in_array($accessibility, $selectedAccessibility)) ? 'selected' : '';
                                    echo '<option value="' . $accessibility . '" ' . $selected . '>' . $accessibility . '</option>';
                                }
                            ?>
                        </select>
                    </div>
                    <input type="hidden" value='back'   name="state"/>
                    <button class="btn lg logIn" type="submit" name="next2-1">Next</button>
                </form>
                <?php
                 }else if($_GET['a'] == 8){
                    echo '<style> 
                    .progress-section div #sec-one,
                    .progress-section div #sec-two{
                        background-color: #c89364;
                    }   
                    .progress-section div #sec-three{
                        background-color: #a69a8b;
                    }                    
                    </style>';
                ?>
            <form class="card mainAddform" id="section-two-b" method="post" enctype="multipart/form-data" action="processing.php">
                <a href="addUnit.php?a=5">Back</a>
                    <div class="others">
                        <label>Select the available amenities</label>
                        <select name="amenities[]" multiple required size="8">
                            <?php
                                $selectedAmenities = $_SESSION['amenities'];
                                $availableAmenities = array(
                                    'Running water',
                                    'Gym',
                                    'Storage area',
                                    'Parking space',
                                    'Playground',
                                    'Laundry machine',
                                    'High speed internet',
                                    'Home office'
                                );
                                
                                foreach ($availableAmenities as $amenity) {
                                    $selected = (in_array($amenity, $selectedAmenities)) ? 'selected' : '';
                                    echo '<option value="' . $amenity . '" ' . $selected . '>' . $amenity . '</option>';
                                }
                            ?>
                        </select>
                    </div>
                    <div class="others">
                        <label>Select other perks</label>
                        <select name="others[]" multiple required size="8">
                            <?php
                                $selectedPerks = $_SESSION['others'];
                                $availablePerks = array(
                                    'Swimming pool',
                                    'Fireplace',
                                    'Pets allowed',
                                    'Furnished'
                                );
                                
                                foreach ($availablePerks as $other) {
                                    $selected = (in_array($other, $selectedPerks)) ? 'selected' : '';
                                    echo '<option value="' . $other . '" ' . $selected . '>' . $other . '</option>';
                                }
                            ?>
                        </select>
                    </div>
                    <button class="btn lg logIn" type="submit" name="next2">Next</button>
                </form>
                <?php
            } else if($_GET['a'] == 9)  {
                echo '<style> 
                .progress-section div #sec-one, .progress-section div #sec-two, .progress-section div #sec-three{
                    background-color: #c89364;
                }
                .progress-section div #sec-four{
                    background-color: #a69a8b;
                }                  
                </style>';
            ?>
            <form class="card mainAddform"  id="section-three-a" method="post" enctype="multipart/form-data" action="processing.php">
                <a href="addUnit.php?a=8">Back</a>
                <div id="virtualTour">
                    <label>Upload Virtual Tour</label> 
                    <div class="main">
                    <?php
                        if (isset($_SESSION['virtualTour'])) {
                        $tour = $_SESSION['virtualTour'];
                    } 
                    if (isset($_GET['tour'])) {
                        $valueToRemove = $_GET['tour'];
                        $indexToRemove = array_search($valueToRemove, $tour);
                        if ($indexToRemove !== false) {
                            array_splice($tour, $indexToRemove, 1);
                            unset($_SESSION['virtualTour'][$indexToRemove]);
                        }
                        echo '<script>window.location.href = "addUnit.php?a=9";</script>';
                    } 
                    if(!empty($_SESSION['virtualTour'])){                          
                    for ($i = 0; $i < count($_SESSION['virtualTour']); $i++) {
                        ?>
                        <div id="prevTour" style="background: url('Uploads/<?php echo $_SESSION['virtualTour'][$i];?>') no-repeat;
                            background-position: center; background-size: cover;">
                            <input type="checkbox" value="<?php echo $_SESSION['virtualTour'][$i];?>" checked onclick="uncheck(this)" />
                        </div>
                        <?php
                    }  }                      
                    echo '
                        <script>
                            function uncheck(checkbox) {
                                let i = checkbox.value;
                                window.location.href = "addUnit.php?action=a=9&tour=" + i; 
                            }
                        </script>';                            
                    ?>
                    <input type="file" id="prevTour2" name="virtualTour[]"  multiple accept=".jpg, .jpeg, .mp4, .png " />
                    </div>
                </div>
                
                    <button class="btn lg logIn" type="submit" name="preview">Preview</button>
            </form>
            <?php
            }
             }
             }if(isset($_GET['action']) ){
                 echo '<style> 
                    .progress-section div #sec-one,
                    .progress-section div #sec-two, 
                    .progress-section div #sec-three, .progress-section div #sec-four{
                        background-color: #c89364;
                    }                  
                    </style>';
                if(($_GET['action'] == 'edit' && !isset($_GET['a']))){
                ?>
                <form class="card mainAddform" id="section-one-edit" method="post" enctype="multipart/form-data" action="processing.php">
                    <select name="category" required>
                        <?php
                         if($_SESSION['unitCategory'] == "forSale"){?>
                        <option selected><?php echo $_SESSION['unitCategory']?></option>
                        <option value="rental" >For renting</option>
                        <?php
                        }else{
                        ?>
                        <option selected><?php echo $_SESSION['unitCategory']?></option>
                        <option value="forSale" >For sale</option>
                        <?php } ?>
                    </select>
                    <input type="hidden" value='<?php echo $_SESSION['userID']?>'   name="userID"/>
                    <input type="text" placeholder="Cost"   name="cost" value="<?php echo $_SESSION['cost']?>" />
                    <input type="text" placeholder="location"  name="location" value="<?php echo $_SESSION['location']?>"/>
                    <input type="text" placeholder="Size in sqft"  name="size" value="<?php echo $_SESSION['size']?>"/>
                    <input type="text" placeholder="Bedrooms"  name="bedroomNo" value="<?php echo $_SESSION['bedroomNo']?>"/>
                    <input type="text" placeholder="Bathrooms"  name="bathroomNo" value="<?php echo $_SESSION['bathroomNo']?>"/>
                    <input type="hidden"  name="edit" value="edit"/>
                    <button class="btn lg logIn" type="submit" name="next1">Next</button>
                </form>
                <?php
                }else if($_GET['action'] == 'edit' && ($_GET['a'] == 2) ){
                ?>
                 <form class="card mainAddform" id="section-two-edit" method="post" enctype="multipart/form-data" action="processing.php">
                    <a href="addUnit.php?action=edit">Back</a>
                    <div class="others">
                        <label>Select the condition of this unit</label>
                        <select name="condition" required>
                            <?php
                                $selectedCondition = $_SESSION['condition'];
                                $unitConditions = array(
                                    'Move-in ready',
                                    'Fixer-upper',
                                    'New construction',
                                    'Pre-owned'
                                );
                                
                                foreach ($unitConditions as $condition) {
                                    $selected = ($condition === $selectedCondition) ? 'selected' : '';
                                    echo '<option value="' . $condition . '" ' . $selected . '>' . $condition . '</option>';
                                }
                            ?>
                        </select>
                    </div>
                    <div class="others">
                        <label>Select the accessible features available on this unit</label>
                        <select name="accessibility[]" id="accessibility"multiple required size="3">
                            <?php
                            echo (implode(' ',  $_SESSION['accessibility']));
                                $selectedAccessibility = $_SESSION['accessibility'];
                                $availableAccessibility = array(
                                    'Ramp',
                                    'Elevator',
                                    'Single storey building'
                                );
                                
                                foreach ($availableAccessibility as $accessibility) {
                                    $selected = (in_array($accessibility, $selectedAccessibility)) ? 'selected' : '';
                                    echo '<option value="' . $accessibility . '" ' . $selected . '>' . $accessibility . '</option>';
                                }
                            ?>
                        </select>
                    </div>
                    <input type="hidden"  name="edit" value="edit"/>
                    <button class="btn lg logIn" type="submit" name="next2-1">Next</button>
                </form>
                
                <?php
            }else if( $_GET['action']== 'edit'&& ($_GET['a'] == 3)){
                ?>
                <form class="card mainAddform" id="section-two-b" method="post" enctype="multipart/form-data" action="processing.php">
                <a href="addUnit.php?action=edit&a=2">Back</a>
                    <div class="others">
                        <label>Select the available amenities</label>
                        <select name="amenities[]" multiple required size="8">
                            <?php
                                $selectedAmenities = $_SESSION['amenities'];
                                $availableAmenities = array(
                                    'Running water',
                                    'Gym',
                                    'Storage area',
                                    'Parking space',
                                    'Playground',
                                    'Laundry machine',
                                    'High speed internet',
                                    'Home office'
                                );
                                
                                foreach ($availableAmenities as $amenity) {
                                    $selected = (in_array($amenity, $selectedAmenities)) ? 'selected' : '';
                                    echo '<option value="' . $amenity . '" ' . $selected . '>' . $amenity . '</option>';
                                }
                            ?>
                        </select>
                    </div>
                    <div class="others">
                        <label>Select other perks</label>
                        <select name="others[]" multiple required size="4">
                            <?php
                                $selectedPerks = $_SESSION['others'];
                                $availablePerks = array(
                                    'Swimming pool',
                                    'Fireplace',
                                    'Pets allowed',
                                    'Furnished'
                                );
                                
                                foreach ($availablePerks as $other) {
                                    $selected = (in_array($other, $selectedPerks)) ? 'selected' : '';
                                    echo '<option value="' . $other . '" ' . $selected . '>' . $other . '</option>';
                                }
                            ?>
                        </select>
                    </div>
                    <input type="hidden"  name="edit" value="edit"/>
                    <button class="btn lg logIn" type="submit" name="next2">Next</button>
                </form>
                <?php
                }else if( $_GET['action']== 'edit'&& ($_GET['a'] == 4)){
                ?>
                <form class="card mainAddform"  id="section-three-edit" method="post" enctype="multipart/form-data" action="processing.php">
                <a href="addUnit.php?action=edit&a=3">Back</a>
                <div id="virtualTour">
                    <label>Upload Virtual Tour</label> 
                    <div class="main">
                    <?php
                        if (isset($_SESSION['virtualTour'])) {
                        $tour = $_SESSION['virtualTour'];
                    } 
                    if (isset($_GET['tour'])) {
                        $valueToRemove = $_GET['tour'];
                        $indexToRemove = array_search($valueToRemove, $tour);
                        if ($indexToRemove !== false) {
                            array_splice($tour, $indexToRemove, 1);
                            unset($_SESSION['virtualTour'][$indexToRemove]);
                        }
                        echo '<script>window.location.href = "addUnit.php?a=4&action=edit";</script>';
                    } 
                    if(!empty($_SESSION['virtualTour'])){                          
                    for ($i = 0; $i < count($_SESSION['virtualTour']); $i++) {
                        ?>
                        <div id="prevTour" style="background: url('Uploads/<?php echo $_SESSION['virtualTour'][$i];?>') no-repeat;
                            background-position: center; background-size: cover;">
                            <input type="checkbox" value="<?php echo $_SESSION['virtualTour'][$i];?>" checked onclick="uncheck(this)" />
                        </div>
                        <?php
                    }  }                      
                    echo '
                        <script>
                            function uncheck(checkbox) {
                                let i = checkbox.value;
                                window.location.href = "addUnit.php?a=4&action=edit&tour=" + i; 
                            }
                        </script>';                            
                    ?>
                    <input type="file" id="prevTour2" name="virtualTour[]"  multiple accept=".jpg, .jpeg, .mp4, .png " />
                    </div>
                </div>
                <button class="btn lg logIn" type="submit" name="preview">Preview</button>
            </form>
            <?php
                }
             else if($_GET['action'] == 'editUpload'){
                if(isset($_GET['id'])){
                    $uploadID = $_GET['id'];
                }
                $records = mysqli_query($conn,"SELECT * FROM  units where id= '$uploadID'");
                if (mysqli_num_rows($records) > 0) {
                $i=0;
                while($result = mysqli_fetch_array($records)) {
                    if(!isset($_GET['a'])){
                    ?>
                    <form class="card mainAddform" id="editUpload1" method="post" enctype="multipart/form-data" action="processing.php">
                        <select name="category" required>
                            <?php
                             if($result['category'] == "forSale"){?>
                            <option selected><?php echo $result['category']?></option>
                            <option value="rental" >For renting</option>
                            <?php
                            }else{
                            ?>
                            <option selected><?php echo $result['category']?></option>
                            <option value="forSale" >For sale</option>
                            <?php } ?>
                        </select>
                        <input type="hidden" value='<?php echo $_SESSION['userID']?>'   name="userID"/>
                        <input type="text" placeholder="Cost"   name="cost" value="<?php echo $result['cost']?>" />
                        <input type="text" placeholder="location"  name="location" value="<?php echo $result['location']?>"/>
                        <input type="text" placeholder="Size in sqft"  name="size" value="<?php echo $result['size']?>"/>
                        <input type="text" placeholder="Bedrooms"  name="bedroomNo" value="<?php echo $result['bedroomNo']?>"/>
                        <input type="text" placeholder="Bathrooms"  name="bathroomNo" value="<?php echo $result['bathroomNo']?>"/>
                        <input type="hidden"  name="editUpload" value="<?php echo $_GET['id'] ?>"/>
                        <button class="btn lg logIn" type="submit" name="next1">Next</button>
                    </form>
                    <?php
                    }else if($_GET['a'] == 2){
                     echo '<style> 
                    .progress-section div #sec-one{
                        background-color: #c89364;
                    }
                    .progress-section div #sec-two{
                        background-color: #a69a8b;
                    }                    
                    </style>';
                    ?>
                     <form class="card mainAddform" id="editUpload2" method="post" enctype="multipart/form-data" action="processing.php">
                    <a href="addUnit.php?action=editUpload&id=<?php echo $_GET['id']?>">Back</a>
                    <div class="others">
                        <label>Select the condition of this unit</label>
                        <select name="condition" required>
                            <?php
                                $selectedCondition = $result['unitCondition'];
                                $unitConditions = array(
                                    'Move-in ready',
                                    'Fixer-upper',
                                    'New construction',
                                    'Pre-owned'
                                );
                                
                                foreach ($unitConditions as $condition) {
                                    $selected = ($condition === $selectedCondition) ? 'selected' : '';
                                    echo '<option value="' . $condition . '" ' . $selected . '>' . $condition . '</option>';
                                }
                            ?>
                        </select>
                    </div>
                    <div class="others">
                        <label>Select the accessible features available on this unit</label>
                        <select name="accessibility[]" id="accessibility"multiple required size="3">
                            <?php
                                $selectedAccessibility =explode('*',  $result['accessibility']);
                                $availableAccessibility = array(
                                    'Ramp',
                                    'Elevator',
                                    'Single storey building'
                                );
                                foreach ($availableAccessibility as $accessibility) {
                                    $selected = (in_array($accessibility, $selectedAccessibility)) ? 'selected' : '';
                                    echo '<option value="' . $accessibility . '" ' . $selected . '>' . $accessibility . '</option>';
                                }
                            ?>
                        </select>
                    </div>
                    <input type="hidden" name="editUpload" value="<?php echo $_GET['id']?>"/>
                    <button class="btn lg logIn" type="submit" name="next2-1">Next</button>
                </form>
                <?php
                }else if($_GET['a'] == 3){
                    echo '<style> 
                    .progress-section div #sec-one, .progress-section div #sec-two{
                        background-color: #c89364;
                    }
                    .progress-section div #sec-three{
                        background-color: #a69a8b;
                    }                    
                    </style>';
                    ?>
                <form class="card mainAddform" id="section-two-b" method="post" enctype="multipart/form-data" action="processing.php">
                <a href="addUnit.php?action=editUpload&id=<?php echo $_GET['id']?>&a=2">Back</a>
                    <div class="others">
                        <label>Select the available amenities</label>
                        <select name="amenities[]" multiple required size="8">
                            <?php
                                $selectedAmenities = explode('*', $result['amenities']);
                                $availableAmenities = array(
                                    'Running water',
                                    'Gym',
                                    'Storage area',
                                    'Parking space',
                                    'Playground',
                                    'Laundry machine',
                                    'High speed internet',
                                    'Home office'
                                );
                                
                                foreach ($availableAmenities as $amenity) {
                                    $selected = (in_array($amenity, $selectedAmenities)) ? 'selected' : '';
                                    echo '<option value="' . $amenity . '" ' . $selected . '>' . $amenity . '</option>';
                                }
                            ?>
                        </select>
                    </div>
                    <div class="others">
                        <label>Select other perks</label>
                        <select name="others[]" multiple required size="4">
                            <?php
                                $selectedPerks = explode('*',$result['others']);
                                $availablePerks = array(
                                    'Swimming pool',
                                    'Fireplace',
                                    'Pets allowed',
                                    'Furnished'
                                );
                                
                                foreach ($availablePerks as $other) {
                                    $selected = (in_array($other, $selectedPerks)) ? 'selected' : '';
                                    echo '<option value="' . $other . '" ' . $selected . '>' . $other . '</option>';
                                }
                            ?>
                        </select>
                    </div>
                    <input type="hidden" name="editUpload" value="<?php echo $_GET['id']?>"/>
                    <button class="btn lg logIn" type="submit" name="next2">Next</button>
                </form>
                    <?php
                }else if($_GET['a'] == 4){
                   echo '<style> 
                    .progress-section div #sec-one, .progress-section div #sec-two, .progress-section div #sec-three{
                        background-color: #c89364;
                    }
                    .progress-section div #sec-four{
                        background-color: #a69a8b;
                    }                    
                    </style>';
                    ?>
                    <form class="card mainAddform"  id="editUpload3" method="post" enctype="multipart/form-data" action="processing.php">
                        <a href="addUnit.php?action=editUpload&id=<?php echo $_GET['id']?>&a=3">Back</a>  
                        <div id="virtualTour">
                            <label>Upload Virtual Tour</label> 
                            <div class="main">
                            <?php
                               if (isset($_SESSION['virtualTour'])) {
                                $tour = $_SESSION['virtualTour'];
                            } else {
                                $tour = explode('*', $result['virtualTour']);
                            }
                            
                            if (isset($_GET['tour'])) {
                                $valueToRemove = $_GET['tour'];
                                $indexToRemove = array_search($valueToRemove, $tour);
                                if ($indexToRemove !== false) {
                                    array_splice($tour, $indexToRemove, 1);
                                    unset($_SESSION['virtualTour'][$indexToRemove]);
                                }
                                echo '<script>window.location.href = "addUnit.php?action=editUpload&a=4&id='. $_GET['id'].'";</script>';
                            } else {
                                $_SESSION['virtualTour'] = $tour;
                            }
                            
                            for ($i = 0; $i < count($_SESSION['virtualTour']); $i++) {
                                ?>
                                <div id="prevTour" style="background: url('Uploads/<?php echo $_SESSION['virtualTour'][$i];?>') no-repeat;
                                    background-position: center; background-size: cover;">
                                    <input type="checkbox" value="<?php echo $_SESSION['virtualTour'][$i];?>" checked onclick="uncheck(this)" />
                                </div>
                                <?php
                            }                        
                            echo '
                                <script>
                                    function uncheck(checkbox) {
                                        let i = checkbox.value;
                                        window.location.href = "addUnit.php?action=editUpload&a=4&id='. $_GET['id'].'&tour=" + i; 
                                    }
                                </script>';                            
                            ?>
                            <input type="file" id="prevTour2" name="virtualTour[]"  multiple accept=".jpg, .jpeg, .mp4, .png " />
                            </div>
                        </div>
                        
                    <input type="hidden" name="editUpload" value="<?php echo $_GET['id']?>"/>
                    <button class="btn lg logIn" type="submit" name="preview">Preview</button>
                </form>
        <?php
        $i++;
        }}}}}
        ?>
        </div>
</body>
</html>
<script>
 const showMenu = () =>{
    document.getElementById('menuBars').style.display = 'none';
    document.getElementById('menu').style.display = 'block';
}
const closeMenu = () =>{
    document.getElementById('menuBars').style.display = 'block';
    document.getElementById('menu').style.display = 'none';
}
// document.getElementById("saleOpt").onclick = () =>{
//     document.getElementById('payPlan').style.display = 'block';
// }

// Get the multi-select dropdown
// const accessibility = document.getElementById('accessibility');
// accessibility.value = []; // Initialize as an empty array

// // Function to update the selected options array
// function updateAccessibilityValue() {
//     const selectedOptions = Array.from(accessibility.selectedOptions).map((option) => option.value);
//     // Set the value of the accessibility array to the selected options array
//     accessibility.value = selectedOptions; // Assign the array directly
//     console.log(accessibility.value);
// }

// // Add a change event listener to the select element
// accessibility.addEventListener('change', () => {
//     // Call the function to update the selected options array
//     updateAccessibilityValue();
// });


 </script>