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
    <!-- <div class="list" id="list"> -->
    <?php 
            include_once 'conn.php';
            session_start();

            // $subjectUnit;
            if(!empty($_GET) && isset($_GET['inView'])){
            $id = $_GET['inView'];
            }else if(!empty($_GET) && isset($_GET['id'])){
                $id = $_GET['id']; 
            }
            else{
            // $id=$subjectUnit;
            }

            $mail = $_SESSION['email'];
            $_SESSION['id'] = 0;
            $records = mysqli_query($conn,"SELECT * FROM  registration where emailAddress='$mail' ");
            if (mysqli_num_rows($records) > 0) {
            $i=0;
            while($result = mysqli_fetch_array($records)) {
                $_SESSION['id'] = $result['id'];
                $_SESSION['credits'] = $result["credits"];
                $i++;
            }}

            $userID = $_SESSION['id'];
            $to = '';
            $uploaderID = 0;
            $records = mysqli_query($conn,"SELECT * FROM  units where id =  '$id'");
            if (mysqli_num_rows($records) > 0) {
            $i=0;
            while($result = mysqli_fetch_array($records)) {
                $uploaderID = $result['userID'];
                $tour = explode('*', $result['virtualTour']);

        ?>
         <div class="payPrompt"  id="payPrompt1">
            <div>
                <p>To continue, top up your credits</p>
                <a href="paymentSection.php?userID=<?php echo $_SESSION['id']?>&id=<?php echo $_GET['inView']?>&from=listingChat.php?with=<?php echo $_GET['with']?>&inView=<?php echo $_GET['inView']?>">here</a>
            </div>
        </div>
        <div class="cards">
        <div class="singleCard" id="singleCard<?php echo $result['id']?>" onclick="showDetails(<?php echo $result['id']?>)">
        <?php
                for($j=0; $j < count($tour); $j++){
                    ?>
                    <img src="Uploads/<?php echo $tour[$j]?>" class="previewImg  slide fade" id="slide<?php echo $j?>" alt="living room"/>
                    <?php
                    }
                ?>
                <div class="move-slides">
                    <a class="prev" onclick ="plusSlides(-1)" >&#10094;</a>
                    <a class="next" onclick ="plusSlides(1)" >&#10095;</a>  
                </div>  
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
                    <a href="listing.php?likes=<?php echo $result['likes']?>&id=<?php echo $result['id']?>&by=<?php echo $_SESSION['id']?>">
                        <button class="like-btn">
                            <i class="fa fa-heart" <?php
                                                        $unitID=$result['id'];
                                                        $by = $_SESSION['id'];
                                                        $stmt=mysqli_query($conn,"SELECT likedBy FROM units where id='$unitID'");
                                                        $row  = mysqli_fetch_array($stmt);
                                                        //if sql query is executed...
                                                        if(is_array($row))
                                                        {
                                                        $likedBy = explode('*', $row['likedBy']);
                                                        if(in_array($by, $likedBy)){
                                                            echo 'style="color: #c89364"';
                                                        }
                                                    }
                                                        ?>>
                            </i>
                            <span><?php echo $result['likes']?></span>
                        </button>
                    </a>
                </div>
                    <div>
                        <p><?php echo $result['bedroomNo']?> bedroom house</p>
                        <a href="listingChat.php?with=<?php echo $userID; $_SESSION['inView'] = $result['id']; ?>&inView=<?php echo  $_SESSION['inView']?>">
                            <span id="card<?php echo $result['id']?>">
                                <i class="fa-solid fa-message"></i>
                            </span>
                        </a>
                    </div>
                    <p>Ksh <?php echo $result['cost']?></p>
                    <p><i class="fa fa-location-dot"></i> <?php echo $result['location']?>&nbsp;&nbsp;<i class="fa fa-ellipsis"onclick="showDetails(<?php echo $result['id']?>)" ></i>
            </div>
        </div> 
        <?php
        $i++;}}
        ?>

    <div class="message" id="message">
        <div class="singleMessages">
    <?php
         $messageWith = mysqli_query($conn,"SELECT * FROM  messages where receipientID ='$userID' || senderID ='$userID'  GROUP BY  receipientID");
         if (mysqli_num_rows($messageWith) > 0) {
         $j=0;
         while($results = mysqli_fetch_array($messageWith)) {
            $sentTo = $results['receipientID'];
            $from = $results['senderID'];

            $getDetails = mysqli_query($conn,"SELECT * FROM  registration where (id='$sentTo' || id='$from') && id!=' $userID'");
              if (mysqli_num_rows($getDetails) > 0) {
              $i=0;
              while($record = mysqli_fetch_array($getDetails)) {
                $to = 'listingChat.php?action=chat&with='. $record['id']. '&id=' . $id;
              ?>
            <div class="singleMessage">
                <a href="listingChat.php?action=chat&with=<?php echo $record['id'];?>&id=<?php echo $id;?>">
                <div class="intro">
                    <h5><?php echo $record['name']?></h5>
                </div>
                <?php
                $rec = $record['id'];
                $msg = mysqli_query($conn,"SELECT * FROM  messages where  receipientID='$rec' && senderID='$userID' ORDER BY `time` DESC LIMIT 1 ");
                if (mysqli_num_rows($msg) > 0) {
                $k=0;
                while($found = mysqli_fetch_array($msg)) {
                ?>
                <p><?php if(strlen($found['message']) > 25){ echo  substr($found['message'], 0, 25) . '...';}else{ echo $found['message'];}?></p>
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
                $subjectUnit = $row['subjectUnit'];
            ?>
             <div class="<?php if($row['senderID']==$userID){ echo 'chatBubble1'; } else if($row['receipientID']==$userID){ echo 'chatBubble2'; }?>">
                <p><?php
                $length = 35;
                if(strlen($row['message']) < $length){ echo $row['message'];} else{
                    for($k = 0; $k < strlen($row['message']) ; $k+=$length){
                    echo substr($row['message'], $k+1, ($k+$length)) . '<br>';
                    }
                }
                    ?>
                </p>
                <span><?php echo substr($row['time'],11)?></span>
            </div>
            <?php
            $i++; }}?>
        </div>
        <form class="typingArea" id="typingArea" method="POST" action="processing.php">
                        <textarea type="text" name="message" placeholder="type here ..."></textarea>
                        <input type="hidden" name="subjectUnit" value="<?php echo  $id?>" />
                        <input type="hidden" name="senderID" value="<?php echo  $userID?>" />
                        <input type="hidden" name="receipientID" value="<?php echo  $with?>" />
                        <button type="submit" id="sendMsg" name="send"><FaRegPaperPlane/></button>
        </form>
        <?php
                     }
                     ?>
        </div>
    </div>
    </div>

</div>
<div class="creditMsg">
            <p>You can use your credits to communicate directly with home owners and care takers as well as view the unit's location. Each credit once in use expires after 24hours.</p>
        </div>
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