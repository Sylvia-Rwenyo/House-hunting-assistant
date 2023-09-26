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
                $folderPath = 'Preview/'; // Specify the folder path you want to scan
                $files = scandir($folderPath);
                $fileNames = [];
                
                if ($files !== false) {
                    // Loop through the files and ignore . and ..
                    foreach ($files as $file) {
                        if ($file !== '.' && $file !== '..') {
                            $fileNames[] = $file; // Store the file name in the array
                        }
                    }
                } else {
                    echo "Failed to scan the folder.";
                }
                if(!isset($_GET['a'])){
            ?>
                <form class="card mainAddform" method="post" enctype="multipart/form-data" action="processing.php">
                <div class="others">  
                        <label>Select the category that this unit falls under</label>
                            <div>
                                <input name="category" type="radio" value="For sale"/>
                                <label for="category">For sale</label>
                            </div>   
                            <div>
                                <input name="category" type="radio" value="For renting"/>
                                <label for="category">For renting</label>
                            </div>                               
                    </div>
                        <!-- <select name="payPlan" id="payPlan">
                            <option disabled selected>payment plan</option>
                            <option value="mortgage">Mortgage</option>
                            <option value="opt2">Opt 2</option>
                        </select> -->
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
                    <div class="others">  
                        <label>Select the category that this unit falls under</label>
                            <?php
                                $selectedCategory = $_SESSION['unitCategory'];
                                $unitCategories = array(
                                    'For renting',
                                    'For sale'
                                );
                                
                                foreach ($unitCategories as $category) {
                                    $selected = ($category === $selectedCategory) ? 'checked' : '';
                                    echo '
                                    <div>
                                        <input name="category" type="radio" '. $selected .' value="'. $category .'"/>
                                        <label for="category">'.$category.'</label>
                                    </div>';                                }
                            ?>
                    </div>
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
                        <a class="link-back" href="addUnit.php?a=4">Back</a>
                        <div class="others">  
                            <label>Select the condition of this unit</label>
                                <div>
                                    <input name="condition" type="radio" value="Move-in ready"/>
                                    <label for="condition">Move-in ready</label>
                                </div>   
                                <div>
                                    <input name="condition" type="radio" value="Fixer upper"/>
                                    <label for="condition">Fixer upper</label>
                                </div> 
                                <div>
                                    <input name="condition" type="radio" value="New construction"/>
                                    <label for="condition">New construction</label>
                                </div> 
                                <div>
                                    <input name="condition" type="radio" value="Pre-owned"/>
                                    <label for="condition">Pre-owned</label>
                                </div> 
                        </div>
                        <div class="others">  
                            <label>Select the accessible features available on this unit</label>     
                                <div>
                                    <input name="accessibility[]" type="checkbox" value="Ramp"/>
                                    <label for="accessibility[]">Ramp</label>
                                </div>
                                <div>
                                    <input name="accessibility[]" type="checkbox" value="Elevator" />
                                    <label for="accessibility[]">Elevator</label>
                                </div>
                                <div>
                                    <input name="accessibility[]" type="checkbox" value="Single storey building"/>
                                    <label for="accessibility[]">Single storey building</label>
                                </div>                                                          
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
                    <a class="link-back" href="addUnit.php?a=5">Back</a>
                    <div class="others">  
                        <label>Select the available amenities</label>
                            <div>
                                <input name="amenities[]" type="checkbox" value="Running water"/>
                                <label for="amenities[]">Running water</label>
                            </div>
                            <div>
                                <input name="amenities[]" type="checkbox" value="Gym" />
                                <label for="amenities[]">Gym</label>
                            </div>
                            <div>
                                <input name="amenities[]" type="checkbox" value="Parking space"/>
                                <label for="amenities[]">Parking space</label>
                            </div>
                            <div>
                                <input name="amenities[]" type="checkbox" value="Playground"/>
                                <label for="amenities[]">Playground</label>
                            </div>
                            <div>
                                <input name="amenities[]" type="checkbox" value="Laundry machine" />
                                <label for="amenities[]">Laundry machine</label>
                            </div>
                            <div>
                                <input name="amenities[]" type="checkbox" value="Storage Area"/>
                                <label for="amenities[]">Storage Area</label>
                            </div>
                            <div>
                                <input name="amenities[]" type="checkbox" value="High speed internet"/>
                                <label for="amenities[]">High speed internet</label>
                            </div>
                            <div>
                                <input name="amenities[]" type="checkbox" value="Home office" />
                                <label for="amenities[]">Home office</label>
                            </div>
                            <div>
                                <input name="amenities[]" type="checkbox" value="Storage Area"/>
                                <label for="amenities[]">Storage Area</label>
                            </div>
                    </div>
                    <div class="others"> 
                        <label>Select other perks</label>
                            <div>
                                <input name="others[]" type="checkbox" value="Fireplace"/>
                                <label for="others[]">Fireplace</label>
                            </div>
                            <div>
                                <input name="others[]" type="checkbox" value="Pets allowed" />
                                <label for="others[]">Pets allowed</label>
                            </div>
                            <div>
                                <input name="others[]" type="checkbox" value="Swimming pool" />
                                <label for="others[]">Swimming pool</label>
                            </div>
                            <div>
                                <input name="others[]" type="checkbox" value="Furnished"/>
                                <label for="others[]">Furnished</label>
                            </div> 
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
                    <a class="link-back" href="addUnit.php?a=4">Back</a>
                    <div class="others">
                        <label>Select the condition of this unit</label>
                            <?php
                                $selectedCondition = $_SESSION['condition'];
                                $unitConditions = array(
                                    'Move-in ready',
                                    'Fixer-upper',
                                    'New construction',
                                    'Pre-owned'
                                );
                                
                                foreach ($unitConditions as $condition) {
                                    $selected = ($condition === $selectedCondition) ? 'checked' : '';
                                    echo '
                                    <div>
                                        <input name="condition" type="radio" '. $selected .' value="'. $condition .'"/>
                                        <label for="condition">'.$condition.'</label>
                                    </div>';                                }
                            ?>
                    </div>
                    <div class="others">
                        <label>Select the accessible features available on this unit</label>
                            <?php
                            echo (implode(' ',  $_SESSION['accessibility']));
                                $selectedAccessibility = $_SESSION['accessibility'];
                                $availableAccessibility = array(
                                    'Ramp',
                                    'Elevator',
                                    'Single storey building'
                                );
                                
                                foreach ($availableAccessibility as $accessibility) {
                                    $selected = (in_array($accessibility, $selectedAccessibility)) ? 'checked' : '';
                                    echo '
                                        <div>
                                            <input name="accessibility[]" type="checkbox" '. $selected .' value="'. $accessibility .'"/>
                                            <label for="accessibility[]">'.$accessibility.'</label>
                                        </div>';
                                }
                            ?>
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
                <a class="link-back" href="addUnit.php?a=5">Back</a>
                    <div class="others">
                        <label>Select the available amenities</label>
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
                                    $selected = (in_array($amenity, $selectedAmenities)) ? 'checked' : '';
                                    echo '
                                    <div>
                                        <input name="amenities[]" type="checkbox" '. $selected .' value="'. $amenity .'"/>
                                        <label for="amenities[]">'.$amenity.'</label>
                                    </div>';                                }
                            ?>
                    </div>
                    <div class="others">
                        <label>Select other perks</label>
                            <?php
                                $selectedPerks = $_SESSION['others'];
                                $availablePerks = array(
                                    'Swimming pool',
                                    'Fireplace',
                                    'Pets allowed',
                                    'Furnished'
                                );
                                
                                foreach ($availablePerks as $other) {
                                    $selected = (in_array($other, $selectedPerks)) ? 'checked' : '';
                                    echo '
                                    <div>
                                        <input name="others[]" type="checkbox" '. $selected .' value="'. $other .'"/>
                                        <label for="others[]">'.$other.'</label>
                                    </div>';                                }
                            ?>
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
            <div class="card mainAddform mediaForm"  id="section-three-a" >
                <a class="link-back" href="addUnit.php?a=8">Back</a>
                <h5>Upload Virtual Tour</h5>
                <div class="virtualTour" >
                    <label>Sitting room</label>
                    <div class="main">
                        <?php
                        if (isset($_GET['tour'])) {
                            $valueToRemove = $_GET['tour'];
                            $indexToRemove = array_search($valueToRemove, $fileNames);
                            if ($indexToRemove !== false) {
                                // Define the file path to delete
                                $fileToDelete = 'Preview/' . $valueToRemove;
                        
                                // Check if the file exists and is successfully deleted
                                if (file_exists($fileToDelete) && unlink($fileToDelete)) {
                                    // Remove the file name from the fileNames array
                                    unset($fileNames[$indexToRemove]);
                        
                                    // Reset array keys to avoid gaps in the array
                                    $fileNames = array_values($fileNames);
                        
                                    // Redirect the user
                                    header('Location: addUnit.php?a=9');
                                    exit(); // Ensure that no further code execution occurs after the redirect
                               
                            }
                        }}
                        
                        echo '
                        <script>
                            function uncheck(checkbox) {
                                let i = checkbox.value;
                                window.location.href = "addUnit.php?a=9&tour=" + i; 
                            }
                        </script>';  
                        $sittingRoomTour = array();
                        $inputLabels = ['Corner 1', 'Corner 2', 'Ceiling', 'Floor']; // Define input labels here
                        
                        if (!empty($fileNames)) {
                            // Create an associative array to organize the files
                            $organizedTour = array_fill_keys($inputLabels, null);
                        
                            foreach ($fileNames as $image) {
                                foreach ($inputLabels as $label) {
                                    if (stristr($image, 'sittingRoom') && stristr($image, $label)) {
                                        // Assign the file name to the corresponding position in the organizedTour array
                                        $organizedTour[$label] = $image;
                                        break; // Break the inner loop when a match is found
                                    }
                                }
                            }
                        
                            // Convert the organizedTour array to a simple indexed array
                            $sittingRoomTour = array_values($organizedTour);
                        }else{
                            $sittingRoomTour = [null, null, null, null];
                        }
                        

                        for ($i = 0; $i < count($sittingRoomTour); $i++) {
                            ?>
                            <form class="single-file-input"  method="post" enctype="multipart/form-data" action="fileUploads.php">
                                <?php
                                    if($sittingRoomTour[$i] == null){
                                ?>
                                      <div class="custom-file-input">
                                    <label for="fileInput">
                                        <i class="fa-solid fa-plus"></i>
                                        <input type="file" id="prevTour2" name="virtualTour[]" multiple accept=".jpg, .jpeg, .mp4, .png" required/>
                                    </label>
                                </div>
                                <input type="hidden" name="position" value="<?php echo $inputLabels[$i]; ?>"/>
                                <input type="hidden" name="room" value="sittingRoom"/>
                                <?php
                                    }else{
                                ?>
                                    <div class="prevTour" style="background: url('Preview/<?php echo $sittingRoomTour[$i]; ?>') no-repeat;
                                        background-position: center; background-size: cover; ">
                                        <input type="checkbox" value="<?php echo $sittingRoomTour[$i]; ?>" checked onclick="uncheck(this)" />
                                    </div>
                                    <?php
                                     }
                                    ?>
                            <span><?php echo $inputLabels[$i]; ?></span>
                        </form>
                        <?php
                    }
                    ?>
                </div>
                </div>

            <div class="virtualTour"  method="post" enctype="multipart/form-data" action="processing.php">
                <label>Kitchen</label>
                <div class="main">
                        <?php
                         $kitchenTour = array();
                         $inputLabels = ['Corner 1', 'Corner 2', 'Ceiling', 'Floor']; // Define input labels here
                         
                         if (!empty($fileNames)) {
                             // Create an associative array to organize the files
                             $organizedTour = array_fill_keys($inputLabels, null);
                         
                             foreach ($fileNames as $image) {
                                 foreach ($inputLabels as $label) {
                                     if (stristr($image, 'kitchen') && stristr($image, $label)) {
                                         // Assign the file name to the corresponding position in the organizedTour array
                                         $organizedTour[$label] = $image;
                                         break; // Break the inner loop when a match is found
                                     }
                                 }
                             }
                         
                             // Convert the organizedTour array to a simple indexed array
                             $kitchenTour = array_values($organizedTour);
                         }else{
                            $kitchenTour = [null, null, null, null];
                         }
                        
                        for ($i = 0; $i < count($kitchenTour); $i++) {
                            ?>
                            <form class="single-file-input"  method="post" enctype="multipart/form-data" action="fileUploads.php">
                                <?php
                                    if($kitchenTour[$i] == null){
                                ?>
                                      <div class="custom-file-input">
                                    <label for="fileInput">
                                        <i class="fa-solid fa-plus"></i>
                                        <input type="file" id="prevTour2" name="virtualTour[]" multiple accept=".jpg, .jpeg, .mp4, .png" required/>
                                    </label>
                                </div>
                                <input type="hidden" name="position" value="<?php echo $inputLabels[$i]; ?>"/>
                                <input type="hidden" name="room" value="kitchen"/>
                                <?php
                                    }else{
                                ?>
                                    <div class="prevTour" style="background: url('Preview/<?php echo $kitchenTour[$i]; ?>') no-repeat;
                                        background-position: center; background-size: cover; ">
                                        <input type="checkbox" value="<?php echo $kitchenTour[$i]; ?>" checked onclick="uncheck(this)" />
                                    </div>
                                    <?php
                                     }
                                    ?>
                            <span><?php echo $inputLabels[$i]; ?></span>
                        </form>
                        <?php
                    }
                        ?>
                </div>
                    </div>
            <div class="virtualTour" >
                <label>Bathroom</label>
                <div class="main">
                        <?php
                         $bathroomTour = array();
                         $inputLabels = ['Corner 1', 'Corner 2', 'Ceiling', 'Floor']; // Define input labels here
                         
                         if (!empty($fileNames)) {
                             // Create an associative array to organize the files
                             $organizedTour = array_fill_keys($inputLabels, null);
                         
                             foreach ($fileNames as $image) {
                                 foreach ($inputLabels as $label) {
                                     if (stristr($image, 'bathroom') && stristr($image, $label)) {
                                         // Assign the file name to the corresponding position in the organizedTour array
                                         $organizedTour[$label] = $image;
                                         break; // Break the inner loop when a match is found
                                     }
                                 }
                             }
                         
                             // Convert the organizedTour array to a simple indexed array
                             $bathroomTour = array_values($organizedTour);
                         }else{
                            $bathroomTour = [null, null, null, null];
                         }
                        
                        for ($i = 0; $i < count($bathroomTour); $i++) {
                            ?>
                            <form class="single-file-input"  method="post" enctype="multipart/form-data" action="fileUploads.php">
                                <?php
                                    if($bathroomTour[$i] == null){
                                ?>
                                      <div class="custom-file-input">
                                    <label for="fileInput">
                                        <i class="fa-solid fa-plus"></i>
                                        <input type="file" id="prevTour2" name="virtualTour[]" multiple accept=".jpg, .jpeg, .mp4, .png" required/>
                                    </label>
                                </div>
                                <input type="hidden" name="position" value="<?php echo $inputLabels[$i]; ?>"/>
                                <input type="hidden" name="room" value="bathroom"/>
                                <?php
                                    }else{
                                ?>
                                    <div class="prevTour" style="background: url('Preview/<?php echo $bathroomTour[$i]; ?>') no-repeat;
                                        background-position: center; background-size: cover; ">
                                        <input type="checkbox" value="<?php echo $bathroomTour[$i]; ?>" checked onclick="uncheck(this)" />
                                    </div>
                                    <?php
                                     }
                                    ?>
                            <span><?php echo $inputLabels[$i]; ?></span>
                        </form>
                        <?php
                    }
                        ?>
                </div>
            </div>
                <?php
                    if(isset($_SESSION["bedroomNo"])){
                        for($k = 0; $k < $_SESSION["bedroomNo"]; $k++){
                ?>
            <div class="virtualTour"  method="post" enctype="multipart/form-data" action="processing.php">
                <label>Bedroom <?php echo $k + 1 ?></label>
                <div class="main">
                    <?php                        
                        $bedroomTour = array();
                         $inputLabels = ['Corner 1', 'Corner 2', 'Ceiling', 'Floor']; // Define input labels here
                         $name ='bedroom' . $k+1;

                         if (!empty($fileNames)) {
                             // Create an associative array to organize the files
                             $organizedTour = array_fill_keys($inputLabels, null);

                             foreach ($fileNames as $image) {
                                 foreach ($inputLabels as $label) {
                                     if (stristr($image, $name) && stristr($image, $label)) {
                                         // Assign the file name to the corresponding position in the organizedTour array
                                         $organizedTour[$label] = $image;
                                         break; // Break the inner loop when a match is found
                                     }
                                 }
                             }
                         
                             // Convert the organizedTour array to a simple indexed array
                             $bedroomTour = array_values($organizedTour);
                         }else{
                            $bedroomTour = [null, null, null, null];
                         }
                        
                        for ($i = 0; $i < count($bedroomTour); $i++) {
                            ?>
                            <form class="single-file-input"  method="post" enctype="multipart/form-data" action="fileUploads.php">
                                <?php
                                    if($bedroomTour[$i] == null){
                                ?>
                                      <div class="custom-file-input">
                                    <label for="fileInput">
                                        <i class="fa-solid fa-plus"></i>
                                        <input type="file" id="prevTour2" name="virtualTour[]" multiple accept=".jpg, .jpeg, .mp4, .png" required/>
                                    </label>
                                </div>
                                <input type="hidden" name="position" value="<?php echo $inputLabels[$i]; ?>"/>
                                <input type="hidden" name="room" value="<?php echo $name ?>"/>
                                <?php
                                    }else{
                                ?>
                                    <div class="prevTour" style="background: url('Preview/<?php echo $bedroomTour[$i]; ?>') no-repeat;
                                        background-position: center; background-size: cover; ">
                                        <input type="checkbox" value="<?php echo $bedroomTour[$i]; ?>" checked onclick="uncheck(this)" />
                                    </div>
                                    <?php
                                     }
                                    ?>
                            <span><?php echo $inputLabels[$i]; ?></span>
                        </form>
                        <?php
                    }
                        ?>
                    </div>
                    
                    </div>
                <?php
                        }}
                ?>
                    <button style="display: none" class="btn lg logIn" type="submit" name="preview">Preview</button>
                    <a  href="processing.php?action=uploadUnit" class="btn lg logIn">Done</a>

                    </div>
            <?php
            }
             }} else if($_GET['action'] == 'editUpload'){             
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
                    <div class="others">
                        <label>Select the condition of this unit</label>
                            <?php
                                $selectedcategory = isset($_SESSION['unitCategory']) ? $_SESSION['category'] : $result['category'];

                                $unitcategory = array(
                                    'For renting',
                                    'For sale'
                                );
                                
                                foreach ($unitcategory as $category) {
                                    $selected = ($category === $selectedcategory) ? 'checked' : '';
                                    echo '
                                    <div>
                                        <input name="category" type="radio" '. $selected .' value="'. $category .'"/>
                                        <label for="category">'.$category.'</label>
                                    </div>';                                }
                            ?>
                    </div>
                        <input type="hidden" value='<?php echo $result['userID']?>'   name="userID"/>
                        <input type="text" placeholder="Cost"   name="cost" value="<?php echo isset($_SESSION['cost']) ? $_SESSION['cost']:$result['cost'];?>" />
                        <input type="text" placeholder="location"  name="location" value="<?php echo isset($_SESSION['location']) ? $_SESSION['location']:$result['location'];?>"/>
                        <input type="text" placeholder="Size in sqft"  name="size" value="<?php echo isset($_SESSION['size']) ? $_SESSION['size']:$result['size'];?>"/>
                        <input type="text" placeholder="Bedrooms"  name="bedroomNo" value="<?php echo isset($_SESSION['bedroomNo']) ? $_SESSION['bedroomNo']:$result['bedroomNo'];?>"/>
                        <input type="text" placeholder="Bathrooms"  name="bathroomNo" value="<?php echo isset($_SESSION['bathroomNo']) ? $_SESSION['bathroomNo']:$result['bathroomNo'];?>"/>
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
                        <a class="link-back" href="addUnit.php?action=editUpload&id=<?php echo $_GET['id']?>">Back</a>
                        <div class="others">
                            <label>Select the condition of this unit</label>
                                <?php
                              $selectedCondition = isset($_SESSION['unitCondition']) ? $_SESSION['unitCondition']: $result['unitCondition'];
                              $unitConditions = array(
                                  'Move-in ready',
                                  'Fixer-upper',
                                  'New construction',
                                  'Pre-owned'
                              );
                              
                              foreach ($unitConditions as $condition) {
                                  $selected = ($condition === $selectedCondition) ? 'checked' : '';
                                  echo '
                                  <div>
                                      <input id="condition_' . $condition . '" name="condition" type="radio" '. $selected .' value="'. $condition .'"/>
                                      <label for="condition_' . $condition . '">'.$condition.'</label>
                                  </div>';
                              }
                              
                                ?>
                        </div>
                    <div class="others">
                        <label>Select the accessible features available on this unit</label>
                            <?php
                                $selectedAccessibility = isset($_SESSION['accessibility']) ?  $_SESSION['accessibility']: explode('*',  $result['accessibility']);
                                $availableAccessibility = array(
                                    'Ramp',
                                    'Elevator',
                                    'Single storey building'
                                );
                                
                                foreach ($availableAccessibility as $accessibility) {
                                    $selected = (in_array($accessibility, $selectedAccessibility)) ? 'checked' : '';
                                    echo '
                                        <div>
                                            <input name="accessibility[]" type="checkbox" '. $selected .' value="'. $accessibility .'"/>
                                            <label for="accessibility[]">'.$accessibility.'</label>
                                        </div>';
                                }
                            ?>
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
                    <a class="link-back" href="addUnit.php?action=editUpload&id=<?php echo $_GET['id']?>&a=2">Back</a>
                    <div class="others">
                        <label>Select the available amenities</label>
                            <?php
                                $selectedAmenities = isset($_SESSION['amenities']) ? $_SESSION['amenities']: explode('*',  $result['amenities']);
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
                                    $selected = (in_array($amenity, $selectedAmenities)) ? 'checked' : '';
                                    echo '
                                    <div>
                                        <input name="amenities[]" type="checkbox" '. $selected .' value="'. $amenity .'"/>
                                        <label for="amenities[]">'.$amenity.'</label>
                                    </div>';                                }
                            ?>
                    </div>
                    <div class="others">
                        <label>Select other perks</label>
                            <?php
                                $selectedPerks = isset($_SESSION['others']) ? $_SESSION['others']: explode('*',  $result['others']);
                                $availablePerks = array(
                                    'Swimming pool',
                                    'Fireplace',
                                    'Pets allowed',
                                    'Furnished'
                                );
                                
                                foreach ($availablePerks as $other) {
                                    $selected = (in_array($other, $selectedPerks)) ? 'checked' : '';
                                    echo '
                                    <div>
                                        <input name="others[]" type="checkbox" '. $selected .' value="'. $other .'"/>
                                        <label for="others[]">'.$other.'</label>
                                    </div>';                                }
                            ?>
                    </div>
                    <input type="hidden" name="editUpload" value="<?php echo $_GET['id']?>"/>
                    <button class="btn lg logIn" type="submit" name="next2">Next</button>
                </form>
                    <?php
                }else if($_GET['a'] == 4){
                    $folderPath = 'Uploads/'; // Specify the folder path you want to scan
                    $files = scandir($folderPath);
                    $fileNames2 = [];
                    
                    if ($files !== false) {
                        // Loop through the files and ignore . and ..
                        foreach ($files as $file) {
                            if ($file !== '.' && $file !== '..') {
                                // Check if the file name contains the number 27
                                if (strpos($file, $_GET['id']) !== false) {
                                    $fileNames2[] = $file; // Store the file name in the array
                                }
                            }
                        }
                    } else {
                        echo "Failed to scan the folder.";
                    }

                    if (isset($_GET['tour'])) {
                        $valueToRemove = $_GET['tour'];
                        $indexToRemove = array_search($valueToRemove, $fileNames);
                        if ($indexToRemove !== false) {
                            // Define the file path to delete
                            $fileToDelete = 'Uploads/' . $valueToRemove;
                    
                            // Check if the file exists and is successfully deleted
                            if (file_exists($fileToDelete) && unlink($fileToDelete)) {
                                // Remove the file name from the fileNames array
                                unset($fileNames2[$indexToRemove]);
                    
                                // Reset array keys to avoid gaps in the array
                                $fileNames2 = array_values($fileNames2);
                    
                                // Redirect the user
                                header('Location: addUnit.php?action=editUpload&a=4');
                                exit(); // Ensure that no further code execution occurs after the redirect
                           
                        }
                    }}
                    
                    echo '
                    <script>
                        function uncheck(checkbox) {
                            let i = checkbox.value;
                            window.location.href = "addUnit.php?a=4&action=editUpload&tour=" + i; 
                        }
                    </script>';

                   echo '<style> 
                    .progress-section div #sec-one, .progress-section div #sec-two, .progress-section div #sec-three{
                        background-color: #c89364;
                    }
                    .progress-section div #sec-four{
                        background-color: #a69a8b;
                    }                    
                    </style>';
                    ?>
                    <div class="card mainAddform mediaForm"  id="editUpload3" method="post" enctype="multipart/form-data" action="processing.php">
                        <a class="link-back" href="addUnit.php?action=editUpload&id=<?php echo $_GET['id']?>&a=3">Back</a>  
                        <h5>Upload Virtual Tour</h5>
                        <div class="virtualTour" >
                        <label>Sitting room</label>
                        <div class="main">
                            <?php
                            echo '
                            <script>
                                function uncheck(checkbox) {
                                    let i = checkbox.value;
                                    window.location.href = "addUnit.php?a=9&tour=" + i; 
                                }
                            </script>';  
                            $sittingRoomTour = array();
                             $inputLabels = ['Corner 1', 'Corner 2', 'Ceiling', 'Floor']; // Define input labels here
                             $name ='sittingRoom';
    
                             if (!empty($fileNames2)) {
                                 // Create an associative array to organize the files
                                 $organizedTour = array_fill_keys($inputLabels, null);
    
                                 foreach ($fileNames2 as $image) {
                                     foreach ($inputLabels as $label) {
                                         if (stristr($image, $name) && stristr($image, $label)) {
                                             // Assign the file name to the corresponding position in the organizedTour array
                                             $organizedTour[$label] = $image;
                                             break; // Break the inner loop when a match is found
                                         }
                                     }
                                 }
                             
                                 // Convert the organizedTour array to a simple indexed array
                                 $sittingRoomTour = array_values($organizedTour);
                             }else{
                                $sittingRoomTour = [null, null, null, null];
                             }
                            
                            for ($i = 0; $i < count($sittingRoomTour); $i++) {
                                ?>
                                <form class="single-file-input"  method="post" enctype="multipart/form-data" action="fileUploads.php">
                                    <?php
                                        if($sittingRoomTour[$i] == null){
                                    ?>
                                          <div class="custom-file-input">
                                        <label for="fileInput">
                                            <i class="fa-solid fa-plus"></i>
                                            <input type="file" id="prevTour2" name="virtualTour[]" multiple accept=".jpg, .jpeg, .mp4, .png" required/>
                                        </label>
                                    </div>
                                    <input type="hidden" name="position" value="<?php echo $inputLabels[$i]; ?>"/>
                                    <input type="hidden" name="room" value="<?php echo $name ?>"/>
                                    <input type="hidden" name="editUpload" value="<?php echo $_GET['id'] ?>"/>
                                    <?php
                                        }else{
                                    ?>
                                        <div class="prevTour" style="background: url('Uploads/<?php echo $sittingRoomTour[$i]; ?>') no-repeat;
                                            background-position: center; background-size: cover; ">
                                            <input type="checkbox" value="<?php echo $sittingRoomTour[$i]; ?>" checked onclick="uncheck(this)" />
                                        </div>
                                        <?php
                                         }
                                        ?>
                                <span><?php echo $inputLabels[$i]; ?></span>
                            </form>
                            <?php
                        }
                            ?>
                    </div>
                    </div>

                <div class="virtualTour"  method="post" enctype="multipart/form-data" action="processing.php">
                    <label>Kitchen</label>
                    <div class="main">
                        <?php
                         $kitchenTour = array();
                          $inputLabels = ['Corner 1', 'Corner 2', 'Ceiling', 'Floor']; // Define input labels here
                          $name ='kitchen';
 
                          if (!empty($fileNames2)) {
                              // Create an associative array to organize the files
                              $organizedTour = array_fill_keys($inputLabels, null);
 
                              foreach ($fileNames2 as $image) {
                                  foreach ($inputLabels as $label) {
                                      if (stristr($image, $name) && stristr($image, $label)) {
                                          // Assign the file name to the corresponding position in the organizedTour array
                                          $organizedTour[$label] = $image;
                                          break; // Break the inner loop when a match is found
                                      }
                                  }
                              }
                          
                              // Convert the organizedTour array to a simple indexed array
                              $kitchenTour = array_values($organizedTour);
                          }else{
                            $kitchenTour = [null, null, null, null];
                         }
                         
                         for ($i = 0; $i < count($kitchenTour); $i++) {
                             ?>
                             <form class="single-file-input"  method="post" enctype="multipart/form-data" action="fileUploads.php">
                                 <?php
                                     if($kitchenTour[$i] == null){
                                 ?>
                                       <div class="custom-file-input">
                                     <label for="fileInput">
                                         <i class="fa-solid fa-plus"></i>
                                         <input type="file" id="prevTour2" name="virtualTour[]" multiple accept=".jpg, .jpeg, .mp4, .png" required/>
                                     </label>
                                 </div>
                                 <input type="hidden" name="position" value="<?php echo $inputLabels[$i]; ?>"/>
                                 <input type="hidden" name="room" value="<?php echo $name ?>"/>
                                 <input type="hidden" name="editUpload" value="<?php echo $_GET['id'] ?>"/>
                                 <?php
                                     }else{
                                 ?>
                                     <div class="prevTour" style="background: url('Uploads/<?php echo $kitchenTour[$i]; ?>') no-repeat;
                                         background-position: center; background-size: cover; ">
                                         <input type="checkbox" value="<?php echo $kitchenTour[$i]; ?>" checked onclick="uncheck(this)" />
                                     </div>
                                     <?php
                                      }
                                     ?>
                             <span><?php echo $inputLabels[$i]; ?></span>
                         </form>
                         <?php
                     }
                         ?>
                    </div>
                        </div>
                <div class="virtualTour" >
                    <label>Bathroom</label>
                    <div class="main">
                        <?php
                           $bathroomTour = array();
                            $inputLabels = ['Corner 1', 'Corner 2', 'Ceiling', 'Floor']; // Define input labels here
                            $name ='bathroom';
   
                            if (!empty($fileNames2)) {
                                // Create an associative array to organize the files
                                $organizedTour = array_fill_keys($inputLabels, null);
   
                                foreach ($fileNames2 as $image) {
                                    foreach ($inputLabels as $label) {
                                        if (stristr($image, $name) && stristr($image, $label)) {
                                            // Assign the file name to the corresponding position in the organizedTour array
                                            $organizedTour[$label] = $image;
                                            break; // Break the inner loop when a match is found
                                        }
                                    }
                                }
                            
                                // Convert the organizedTour array to a simple indexed array
                                $bathroomTour = array_values($organizedTour);
                            }else{
                                $bathroomTour = [null, null, null, null];
                             }
                           
                           for ($i = 0; $i < count($bathroomTour); $i++) {
                               ?>
                               <form class="single-file-input"  method="post" enctype="multipart/form-data" action="fileUploads.php">
                                   <?php
                                       if($bathroomTour[$i] == null){
                                   ?>
                                         <div class="custom-file-input">
                                       <label for="fileInput">
                                           <i class="fa-solid fa-plus"></i>
                                           <input type="file" id="prevTour2" name="virtualTour[]" multiple accept=".jpg, .jpeg, .mp4, .png" required/>
                                       </label>
                                   </div>
                                   <input type="hidden" name="position" value="<?php echo $inputLabels[$i]; ?>"/>
                                   <input type="hidden" name="room" value="<?php echo $name ?>"/>
                                   <input type="hidden" name="editUpload" value="<?php echo $_GET['id'] ?>"/>
                                   <?php
                                       }else{
                                   ?>
                                       <div class="prevTour" style="background: url('Uploads/<?php echo $bathroomTour[$i]; ?>') no-repeat;
                                           background-position: center; background-size: cover; ">
                                           <input type="checkbox" value="<?php echo $bathroomTour[$i]; ?>" checked onclick="uncheck(this)" />
                                       </div>
                                       <?php
                                        }
                                       ?>
                               <span><?php echo $inputLabels[$i]; ?></span>
                           </form>
                           <?php
                       }
                           ?>
                    </div>
                </div>
                    <?php
                        if(isset($result["bedroomNo"])){
                            for($k = 0; $k < $result["bedroomNo"]; $k++){
                    ?>
                <div class="virtualTour"  method="post" enctype="multipart/form-data" action="processing.php">
                    <label>Bedroom <?php echo $k + 1 ?></label>
                    <div class="main">
                    <?php                        
                        $bedroomTour = array();
                         $inputLabels = ['Corner 1', 'Corner 2', 'Ceiling', 'Floor']; // Define input labels here
                         $name ='bedroom' . $k+1;

                         if (!empty($fileNames2)) {
                             // Create an associative array to organize the files
                             $organizedTour = array_fill_keys($inputLabels, null);

                             foreach ($fileNames2 as $image) {
                                 foreach ($inputLabels as $label) {
                                     if (stristr($image, $name) && stristr($image, $label)) {
                                         // Assign the file name to the corresponding position in the organizedTour array
                                         $organizedTour[$label] = $image;
                                         break; // Break the inner loop when a match is found
                                     }
                                 }
                             }
                         
                             // Convert the organizedTour array to a simple indexed array
                             $bedroomTour = array_values($organizedTour);
                         }else{
                            $bedroomTour = [null, null, null, null];
                         }
                        
                        for ($i = 0; $i < count($bedroomTour); $i++) {
                            ?>
                            <form class="single-file-input"  method="post" enctype="multipart/form-data" action="fileUploads.php">
                                <?php
                                    if($bedroomTour[$i] == null){
                                ?>
                                      <div class="custom-file-input">
                                    <label for="fileInput">
                                        <i class="fa-solid fa-plus"></i>
                                        <input type="file" id="prevTour2" name="virtualTour[]" multiple accept=".jpg, .jpeg, .mp4, .png" required/>
                                    </label>
                                </div>
                                <input type="hidden" name="position" value="<?php echo $inputLabels[$i]; ?>"/>
                                <input type="hidden" name="room" value="<?php echo $name ?>"/>
                                <input type="hidden" name="editUpload" value="<?php echo $_GET['id'] ?>"/>
                                <?php
                                    }else{
                                ?>
                                    <div class="prevTour" style="background: url('Uploads/<?php echo $bedroomTour[$i]; ?>') no-repeat;
                                        background-position: center; background-size: cover; ">
                                        <input type="checkbox" value="<?php echo $bedroomTour[$i]; ?>" checked onclick="uncheck(this)" />
                                    </div>
                                    <?php
                                     }
                                    ?>
                            <span><?php echo $inputLabels[$i]; ?></span>
                        </form>
                        <?php
                    }
                        ?>
                        </div>
                        
                        </div>
                    <?php
                            }}
                    ?>                        
                    <input type="hidden" name="editUpload" value="<?php echo $_GET['id']?>"/>
                    <!-- <button  class="btn lg logIn" type="submit" name="editUnit">Done</button> -->
                    <a  href="processing.php?action=editUnit&id=<?php echo $_GET['id']?>"class="btn lg logIn" style="color: black">Done</a>
                    </div>
        <?php
        $i++;
        }}}}
            ?>
        </div>
        <div class="pop-up select-prompt">
            <p>Hold down your ctrl key while clicking on multiple options</p>
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

const selectMultiple = document.querySelectorAll('select[multiple]');
const popUp1 = document.getElementsByClassName('select-prompt');

// Loop through each element with the 'multiple' attribute
selectMultiple.forEach(element => {
  // Add a mouseover event listener to each element
  element.addEventListener('mouseover', () => {
    // Assuming popUp1 is an array or NodeList, you might need to access it by index
    // You can use popUp1[0] if it's an array-like structure
    popUp1[0].style.display = 'block';
  });

  // Add a mouseout event listener to each element
  element.addEventListener('mouseout', () => {
    // Assuming popUp1 is an array or NodeList, you might need to access it by index
    // You can use popUp1[0] if it's an array-like structure
    popUp1[0].style.display = 'none';
  });
});

const customUploadAreas = document.getElementsByClassName('custom-file-input');

Array.from(customUploadAreas).forEach(element => {
  element.addEventListener('click', () => {
    const fileInput = element.querySelector('input[type="file"]');
    // Find the parent form element of the file input
    const parentForm = element.closest('form');

    // Trigger a click event on the file input
    fileInput.click();

    // Listen for the change event on the file input
    fileInput.addEventListener('change', () => {
      // Submit the parent form
      parentForm.submit();
    });
  });
});


 </script>