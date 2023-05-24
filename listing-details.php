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
    <script src="script.js"  ></script>
    <link rel="stylesheet" href="style.css">
    <title>Active Listings</title>
</head>
<body class="Listings listings-details">
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
    <?php
         $userID = 0;
        $id = $_GET['id'];
           $records = mysqli_query($conn,"SELECT * FROM  units where id='$id'");
     
            if (mysqli_num_rows($records) > 0) {
                $i=0;
                while($result = mysqli_fetch_array($records)) {
                $userID = $result['userID'];
                $tour = explode('*', $result['virtualTour']);
    ?>
    <div class="tourArea">
        <?php
        for($j=0; $j < count($tour); $j++){
            ?>
            <img src="Uploads/<?php echo $tour[$j]?>" class="previewImg  slide fade" id="slide<?php echo $j?>" alt="living room"/>
            <?php
            }
        ?>
        <div>
            <a class="prev" onclick ="plusSlides(-1)" >&#10094;</a>
            <a class="next" onclick ="plusSlides(1)" >&#10095;</a>     
        </div>
    </div>
     <div class="listing-details detail">
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
    </div>
    <div class='listing-details details' >
        <div class="detailsSection">
            <div>
        <p><?php echo $result['bedroomNo']?> bedroom house</p>
        <a href="listingChat.php?with=<?php echo $userID; $_SESSION['inView'] = $result['id']; ?>&inView=<?php echo  $_SESSION['inView']?>">Chat<span id="card<?php echo $result['id']?>"><i class="fa-solid fa-message"></i></span>
        </a>
                    </div>
    <p>Ksh <?php echo $result['cost']?></p>
    <?php
        if($_SESSION['credits'] < 1){
            ?>
    <p onClick="showOverlay()"><i class="fa fa-location-dot"></i> <?php echo $result['location']?></p>
    <?php
        }else{
    ?>
    <p ><i class="fa fa-location-dot"></i> <?php echo $result['location']?></p>
            <?php
        }
            $i++;
            }}
            ?>
        </div>
        <div class="detailsSection">
            <p>This is a paragraph.</p>
            <p>This is a another paragraph.</p>
            <p>This is a the last paragraph.</p>
        </div>

        <div class="payPrompt"  id="payPrompt2">
            <div>
                <p>To continue, top up your credits</p>
                <a href="paymentSection.php?userID=<?php echo $_SESSION['id']?>&id=<?php echo $_GET['id']?>&from=listing-details.php?&id=<?php echo $_GET['id']?>">here</a>
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
if(isset($_GET['likes'])){
        $by = $_GET['by'];
        $id = $_GET['id'];
        $sql=mysqli_query($conn,"SELECT likedBy FROM units where id='$id'");
        $row  = mysqli_fetch_array($sql);
        //if sql query is executed...
        if(is_array($row))
        {
        $likedBy = explode('*', $row['likedBy']);
        if(in_array($by, $likedBy)){
            $likes = $_GET['likes'] - 1;
            $likedBy =str_replace($row['likedBy'], '*'.$by, '');
            $sql2 = "UPDATE units SET likes ='$likes', likedBy='$likedBy' where id = '$id'";
    
        //if sql query is executed...
        if (mysqli_query($conn, $sql2)) {
              echo '<script> window.location.href = "listing.php"</script>'; 
               } else {	
                   //show error
           echo "Error: " . $sql2 . "
    " . mysqli_error($conn);
        }
        //close connection
        mysqli_close($conn);

        }else{
            $likes = $_GET['likes'] + 1;
            $sql2 = "UPDATE units SET likes ='$likes', likedBy=concat(likedBy,'*','$by') where id = '$id'";
    
        //if sql query is executed...
        if (mysqli_query($conn, $sql2)) {
            echo '<script> window.location.href = "listing.php"</script>'; 
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


?>
<script>
    const filters = () =>{
    document.getElementById('filters').style.display = 'block';
    document.getElementById('openFilters').style.display = 'none';
    document.getElementById('openFilters2').style.display = 'block';
}
const closeFilters = () =>{
    document.getElementById('filters').style.display = 'none';
    document.getElementById('openFilters').style.display = 'block';
    document.getElementById('openFilters2').style.display = 'none';
}
const showMenu = () =>{
    document.getElementById('menuBars').style.display = 'none';
    document.getElementById('menu').style.display = 'block';
}
const closeMenu = () =>{
    document.getElementById('menuBars').style.display = 'block';
    document.getElementById('menu').style.display = 'none';
}
const showDetails = (id) =>{
    window.location.href = "listing-details.php?id=" + id;
}
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
function showOverlay(){
    document.getElementById("payPrompt2").style.display = "block";
         }
</script>
