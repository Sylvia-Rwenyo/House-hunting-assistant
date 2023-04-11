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
            $id = $_SESSION['inView'];
            $mail = $_SESSION['email'];
            $_SESSION['id'] = 0;
            $records = mysqli_query($conn,"SELECT * FROM  registration where emailAddress='$mail' ");
            if (mysqli_num_rows($records) > 0) {
            $i=0;
            while($result = mysqli_fetch_array($records)) {
                $_SESSION['id'] = $result['id'];
                $i++;}}
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
                   <a href="paymentSection.php?id=<?php echo $id?>"><span id='pay'>Pay</span></a>
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

    <div class="message" id="message">
        <div class="singleMessages">
    <?php
         $messageWith = mysqli_query($conn,"SELECT * FROM  messages where receipientID ='$userID' || senderID ='$userID'  GROUP BY  receipientID");
         if (mysqli_num_rows($messageWith) > 0) {
         $j=0;
         while($results = mysqli_fetch_array($messageWith)) {
            $sentTo = $results['receipientID'];
            $from = $results['senderID'];

              $getDetails = mysqli_query($conn,"SELECT * FROM  registration where (id='$sentTo' || '$from') && id!='$userID' && id ='$uploaderID' ");
              if (mysqli_num_rows($getDetails) > 0) {
              $i=0;
              while($record = mysqli_fetch_array($getDetails)) {
                $to = 'listingChat.php?action=chat&with='. $record['id']. '&id=' . $id;
              ?>
            <div class="singleMessage">
                <a href="listingChat.php?action=chat&with=<?php echo $record['id']?>&id=<?php echo $id;?>">
                <div class="intro">
                    <h5><?php echo $record['name']?></h5>
                    <!-- <div>
                        <i class="fa-solid fa-star"></i>                   
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                    </div>  -->
                </div>
                <?php
                $rec = $record['id'];
                $msg = mysqli_query($conn,"SELECT * FROM  messages where  receipientID='$rec' && senderID='$userID' ORDER BY `time` DESC LIMIT 1 ");
                if (mysqli_num_rows($msg) > 0) {
                $k=0;
                while($found = mysqli_fetch_array($msg)) {
                ?>
                <p><?php echo  substr($found['message'], 0, 25) . '...';?></p>
                <?php
                $k++; }}
                ?>
            </div> 
              </a>  
            <?php 
                $i++; }}
                $j++; }}
                ?> 
        </div> 
        <div class="chat" id="chat">
        <div class="bubbles">
            <div class="top">
                <div>
                    <?php
                     if(empty($_GET)){
                        echo 'No chat opened';
                     }else if(isset($_GET)){
                        $with;
                        if(isset($_GET['action']) == 'chat'){
                            $with = $_GET['with'];
                        }else{
                         $with = $uploaderID;
                        }
                    $records = mysqli_query($conn,"SELECT name, id FROM  registration where id='$with'");
                    if (mysqli_num_rows($records) > 0) {
                    $i=0;
                    while($result = mysqli_fetch_array($records)) {
                    ?>
                    <a href="userProfile.php?id=<?php echo $with;?>"><h4><?php echo $result['name']?></h4>
                    <?php $i++; }} ?></a>
                    <p>direct message</p>
                </div>
                <!-- <span onClick="closeMessages()"><i class="fa-solid fa-x"></i></span> -->
            </div>
            <?php
            $messages = mysqli_query($conn,"SELECT * FROM  messages where (senderID='$with' && receipientID ='$userID') || (senderID='$userID' && receipientID ='$with')");
            if (mysqli_num_rows($messages) > 0) {
            $i=0;
            while($row = mysqli_fetch_array($messages)) {
            ?>
             <div class="<?php if($row['senderID']==$userID){ echo 'chatBubble1'; } else if($row['receipientID']==$userID){ echo 'chatBubble2'; }?>">
                <p><?php
                $length = 35;
                if(strlen($row['message']) < $length){ echo $row['message'];} else{
                    for($k = 0; $k < strlen($row['message']) ; $k+=$length){
                    echo substr($row['message'], $k, ($k+$length)) . '<br>';
                    }
                }
                    ?>
                </p>
            </div>
            <?php
            $i++; }}?>
        </div>
        <form class="typingArea" method="POST" action="">
                        <input type="text" name="message" placeholder="type here ..."/>
                        <input type="hidden" name="senderID" value="<?php echo  $userID?>" />
                        <input type="hidden" name="receipientID" value="<?php echo  $uploaderID?>" />
                        <button type="submit" name="send"><FaRegPaperPlane/></button>
        </form>
        <?php
                     }
                     ?>
        </div>
    </div>
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
        echo '<script> window.location.href = "'. $to.'"; </script>';
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