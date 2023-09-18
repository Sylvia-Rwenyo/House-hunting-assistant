<?php 
    include_once 'conn.php';
    session_start();
?>

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
    <script src="script.js"></script>
    <link rel="stylesheet" href="style.css">
    <title>New Unit Preview</title>
</head>
<body class="Listings prevPage">
    <div class="header">
        <?php
        echo '<style>.header a{text-decoration: none; color: #323232;}</style>';
        if(isset($_GET['state'])){
            if($_GET['state'] == 'edited'){ 
        ?>
        <a href="addUnit.php?action=editUpload&a=4&id="><h1><i class="fa-solid fa-arrow-left"></i></h1></a>
        <?php
            }}else{
        ?>
        <a href="addUnit.php?a=9"><h1><i class="fa-solid fa-arrow-left"></i></h1></a>
        <?php
            }
        ?>
        <h1>New Unit</h1>
    </div>
    <div class="previewSec">
        <div class="cards">
            <div class="singleCard" id="singleCard<?php echo $_SESSION['id']?>">
        <?php
        $tour = isset($_SESSION['virtualTour']) ? $_SESSION['virtualTour'] : array(); // Check if the array is set
        foreach ($tour as $j => $item) {
            if (strstr($item, '.mp4')) {
                ?>
                <video controls class="previewImg slide">
                    <source src="Uploads/<?php echo $item; ?>" type="video/mp4">
                </video>
                <?php
            } elseif (strstr($item, '.jpg') || strstr($item, '.png')) {
                ?>
                <img src="Uploads/<?php echo $item; ?>" class="previewImg slide" id="slide<?php echo $j; ?>" alt="living room"/>
                <?php
            }
        }
        ?>
    
                <div class="move-slides">
                    <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
                    <a class="next" onclick="plusSlides(1)">&#10095;</a>  
                </div>  
                <?php
                if($_SESSION['unitCategory'] == 'forSale'){
                ?>
                <p class="category">For sale</p>
                <?php
                }elseif($_SESSION['unitCategory'] == 'rental'){
                ?>
                <p class="category">Rental</p>
                <?php
                }
                ?>
                <p><?php echo $_SESSION['bedroomNo']?> bedroom house</p>
                <p><?php echo $_SESSION['bathroomNo']?> bathrooms<?php
                $details = $_SESSION['amenities'];
                for($j=0; $j < count($details); $j++){ 
                    echo strtolower(', '. $details[$j]);
                }?> available
                </p>
                <p>There is a 
                    <?php 
                    $details = $_SESSION['accessibility'];
                    for($j=0; $j < count($details); $j++){ 
                        echo strtolower($details[$j]. ', ');
                    }?>
                    and <?php 
                    $details =  $_SESSION['others'];
                    for($j=0; $j < count($details); $j++){ 
                        echo strtolower($details[$j]. ', ');
                    }?>
                </p>
                <p>Ksh <?php echo $_SESSION['cost']?></p>
                <p><i class="fa fa-location-dot"></i> <?php echo $_SESSION['location']?>&nbsp;&nbsp;</p>
            </div>
        </div>
        <div class="cardBtns">
            <?php
            if(isset($_GET['state'])){
                if($_GET['state'] == 'edited'){ 
            ?>
            <a href="processing.php?action=editUnit&id=<?php echo $_GET['id']?>"><button class="btn upload">Upload</button></a>
            <?php
                }}else{
            ?>
            <a href="processing.php?action=uploadUnit"><button class="btn upload">Upload</button></a>
            <?php } ?>
            <a href="addUnit.php?action=edit"><button class="btn edit">Edit</button></a>
            <a href="preview.php?action=deletePreview"><button class="btn delete">Delete</button></a>
        </div>
    </div>
</div>
</body>
</html>

<?php
if(isset($_GET['action'])){ 
    if($_GET['action'] == 'deletePreview'){
        unset($_SESSION["category"]);
        unset($_SESSION["cost"]);
        unset($_SESSION["size"]);
        unset($_SESSION["bedroomNo"]);
        unset($_SESSION["location"]);
        unset($_SESSION["virtualTour"]);
        unset($_SESSION["amenities"]);
        unset($_SESSION["accessibility"]);
        unset($_SESSION["condition"]);
        unset($_SESSION["others"]);
        echo '<script>window.location.href = "addUnit.php";</script>';
    }
}
?>
 <script>
document.addEventListener("DOMContentLoaded", function() {
    let slideIndex = 1;
    showSlides(slideIndex);

    function plusSlides(n){
        showSlides(slideIndex += n);
    }

    function currentSlide(n){
        showSlides(slideIndex = n);
    }

    function showSlides(n){
        let i;
        let slides = document.getElementsByClassName('slide');
        if (n > slides.length) {
            slideIndex = 1;
        }
        if (n < 1) {
            slideIndex = slides.length;
        }
        for (i = 0; i < slides.length; i++) {
            slides[i].style.display = "none";
        }
        slides[slideIndex - 1].style.display = "block";
    }
});
</script>

</html>
