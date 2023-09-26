<?php
include_once 'conn.php';
session_start();
    $inView = 0;
    if(isset($_SESSION['category'])){
        if($_SESSION['category'] == 'showing'){
            echo '
            <script>
                window.location.href = "profile.php";
            </script>
            ';
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
   
    <link rel="stylesheet" href="style.css">
    <title>Home</title>
</head>
<body class="Listings" id="Listings">
    <div class="header" id="listing-header">
        <h1>Home</h1>
        <div class="search" id="listing-search">
            <form id="searchForm" method="POST">
                <input name="searchQ" type="text"/>
                <button type="submit" name="search"><i class="fa-solid fa-search"></i></button>
            </form>
         </div> 
        <span class="menuBar" id="menuBars" onClick="showMenu()"><i class="fa-solid fa-bars"></i></span>
        <?php
            include_once 'menu.php';
        ?>
    </div>
    <?php
        if(isset($_GET['action'])){
            if($_GET['action'] == 'logIn'){
               ?>
            <div class="homePage">             
                <form action="processing.php" method="post" id="logInForm">
                <span  onClick="back()"><i class="fa-solid fa-x"></i></span>
                    <div class="registerForm" >
                        <input type="text" placeholder="email address" name="emailAddress">
                        <div class="loginPswd" id="loginPwsd" tabindex="0">
                            <input type="password" id="password" placeholder="password" name="password">&nbsp;<p onclick="pswdDisplay()" id="showPswd" >Show</p>
                        </div>
                    </div>
                    <button class="btn lg logIn" type="submit" name="logIn" style="margin-top:0;">Log In</button>
                    <span id="signUpOption">OR</span>
                    <button class="btn lg logIn"><a href="index.php?action=signUp">Sign Up</a></button>
                </form>
            </div>
           
               <?php
            }
            if($_GET['action'] == 'signUp'){
                ?>
                <div class="homePage">
<form action="processing.php" method="post" id="regForm">
<span  onClick="back()"><i class="fa-solid fa-x"></i></span>
    <div class="registerForm">
        <input type="text" placeholder="full name" name="name" required>
        <input type="text" placeholder="email address" name="emailAddress" required>
        <div class="loginPswd">
            <input type="password" id="password" placeholder="password" name="password">&nbsp;<p onclick="pswdDisplay()" id="showPswd" >Show</p>
        </div>
        <div id="passwordChecker">
            <label class="pswd-warning"><i class="fa fa-check"></i> 8 -20 characters long</label>
            <label class="pswd-warning"><i class="fa fa-check"></i> Includes an uppercase letter</label>
            <label class="pswd-warning"><i class="fa fa-check"></i> Includes a number</label>
            <label class="pswd-warning"><i class="fa fa-check"></i> Includes a symbol</label>
            <label class="pswd-warning"><i class="fa fa-check"></i> Does not include spaces</label>
        </div>
        <div class="category">
            <div id="category1">
                <label>Hunters</label><br>
                <input type="radio" name="category" value="looking" required><br>
            </div>
            <div class="pop-up" id="hunter-description">
                <p>Find Your Dream Home</p>
            </div>
            <div  id="category2">
                <label>Scouts</label><br>
                <input type="radio" name="category"value="Showing" required><br>
            </div>
            <div class="pop-up" id="scouts-description">
                <p>Discover Great Properties</p>
            </div>
        </div>
    </div>
    <a href=""><button class="btn lg logIn" type="submit" name="signUp">Sign Up</button></a>
</form>
            </div>
 

                <?php
            }
            ?>
             <style>
                .mainListing{
                    opacity: 0.75;
                }
                </style>
                           <script>
                    // JavaScript to show/hide the chat popup on hover
const category1 = document.getElementById('category1');
const popUp1 = document.getElementById('hunter-description');

category1.addEventListener('mouseover', () => {
    popUp1.style.display = 'block';
});

category1.addEventListener('mouseout', () => {
    popUp1.style.display = 'none';
});

const category2 = document.getElementById('category2');
const popUp2 = document.getElementById('scouts-description');

category2.addEventListener('mouseover', () => {
    popUp2.style.display = 'block';
});

category2.addEventListener('mouseout', () => {
    popUp2.style.display = 'none';
});
                var formSubmitted = false;
var searchTimeout;
function pswdDisplay(){
    let showPswd = document.getElementById('showPswd');
    let pswd = document.getElementById("password");
    if(pswd.type == "text"){
        pswd.type = "password";
        showPswd.innerHTML = "Show";
    }else{
        pswd.type = "text";
        showPswd.textContent = "Hide";
        pswd.style.border = "none";
    }
}

 //password checker functionality for registration form
 //declare the variabes storing the element containing the password and the one containing the text indicating the passwords strength
 let password =  document.getElementById('password');
let checker =  document.getElementById('passwordChecker');
let warnings = document.getElementsByClassName('pswd-warning');

//check for upper case letters
let poorRegExp = /[a-z]/;

//check for numbers
let weakRegExp = /(?=.*?[0-9])/;

//check for symbols
let strongRegExp = /(?=.*?[#?!@$%^&*-])/;

//check for spaces
let whitespaceRegExp = /^$|\s+/;

//when password is entered
password.oninput = function(){
    // display div containing warnings
    checker.style.display = 'grid';

    //store value of password in variable
    let passwordValue = password.value;

    if(passwordValue.length < 8 || passwordValue.length > 20){
        warnings[0].style.color = "red";
    }else if(passwordValue.length > 8 || passwordValue.length < 20){
        warnings[0].style.color = "green";
    }

    //check for upper case letters in password
    let upperCaseChecker= passwordValue.match(poorRegExp);

    if(upperCaseChecker){
        warnings[1].style.color = "green";
    }
    else if(!upperCaseChecker  && !(passwordValue.length > 8 || passwordValue.length < 20)){
        warnings[1].style.color = "red";
    }

    //check for numbers in password
    let numbersChecker= passwordValue.match(weakRegExp);

    if(numbersChecker){
        warnings[2].style.color = "green";
    }else if(!numbersChecker && !(passwordValue.length > 8 || passwordValue.length < 20)){
        warnings[2].style.color = "red";
    }

    //check for symbols in password
    let symbolsChecker= passwordValue.match(strongRegExp);

    if(symbolsChecker){
        warnings[3].style.color = "green";
    }else if(!symbolsChecker  && !(passwordValue.length > 8 || passwordValue.length < 20)){
        warnings[3].style.color = "red";
    }

    //check for spaces in password
    let whitespaceChecker= passwordValue.match(whitespaceRegExp);

    if(whitespaceChecker){
        warnings[4].style.color = "red";
    }else if(!whitespaceChecker && (passwordValue.length > 8 || passwordValue.length < 20)){
        warnings[4].style.color = "green";
    }
}
function isPasswordStrong(password) {
        // Regular expressions to check for upper case letters, numbers, symbols, and spaces
        let upperCaseRegExp = /[A-Z]/;
        let numbersRegExp = /(?=.*?[0-9])/;
        let symbolsRegExp = /(?=.*?[#?!@$%^&*-])/;
        let whitespaceRegExp = /\s/;

        // Check the password against the regular expressions
        return (
            password.length >= 8 &&
            password.length <= 20 &&
            upperCaseRegExp.test(password) &&
            numbersRegExp.test(password) &&
            symbolsRegExp.test(password) &&
            !whitespaceRegExp.test(password)
        );
    }

    // Function to handle form submission
    document.getElementById('regForm').onsubmit = () =>{
        let password = document.getElementById('password').value;
        let isStrongPassword = isPasswordStrong(password);

        // If the password is not strong, prevent form submission
        if (!isStrongPassword) {
            event.preventDefault();
            alert('Password must be 8 - 20 characters long and include an uppercase letter, a number, and a symbol. Password must not include spaces.');
        }
    }
                </script>
            <?php
        }
    ?>
    <div class="mainListing">
        <div class="filterSection" id="filterSection">
            <div id="openFilters" >
                <i class="fa-solid fa-filter" onClick="filters()"></i>
            </div>
            <div id="openFilters2" onClick="closeFilters()"><span>Filters</span><i class="fa-solid fa-angle-up"></i></div>
            <form class="filters" id="filters" method="post">
                <div id="filterCost">
                    <label>Cost</label>
                    <input name="cost" type="number" placeholder="<?php echo isset($_POST['filter']) || isset($_GET['filter']) ? htmlspecialchars($_POST['cost']) : ''; ?>"/>
                </div>
                <div id="filterLocation">
                    <label>Location</label>
                    <input name="location" type="text" placeholder="<?php echo isset($_POST['filter']) || isset($_GET['filter']) ? htmlspecialchars($_POST['location']) : ''; ?>"/>
                </div>
                <div id="filterBedrooms">
                    <label>Bedrooms</label>
                    <input name="bedrooms" type="number" placeholder="<?php echo isset($_POST['filter']) || isset($_GET['filter']) ? htmlspecialchars($_POST['bedrooms']) : ''; ?>"/>
                </div>
                <div id="filterBathrooms">
                    <label>Bathrooms</label>
                    <input name="bathrooms" type="number" placeholder="<?php echo isset($_POST['filter']) || isset($_GET['filter']) ? htmlspecialchars($_POST['bathrooms']) : ''; ?>"/>
                </div>
                <div id="filterSize">
                    <label>Size in sqft</label>
                    <input name="size" type="number" placeholder="<?php echo isset($_POST['filter']) || isset($_GET['filter']) ? htmlspecialchars($_POST['size']) : ''; ?>"/>
                </div>
                <div class="submit">
                    <input name="filter" type="submit" value="Apply"/>
                </div>
            </form>

        </div>
        <div class="allCards" id="allCards">
        <?php

            if(isset($_POST['search']) || (isset($_GET['search']))){
                ob_start();
            ?>
            <h4 class="searchTitle">From your search</h4>
                <div class="cards" id="searchResults">
        <?php
         $userID = 0;
         $searchQ = $_POST['searchQ'];
         $keywords = explode(' ', $searchQ);
         if (count($keywords) > 0) {
             $conditions = [];
             foreach ($keywords as $keyword) {
                 if ($keyword === 'sale' || $keyword === 'for' || $keyword === 'for sale') {
                     $conditions[] = "category LIKE '%sale%'";
                 } else {
                     $conditions[] = "category = '$keyword' OR cost = '$keyword' OR location = '$keyword' OR size = '$keyword' OR bedroomNo = '$keyword'";
                 }
             }
         
             $searchResults = "SELECT * FROM units WHERE " . implode(" OR ", $conditions) . " ORDER BY likes DESC";
         }        
         
                $fullQ =  mysqli_query($conn, $searchResults);
                if (mysqli_num_rows($fullQ) > 0) {
                    $i=0;
                    while($result = mysqli_fetch_array($fullQ)) {
                        $userID = $result['userID'];
                        $tour = explode('*', $result['virtualTour']);
                        $inView = $result['id'];

                ?>
            <div class="singleCard" id="singleCard<?php echo $result['id']?>" >
                <img src="Uploads/<?php echo $tour[0]?>" class="previewImg " alt=""/>
                <div>
                    <?php
                    if($result['category'] == 'forSale'){
                    ?>
                    <p class="category">For sale</p>
                    <?php
                    }elseif($result['category'] == 'rental'){
                    ?>
                        <p class="category">Rental</p>
                        <?php
                        }
                        ?>
<a href="index.php?likes=<?php $byID = 0; if(isset($_SESSION['id'])){ $byID =$_SESSION['id'] ;} echo urlencode($result['likes']).'&id='.$result['id'].'&by='.$byID?>">
                        <button class="like-btn">
                            <i class="fa fa-heart" <?php
                                                        $unitID=$result['id'];
                                                        if(isset($_SESSION['id'])){
                                                            $by = $_SESSION['id'];
                                                        }else{
                                                            $by = 0;
                                                        }
                                                        $stmt=mysqli_query($conn,"SELECT likedBy FROM units where id='$unitID'");
                                                        $row  = mysqli_fetch_array($stmt);
                                                        //if sql query is executed...
                                                        if(is_array($row))
                                                        {
                                                        $likedBy = explode('*', $row['likedBy']);
                                                        if(in_array($by, $likedBy)){
                                                            echo 'style="color: #c89364"';
                                                        }
                                                    
                                                        ?>>
                            </i>
                            <span><?php echo $result['likes']?></span>
                        </button>
                    </a>
                </a>
                </div>
                    <div>
                        <p><?php echo $result['bedroomNo']?> bedroom house</p>
                        <a href="<?php if(!isset($_SESSION['id'])){echo 'index.php?action=logIn';}else{ echo 'listingChat.php?inV='.$inView;}?>">
                            <i class="fa-solid fa-message"></i>
                        </span>
                    </a>
                    </div>
                    <p>Ksh <?php echo $result['cost']?></p>
                    <p><i class="fa fa-location-dot"></i> <?php echo $result['location']?>&nbsp;&nbsp;
                        <i class="fa fa-ellipsis"onclick="showDetails(<?php echo $result['id']?>)"></i>
            </div>
            <?php
            $i++;
            }}}else {
                echo '<p style="margin-left: 1em">no result matching your search has been found</p>';
            }
            ?>
    </div>
            <?php
            }
            $searchResultsHTML = ob_get_clean(); // Get the buffered HTML content
            echo $searchResultsHTML;
            // exit; 
        ?>
        <?php
         $userID = 0;
         if (isset($_POST['filter']) || isset($_GET['filter'])) {
                $cost = $_POST['cost'] ?? '';
                $location = $_POST['location'] ?? '';
                $bedrooms = $_POST['bedrooms'] ?? '';
                $bathrooms = $_POST['bathrooms'] ?? '';
                $size = $_POST['size'] ?? '';
        
            // Prepare the SQL query with the filter criteria
            $sql = "SELECT * FROM units WHERE";
            $conditions = [];
        
            if (!empty($cost)) {
                $conditions[] = "cost = '" . mysqli_real_escape_string($conn, $cost) . "'";
                echo '<style>
                #filterCost{
                    background-color: rgba(200, 147, 100, 0.3);
                }
                </style>';
            }
        
            if (!empty($location)) {
                $conditions[] = "location = '" . mysqli_real_escape_string($conn, $location) . "'";
                echo '<style>
                #filterLocation{
                    background-color: rgba(200, 147, 100, 0.3);
                }
                </style>';
            }
        
            if (!empty($bedrooms)) {
                $conditions[] = "bedroomNo = '" . mysqli_real_escape_string($conn, $bedrooms) . "'";
                echo '<style>
                #filterBedrooms{
                    background-color: rgba(200, 147, 100, 0.3);
                }
                </style>';
            }
        
            if (!empty($bathrooms)) {
                $conditions[] = "bathroomNo = '" . mysqli_real_escape_string($conn, $bathrooms) . "'";
                echo '<style>
                #filterBathrooms{
                    background-color: rgba(200, 147, 100, 0.3);
                }
                </style>';
            }
        
            if (!empty($size)) {
                $conditions[] = "size = '" . mysqli_real_escape_string($conn, $size) . "'";
                echo '<style>
                #filterSize{
                    background-color: rgba(200, 147, 100, 0.3);
                }
                </style>';
            }
        
            if (empty($conditions)) {
                // No filters applied, retrieve all units
                $sql = "SELECT * FROM units";
            } else {
                // Add the conditions to the SQL query
                $sql .= ' ' . implode(' AND ', $conditions);
            }
        
            $sql .= " ORDER BY CASE WHEN " . implode(' AND ', $conditions) . " THEN 0 ELSE 1 END, likes DESC";

            echo "
            <script>
            if (screenWidth > 750) {
                document.getElementById('allCards').style.marginLeft = '12.5%';
                document.getElementById('filterSection').style.marginLeft = '5%';
        
            }else{
                document.getElementById('allCards').style.marginLeft = '7.5%';
                document.getElementById('filterSection').style.marginLeft = '15%';
            }
        
            document.getElementById('filters').style.display = 'block';
            document.getElementById('openFilters').style.display = 'none';
            document.getElementById('openFilters2').style.display = 'flex';
            </script>

            ";
            ?>
                        <h4 class="searchTitle" id="filterResult">From your filter search</h4>
                    <div class="cards" id="filterResults">
        <?php
        $records = mysqli_query($conn, $sql);
        if (mysqli_num_rows($records) > 0) {
            $i=0;
            while($result = mysqli_fetch_array($records)) {
                $userID = $result['userID'];
                $tour = explode('*', $result['virtualTour']);
                $inView = $result['id'];
                ?>
            <div class="singleCard" id="singleCard<?php echo $result['id']?>">
                <img src="Uploads/<?php echo $tour[0]?>" class="previewImg " alt=""/>
                <div>
                    <?php
                    if($result['category'] == 'forSale'){
                    ?>
                    <p class="category">For sale</p>
                    <?php
                    }elseif($result['category'] == 'rental'){
                    ?>
                        <p class="category">Rental</p>
                        <?php
                        }
                        ?>
<a href="index.php?likes=<?php $byID = 0 ; if(isset($_SESSION['id'])){ $byID = $_SESSION['id'];} echo urlencode($result['likes']).'&id='.$result['id'].'&by='.$byID?>">
                        <button class="like-btn">
                            <i class="fa fa-heart" <?php
                                                        $unitID=$result['id'];
                                                        if(isset($_SESSION['id'])){
                                                            $by = $_SESSION['id'];
                                                        }else{
                                                            $by = 0;
                                                        }
                                                        $stmt=mysqli_query($conn,"SELECT likedBy FROM units where id='$unitID'");
                                                        $row  = mysqli_fetch_array($stmt);
                                                        //if sql query is executed...
                                                        if(is_array($row))
                                                        {
                                                        $likedBy = explode('*', $row['likedBy']);
                                                        if(in_array($by, $likedBy)){
                                                            echo 'style="color: #c89364"';
                                                        }
                                                    
                                                        ?>>
                            </i>
                            <span><?php echo $result['likes'];}?></span>
                        </button>
                    </a>

                </div>
                    <div>
                        <p><?php echo $result['bedroomNo']?> bedroom house</p>
                        <a href="<?php if(!isset($_SESSION['id'])){echo 'index.php?action=logIn';}else{ echo 'listingChat.php?inV='.$inView;}?>">
                        <span id="card<?php echo $result['id']?>">
                            <i class="fa-solid fa-message"></i>
                        </span>
                    </a>
                    </div>
                    <p>Ksh <?php echo $result['cost']?></p>
                    <p><i class="fa fa-location-dot"></i> <?php echo $result['location']?>&nbsp;&nbsp;<i class="fa fa-ellipsis"onclick="showDetails(<?php echo $result['id']?>)" ></i>
            </div>
            <?php
            $i++;
            }}else{
                ?>
                <p style="margin-left: 1em;">There are no units matching your filter criteria</p>
        <?php
                }
            ?>
    </div>
            <?php
         }
        ?>
        <div class="cards" >
        <?php
            $sql = "SELECT * FROM units ORDER BY likes DESC";
        $records = mysqli_query($conn, $sql);
        if (mysqli_num_rows($records) > 0) {
            $i=0;
            while($result = mysqli_fetch_array($records)) {
                $userID = $result['userID'];
                $inView = $result['id'];
                ?>
            <div class="singleCard" id="singleCard<?php echo $result['id']?>">
            <?php
            $tour = explode('*', $result['virtualTour']);
            if(strstr($tour[0],'.mp4')){
                        ?>
                        <video controls>
                            <source src="Uploads/<?php echo $tour[0]?>" type="video/mp4">
                        </video>
                        <?php
                        }else if(strstr($tour[0],'.jpg') || strstr($tour[0],'.png')){
                            ?>
                        <img src="Uploads/<?php echo $tour[0]?>" class="previewImg" id="slide<?php echo 0?>" alt="living room"/>
                        <?php
                        } 
                        ?>
                    <div>
                    <?php
                    if($result['category'] == 'forSale'){
                    ?>
                    <p class="category">For sale</p>
                    <?php
                    }elseif($result['category'] == 'rental'){
                    ?>
                        <p class="category">Rental</p>
                        <?php
                        }
                        ?>
<a href="index.php?likes=<?php $byID = 0 ; if(isset($_SESSION['id'])){ $byID = $_SESSION['id'];} echo urlencode($result['likes']).'&id='.$result['id'].'&by='.$byID?>">
                        <button class="like-btn">
                            <i class="fa fa-heart" <?php
                                                        $unitID=$result['id'];
                                                        if(isset($_SESSION['id'])){
                                                            $by = $_SESSION['id'];
                                                        }else{
                                                            $by = 0;
                                                        }
                                                        $stmt=mysqli_query($conn,"SELECT likedBy FROM units where id='$unitID'");
                                                        $row  = mysqli_fetch_array($stmt);
                                                        //if sql query is executed...
                                                        if(is_array($row))
                                                        {
                                                        $likedBy = explode('*', $row['likedBy']);
                                                        if(in_array($by, $likedBy)){
                                                            echo 'style="color: #c89364"';
                                                        }
                                                    
                                                        ?>>
                            </i>
                            <span><?php echo $result['likes'];}?></span>
                        </button>
                    </a>
                </div>
                    <div>
                        <p><?php echo $result['bedroomNo']?> bedroom house</p>
                        <a href="<?php if(!isset($_SESSION['id'])){echo 'index.php?action=logIn';}else{ echo 'listingChat.php?inV='.$inView;}?>">
                        <span id="card<?php echo $result['id']?>">
                            <i class="fa-solid fa-message"></i>
                        </span>
                    </a>
                    </div>
                    <p>Ksh <?php echo $result['cost']?></p>
                    <p><i class="fa fa-location-dot"></i> <?php echo $result['location']?>&nbsp;&nbsp;<i class="fa fa-ellipsis"onclick="showDetails(<?php echo $result['id']?>)" ></i>
            </div>
            <?php
            $i++;
            }}
            ?>
    </div>
        </div>
</div>
</div>
</body>
<?php

if(isset($_GET['likes'])){
    if(!isset($_SESSION['id'])){
        echo '
            <script>
            window.location .href ="index.php?action=logIn"
            </script>
        ';
    }
    $by = $_GET['by'];
    $id = $_GET['id'];
    $sql=mysqli_query($conn,"SELECT likedBy FROM units where id='$id'");
    $row  = mysqli_fetch_array($sql);
    //if sql query is executed...
    if(is_array($row))
    {
    $likedBy = explode('*', $row['likedBy']);
    if(in_array($by, $likedBy)){
        $likes = $_GET['likes'] + 1;
        $likedBy =str_replace($row['likedBy'], '*'.$by, '');
        $sql2 = "UPDATE units SET likes ='$likes', likedBy='$likedBy' where id = '$id'";

    //if sql query is executed...
    if (mysqli_query($conn, $sql2)) {
        echo '
        <script>
        window.location .href ="index.php"
        </script>
    ';
           } else {	
               //show error
       echo "Error: " . $sql2 . "
" . mysqli_error($conn);
    }
    //close connection
    mysqli_close($conn);

    }else{
        $likes = $_GET['likes'] - 1;
        $sql2 = "UPDATE units SET likes ='$likes', likedBy=concat(likedBy,'*','$by') where id = '$id'";

    //if sql query is executed...
    if (mysqli_query($conn, $sql2)) {
      
    } else {	
               //show error
       echo "Error: " . $sql2 . "
" . mysqli_error($conn);
    }
    //close connection
    mysqli_close($conn);
    }
    }
    
}
    if(isset($_SESSION['category'])){
        if($_SESSION['category'] == 'showing'){
        echo '<script> 
            window.location.href = "profile.php";
            </script>';
    }}
?>

    <script src="https://kit.fontawesome.com/2751fbc624.js" crossorigin="anonymous"></script>
    <script src="code.jquery.com_jquery-3.6.0.min.js"></script>
    <!-- <script src="script.js"  ></script> -->
<script>



    function back(){
        window.location.href = "index.php";
    }
    function signUp(){
        window.location.href = "index.php?action=signUp";
    }

    const filters = () => {
    const screenWidth = window.innerWidth;

    // // Check if the screen width is larger than 750px
    if (screenWidth > 750) {
        document.getElementById('allCards').style.marginLeft = '12.5%';
        document.getElementById('filterSection').style.marginLeft = '5%';

    }else{
        document.getElementById('allCards').style.marginLeft = '7.5%';
        document.getElementById('filterSection').style.marginLeft = '15%';
    }

    document.getElementById('filters').style.display = 'block';
    document.getElementById('openFilters').style.display = 'none';
    document.getElementById('openFilters2').style.display = 'flex';
    window.scrollTo({
            top: 0,
            behavior: 'smooth'
        });
}

const closeFilters = () =>{
    document.getElementById('allCards').style.marginLeft = '7.5%';
    document.getElementById('filters').style.display = 'none';
    document.getElementById('filterSection').style.marginLeft = '0';
    document.getElementById('openFilters').style.display = 'block';
    document.getElementById('openFilters2').style.display = 'none';
    document.getElementById('filterResults').style.display = 'none';
    document.getElementById('filterResult').style.display = 'none';

}
const showMenu = () =>{
    document.getElementById('menuBars').style.display = 'none';
    document.getElementById('menu').style.display = 'block';
    // document.getElementById('listing-header').style.width = '80%';
    // let screenWidth = window.innerWidth ;
    // document.getElementById('listing-search').style.width = screenWidth * 0.28 + "px";
    // console.log( document.getElementById('listing-search').style.width);
}
const closeMenu = () =>{
    document.getElementById('menuBars').style.display = 'block';
    document.getElementById('menu').style.display = 'none';
    // document.getElementById('listing-header').style.width = '100%';
    // document.getElementById('listing-search').style.width = '30%';
}
const showDetails = (id) =>{
    window.location.href = "listing-details.php?id=" + id;
}

function handleSearchForm() {
    // Perform any necessary form processing here

    // Clear the timeout and submit the form
    clearTimeout(searchTimeout);
    $('#searchForm').submit();
  }
  // Function to submit the filters form
$('#filters').on('submit', function(event){
    event.preventDefault(); // Prevent the form from submitting normally
    document.getElementById('filters').style.display = 'block';
    document.getElementById('openFilters').style.display = 'none';
    document.getElementById('openFilters2').style.display = 'flex';
    // Perform the AJAX request
    $.ajax({
      url: 'index.php?filter=1',
      type: 'POST',
      data: $(this).serialize(),
      success: function(response) {
        // Update the search results container with the received response
        $('#Listings').html(response);
      },
      error: function(xhr, status, error) {
        console.log(error); // Handle any errors
      }
    });
});


  $('#searchForm').on('submit', function(event) {
    event.preventDefault(); // Prevent the form from submitting normally
    // Perform the AJAX request
    $.ajax({
      url: 'index.php?search=1',
      type: 'POST',
      data: $(this).serialize(),
      success: function(response) {
        // Update the search results container with the received response
        $('#Listings').html(response);
        formSubmitted = true;

        // Delay executing fetchData for 5 seconds (5000 milliseconds)
        setTimeout(fetchData, 15000);
        clearTimeout(searchTimeout); // Clear any existing timeout

    // Set a new timeout to delay the form submission by 2 seconds (adjust as needed)
    searchTimeout = setTimeout(function() {
        handleSearchForm();
        }, 300000); // Delay in milliseconds
      },
      error: function(xhr, status, error) {
        console.log(error); // Handle any errors
      }
    });
  });


 // Event listener for like link
 $('.like-link').on('click', function(event) {
    event.preventDefault();

    var link = $(this);
    var likes = parseInt(link.data('likes'));
    var id = link.data('id');
    var by = link.data('by');
    var isLiked = link.hasClass('liked');

    // Perform the AJAX request
    $.ajax({
      url: 'listingChat.php?likes',
      type: 'GET',
      data: {
        likes: likes,
        id: id,
        by: by
      },
      success: function(response) {
        if (isLiked) {
          link.removeClass('liked');
        } else {
          link.addClass('liked');
        }
        fetchData();
      },
      error: function(xhr, status, error) {
        console.log(error); // Handle any errors
      }
    });
  });
  
function fetchData() {
  if (!formSubmitted) {
    $.ajax({
      url: 'index.php', // Replace with your server-side script URL
      method: 'GET',
      success: function(response) {
        // Handle the response and update the HTML content
        $('#Listings').html(response);
        console.log("all good");
      },
      error: function(xhr, status, error) {
        // Handle errors
        console.error(error);
      }
    });
  }
}

// Call the getNewData function periodically to fetch new data
setInterval(fetchData, 60000);

</script>
</html>
