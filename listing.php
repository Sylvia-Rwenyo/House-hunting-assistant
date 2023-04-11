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
    <script src="script.js" ></script>
    <link rel="stylesheet" href="style.css">
    <title>Active Listings</title>
</head>
<body class="Listings">
    <div class="header">
        <h1>Active Listings</h1>
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
    <div class="mainListing">
        <div class="filterSection">
            <div id="openFilters" onClick="filters()"><i class="fa-solid fa-filter"></i></div>
            <div id="openFilters2" onClick="closeFilters()"><span>Sort</span><i class="fa-solid fa-angle-up"></i></div>
                <div class="filters" id="filters">
                    <div>
                        <label>Bedrooms</label>
                        <input name="bedrooms" type="number"/>
                    </div>
                    <div>
                        <label>Bathrooms</label>
                        <input name="bathrooms" type="number"/>
                    </div>
                    <div>
                        <label>Parking space</label>
                    </div>
                </div> 
        </div>
    <div class="list" id="list">
    <?php 
            include_once 'conn.php';
            session_start();
            $userID = 0;
            $records = mysqli_query($conn,"SELECT * FROM  units");
            if (mysqli_num_rows($records) > 0) {
            $i=0;
            while($result = mysqli_fetch_array($records)) {
                $userID = $result['userID'];
        ?>
        <div class="card" id="card<?php echo $result['id']?>">
                <?php
                $tour = explode('*', $result['virtualTour']);
                ?>
                <div class="tourCard" id="firstSlide">
                    <img src="Uploads/<?php echo $tour[0]?>" class="previewImg " alt="living room"/>
                    <a class="prev" onclick ="showImgs()" >&#10094;</a>
                    <a class="next" onclick ="showImgs()" >&#10095;</a>     
                </div>
                <div class="tourCard" id="secondSlide">
                <?php
                // if(isset($_GET['action'])){if ($_GET['action'] == 'showSlides'){
                for($j=0; $j < count($tour); $j++){
                    ?>
                    <img src="Uploads/<?php echo $tour[$j]?>" class="previewImg  slide fade" alt="living room"/>
                    <?php
                // }
            // }
        }
                ?>
                 <a class="prev" onclick ="plusSlides(-1)" >&#10094;</a>
                    <a class="next" onclick ="plusSlides(1)" >&#10095;</a>     
        </div>
               
        <div class="details">
                <div>
                    <h5><?php echo $result['bedroomNo']?> bedroom house</h5>
                    <a href="listingChat.php?with=<?php echo $userID; $_SESSION['inView'] = $result['id']; ?>">
                        <span id="card<?php echo $result['id']?>"><i class="fa-solid fa-message"></i></span>
                    </a>
                    <!-- <span id='pay' onClick="pay()">Pay</span> -->
                </div>
                <div>
                    <p class="first">For <?php if($result["category"] == "forSale"){echo 'sale at Ksh';}
                                    else if($result["category"] == "rental"){echo 'rent at Ksh';} echo $result['cost'];?></p>
                    <p>At <?php echo $result['location']?></p>
                    <p><?php echo $result['size']?> sqft</p>
                </div>
                <div>
                <?php
                $others =explode('*', $result['others']);
                    for($j=0; $j <count($others); $j++){
                ?> 
                <p><?php echo $others[$j];?></p>
                <?php
                };
                ?>
                </div>
        </div>
        </div>
        <?php
        $i++;}}
        ?>
    </div>
</div>
</div>
</body>
</html>
<?php
if(isset($_POST['send'])){
    $message = $_POST['message'];
    $senderID = $_POST['senderID'];
    $receipientID = $_POST['receipientID'];
     date_default_timezone_set("Africa/Nairobi");
     $time = date("Y-m-d h:i:sa");
    $sql = "INSERT INTO messages (message,senderID, receipientID, time)
    VALUES ('$message','$senderID','$receipientID', '$time')";

    //if sql query is executed...
    if (mysqli_query($conn, $sql)) {
        //    header("Location: listing.php"); 
           } else {	
               //show error
       echo "Error: " . $sql . "
" . mysqli_error($conn);
    }
    //close connection
    mysqli_close($conn);
}
?>
<script>
let slideIndex = 1;
showSlides(slideIndex);

function plusSlides(n){
    showSlides(slideIndex += n)
}
function currentSlide(n){
    showSlides(slideIndex = n)
}
function showSlides(n){
    let i;
    let slides = document.getElementsByClassName('slide');
    if( n > slides.length){
        slideIndex = 1
    }
    if(n < 1){slideIndex = slides.length}
    for (i = 0; i< slides.length; i++){
        slides[i].style.display = "none";
    }
    slides[slideIndex - 1].style.display = "block";
}

const pay = () =>{
    document.getElementById('paymentArea').style.display = 'block';
    document.getElementById('message').style.display = 'none';
    document.getElementById('creditCard').style.display = 'block';
}
function showImgs(){
    document.getElementById('firstSlide').style.display = "none";
    document.getElementById('secondSlide').style.display = "block";
}
</script>