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
    <title>Chat with</title>
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
    <div class="listingsChat">
   
    <div class="list" id="list">
    <?php 
            include_once 'conn.php';
            session_start();
            $id = $_GET['id'];
            $userID = $_SESSION['id'];
            $to = '';
            $uploaderID = 0;
            $records = mysqli_query($conn,"SELECT * FROM  units where id =  '$id'");
            if (mysqli_num_rows($records) > 0) {
            $i=0;
            while($result = mysqli_fetch_array($records)) {
                $uploaderID = $result['userID'];
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
                for($j=0; $j < count($tour); $j++){
                    ?>
                    <img src="Uploads/<?php echo $tour[$j]?>" class="previewImg  slide fade" alt="living room"/>
                    <?php
        }
                ?>
                 <a class="prev" onclick ="plusSlides(-1)" >&#10094;</a>
                    <a class="next" onclick ="plusSlides(1)" >&#10095;</a>     
        </div>
               
        <div class="details">
                <div>
                    <h5><?php echo $result['bedroomNo']?> bedroom house</h5>
                   <a href="paymentSection.php"><span id='pay'>Pay</span></a>
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
    <div class="paymentArea" id="paymentArea">
    <span onClick="closePaymentSection()"><i class="fa-solid fa-x"></i></span>
        <div id="payPrompt">
        <div>
            <label>Credit Card</label>
            <input type="radio" name="method" value="card" id="payMethodC"/>
        </div>
        <div>
            <label>Mpesa</label>
            <input type="radio" name="method" value="mpesa" id="payMethodM"/>
        </div>
    </div>
        <form class="paymentForm" id="creditCard">
            <input type="text" placeholder="full name" name="" />
            <input type="number" placeholder="card number" name=""/>
            <input type="number" placeholder="CVC" name="" />
            <input type="passcode" placeholder='pass code' name="" />
            <div>
                <input type="text" name='bill' id='bill1' value="Bill of Ksh 100" />
                <button type="submit" name="pay">Done</button>
            </div>
        </form>
        <form class="paymentForm" id="mpesa">
            <input type="number" placeholder="phone number" name="phoneNumber"/>
            <input type="number" placeholder="amount" name="amount" />
            <input type="password" placeholder='password' name="password" />
            <div>
                <input type="text" name='bill' id='bill' value="Bill of Ksh 100" />
                <button type="submit" name="pay">Done</button>
            </div>
        </form>
        
    </div>
</div>
</div>
</body>
</html>
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

function showImgs(){
    document.getElementById('firstSlide').style.display = "none";
    document.getElementById('secondSlide').style.display = "block";
}
let selectCreditCard = document.getElementById('creditCard');
let selectMpesa = document.getElementById('mpesa');
let payMethodC = document.getElementById('payMethodC');
let payMethodM = document.getElementById('payMethodM');

if(selectMpesa.style.display == 'block'){
    payMethodC.checked =  false;
    payMethodM.checked =  true;
}
payMethodC.oninput = () =>{
    payMethodC.checked =  true;
    payMethodM.checked =  false;
    selectCreditCard.style.display = 'block';
    selectMpesa.style.display = 'none';
}
payMethodM.oninput = () =>{
    payMethodC.checked =  false;
    payMethodM.checked =  true;
    selectCreditCard.style.display = 'none';
    selectMpesa.style.display = 'block';
}

</script>