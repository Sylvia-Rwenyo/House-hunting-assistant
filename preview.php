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
    <script src="script.js" ></script>
    <link rel="stylesheet" href="style.css">
    <title>New Unit Preview</title>
</head>
<body class="Listings prevPage">
    <div class="header">
        <h1><i class="fa-solid fa-arrow-left"></i></h1>
        <h1>New Unit</h1>
    </div>
    </div>
    <div class="mainListing">
        <div class="mainView">
            <div class="tourArea">
                <?php
                // $tour = explode('*', );
                for($j=0; $j < count($_SESSION['virtualTour']); $j++){
                    ?>
                    <img src="Uploads/<?php echo $_SESSION['virtualTour'][$j]?>" class="previewImg  slide fade" id="slide<?php echo $j?>" alt="living room"/>
                    <?php
                    }
                ?>
                <div class="move-slides">
                    <a class="prev" onclick ="plusSlides(-1)" >&#10094;</a>
                    <a class="next" onclick ="plusSlides(1)" >&#10095;</a>     
                </div>
            </div>
            <div class="listing-details detail" style=" margin-left: 5%; font-size: 1.15em;">
                            <?php
                            if($_SESSION['category'] == 'forSale'){
                            ?>
                            <p class="category">For sale</p>
                            <?php
                            }elseif($_SESSION['category'] == 'rental'){
                            ?>
                                <p class="category">Rental</p>
                                <?php
                                }
                                ?>
            </div>
            <div class='listing-details details' >
                <div class="detailsSection" style="margin:0; margin-left: 2.5%">
                    <div style="margin:0;  ">
                <p><?php echo$_SESSION['condition'] . ' ' . $_SESSION['bedroomNo']?> bedroom house</p>
                            </div>
            <p>Ksh <?php echo $_SESSION['cost']?></p>
                </div>
                <div class="detailsSection">
                    <p>The features enabling accessibility are <?php  echo   implode(',', $_SESSION['accessibility'])?>.</p>
                    <p>This unit also has <?php echo   implode(',', $_SESSION['amenities'])?></p>
                    <p>and <?php echo   implode(',', $_SESSION['others']) ?>.</p>
                </div>
        <?php      
        ?>
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
        <a href="addUnit.php?action=edit"><button class="btn edit"></button></a>
        <a href="preview.php?action=deletePreview"><button class="btn delete">Delete</button></a>
    </div>
    </div>
    </div>
</body>
</html>
<?php
    if(isset($_GET['action'])){ if($_GET['action'] == 'deletePreview'){
        unset($_SESSION["category"]);
        unset($_SESSION["cost"]) ;
        unset($_SESSION["size"]);
        unset($_SESSION["bedroomNo"]);
        unset($_SESSION["location"]);
        unset($_SESSION["virtualTour"]);
        unset($_SESSION["amenities"]);
        unset($_SESSION["accessibility"]);
        unset($_SESSION["condition"]);
        unset($_SESSION["others"]);
        echo ' <script> 
        window.location.href = "addUnit.php";
        </script>
        ';
    }};
    
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
</script>

