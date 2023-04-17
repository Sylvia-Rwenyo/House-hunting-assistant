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
<body class="Listings">
    <div class="header">
        <h1><i class="fa-solid fa-arrow-left"></i></h1>
        <h1>New Unit</h1>
    </div>
    </div>
    <div class="mainListing">
 
    <div class="list preview" id="list">
    <div class="card" id="card1">
                <div class="tourCard firstSlide" id="firstSlide0">
                    <img src="Uploads/<?php echo $_SESSION['virtualTour'][0]?>" class="previewImg " alt="living room"/>
                    <?php if(count($_SESSION['virtualTour']) > 1){?>
                    <a class="prev" onclick ="showImgs(0)" >&#10094;</a>
                    <a class="next" onclick ="showImgs(0)" >&#10095;</a>     
                    <?php } ?>
                </div>
                <div class="tourCard secondSlide" id="secondSlide0">
                <?php
                // if(isset($_GET['action'])){if ($_GET['action'] == 'showSlides'){
                for($j = 0; $j < count($_SESSION['virtualTour']); $j++){
                   
                    ?>
                    <img src="Uploads/<?php echo$_SESSION['virtualTour'][$j]?>" class="previewImg  slide slide0 fade" id="slide<?php echo $j?>"  alt="living room"/>
                    <?php
                // }
            // }
        }
                ?>
                <div>
                 <a class="prev" onclick ="plusSlides(-1)" >&#10094;</a>
                    <a class="next" onclick ="plusSlides(1)" >&#10095;</a> 
    </div>    
        </div>
               
        <div class="details">
                <div>
                    <h5><?php echo $_SESSION['bedroomNo']?> bedroom house</h5>
                </div>
                <div>
                    <p class="first">For <?php if($_SESSION["category"] == "forSale"){echo 'sale at Ksh';}
                                    else if($_SESSION["category"] == "rental"){echo 'rent at Ksh';} echo $_SESSION['cost'];?></p>
                    <p>At <?php echo $_SESSION['location']?></p>
                    <p><?php echo $_SESSION['size']?> sqft</p>
                </div>
                <div>
                <?php
                    for($j=0; $j <count($_SESSION['others']); $j++){
                ?> 
                <p><?php echo $_SESSION['others'][$j];?></p>
                <?php
                };
                ?>
                </div>
        </div>
        </div>
        </div>
        <div class="cardBtns">
            <a href="processing.php?action=uploadUnit"><button class="btn upload">Upload</button></a>
            <a href="addUnit.php?action=edit"><button class="btn edit">Edit</button></a>
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
        unset($_SESSION["others"]);
        header("Location: addUnit.php");
    }};
    
?>


