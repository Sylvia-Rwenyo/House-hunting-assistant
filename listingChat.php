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
                <a href="userChats.php"><li  class="active">Help</li></a>
            </ul>
        </div>
    </div>
    </div>
    <div class="listingsChat">
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
                    <a href="listingChat.php?likes=<?php echo $result['likes']?>&id=<?php echo $result['id']?>&by=<?php echo $_SESSION['id']?>">
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
                        <a href="listingChat.php?with=<?php  echo $_SESSION['recipientID']; $_SESSION['inView'] = $result['id']; ?>&inView=<?php echo  $_SESSION['inView']?>">
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
    $stmt = $conn->prepare("SELECT * FROM messages WHERE receipientID = ? OR senderID = ? GROUP BY receipientID");
    $stmt->bind_param("ss", $userID, $userID);
    $stmt->execute();
    $messageWith = $stmt->get_result();
    $to;
    if ($messageWith->num_rows > 0) {
        $uniqueCombinations = array();

        while ($results = $messageWith->fetch_assoc()) {
            $sentTo = $results['receipientID'];
            $from = $results['senderID'];

            // Create unique identifiers for the sender and recipient combination
            $combination1 = $sentTo . '-' . $from;
            $combination2 = $from . '-' . $sentTo;

            // Check if either combination has already been displayed
            if (in_array($combination1, $uniqueCombinations) || in_array($combination2, $uniqueCombinations)) {
                continue; // Skip this iteration
            }

            $uniqueCombinations[] = $combination1; // Add the combination to the array

            $getDetails = $conn->prepare("SELECT * FROM registration WHERE (id = ? OR id = ?) AND id != ? ORDER BY id DESC LIMIT 1");
            $getDetails->bind_param("sss", $sentTo, $from, $userID);
            $getDetails->execute();
            $detailsResult = $getDetails->get_result();

            if ($detailsResult->num_rows > 0) {
                $record = $detailsResult->fetch_assoc();
                $to = 'listingChat.php?action=chat&with=' . $record['id'].'&inView=' . $_GET['inView'];
                ?>
                <div class="singleMessage">
                    <a href="<?php echo $to; ?>">
                        <div class="intro">
                            <h5><?php echo $record['name']; ?></h5>
                        </div>
                        <?php
                        $rec = $record['id'];
                        $msg = $conn->prepare("SELECT * FROM messages WHERE receipientID = ? AND senderID = ? ORDER BY `time` DESC LIMIT 1");
                        $msg->bind_param("ss", $rec, $userID);
                        $msg->execute();
                        $msgResult = $msg->get_result();

                        if ($msgResult->num_rows > 0) {
                            $found = $msgResult->fetch_assoc();
                            ?>
                            <p><?php echo strlen($found['message']) > 25 ? substr($found['message'], 0, 25) . '...' : $found['message']; ?></p>
                            <?php
                        }
                        ?>
                    </a>
                </div>
                <?php
            }
        }
    }
    ?>
</div>

        <?php
                        $userID = $_SESSION['id'];
                    function assignReceipient($conn){
                        // Retrieve the list of emails
                        $sqlQ = mysqli_query($conn, "SELECT * FROM registration WHERE emailAddress IN ('hhs1@admin.com', 'hhs2@admin.com', 'hhs@admin.com')");
                        $emails = array('hhs1@admin.com', 'hhs2@admin.com', 'hhs@admin.com');
                    
                        // Fetch the last assigned recipient ID
                        $lastRecipientID = getLastRecipientID($conn);
                    
                        // Determine the index of the next email to assign
                        $nextIndex = ($lastRecipientID !== null) ? array_search($lastRecipientID, $emails) + 1 : 0;
                    
                        // Wrap around to the first email if necessary
                        if ($nextIndex >= count($emails)) {
                            $nextIndex = 0;
                        }
                    
                        // Assign the recipient ID to the next email
                        $_SESSION['recipientID'] = $emails[$nextIndex];                   
                    
                        // Update the last assigned recipient ID
                        updateLastRecipientID($_SESSION['recipientID'], $_SESSION['id'], $conn);
                    }
                          function getLastRecipientID($conn) {
                             // Retrieve the last assigned recipient ID from a database table or any other storage mechanism
                              // Modify this code to suit your specific storage method
                              
                              // Assuming a MySQLi connection object named $conn is available
                              $result = mysqli_query($conn, "SELECT lastReceipientID FROM admin_receipient ORDER BY id DESC LIMIT 1");
                              
                              if ($result && mysqli_num_rows($result) > 0) {
                                  $row = mysqli_fetch_assoc($result);
                                  return $row['lastReceipientID'];
                              }
                              
                              return null;
                          }
                          
                          function updateLastRecipientID($recipientID, $userID, $conn) {
                              // Update the last assigned recipient ID in a database table or any other storage mechanism
                              // Modify this code to suit your specific storage method

                              
                              // Assuming a MySQLi connection object named $conn is available
                              date_default_timezone_set("Africa/Nairobi");
                              $time = date("Y-m-d h:i:sa");
                              $recipientID =$_SESSION['recipientID'];
                              mysqli_query($conn, "INSERT INTO admin_receipient (lastReceipientID, senderID, time) VALUES ('$recipientID', '$userID', '$time')");
                          }
                          if(!isset($_SESSION['recipientID'])){
                            assignReceipient($conn);
                        }else{
                            $recipientID =$_SESSION['recipientID'];
                        }
                        if(!isset($_GET['with'])){
                          ?>
                <div class="chat" id="chat">
        <div class="bubbles">
            <div class="top">
                <div>
                    <?php
                    $records = mysqli_query($conn,"SELECT name, id FROM  registration where emailAddress='$recipientID'");
                    if (mysqli_num_rows($records) > 0) {
                    $i=0;
                    while($result = mysqli_fetch_array($records)) {
                        $recipientID = $result['id'];
                        $_SESSION['recipientID'] = $recipientID;
                    ?>
                    <a href="userProfile.php?id=<?php echo $recipientID;?>"><h4><?php echo $result['name']?></h4>
                    <?php $i++; }} ?></a>
                    <p>direct message</p>
                </div>
            </div>
            <?php
            $messages = mysqli_query($conn,"SELECT * FROM  messages where (senderID='$recipientID' && receipientID ='$userID') || (senderID='$userID' && receipientID ='$ $recipientID')");
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
                    echo substr($row['message'], $k, ($length)) . '<br>';
                    }
                }
                    ?>
                </p>
                <span><?php echo substr($row['time'],11)?></span>
            </div>
            <?php
            $i++; }}
            ?>
        </div>
        <form class="typingArea" method="POST" action="processing.php">
                        <textarea type="text" name="message" placeholder="type here ..."></textarea>
                        <input type="hidden" name="senderID" value="<?php echo  $userID?>" />
                        <input type="hidden" name="recipientID" value="<?php echo  $recipientID?>" />
                        <input type="hidden" name="subjectUnit" value="<?php echo  $subjectUnit?>" />
                        <input type="hidden" name="to" value="<?php echo  $to?>" />
                        <button type="submit" id="sendMsg" name="send"><i class="fa-solid fa-paper-plane"></i></button>
        </form>
       
        </div>
        <?php
                        }else{
        ?>
                  <div class="chat" id="chat">
        <div class="bubbles">
            <div class="top">
                <div>
                    <?php
                    $recipientID = $_GET['with'];
                    $records = mysqli_query($conn,"SELECT name, id FROM  registration where emailAddress='$recipientID' ||  id='$recipientID'");
                    if (mysqli_num_rows($records) > 0) {
                    $i=0;
                    while($result = mysqli_fetch_array($records)) {
                        $recipientID = $result['id'];
                        $_SESSION['recipientID'] = $recipientID;
                    ?>
                    <a href="userProfile.php?id=<?php echo $recipientID;?>"><h4><?php echo $result['name']?></h4>
                    <?php $i++; }} ?></a>
                    <p>direct message</p>
                </div>
            </div>
            <?php
            $messages = mysqli_query($conn,"SELECT * FROM  messages where (senderID='$recipientID' && receipientID ='$userID') || (senderID='$userID' && receipientID ='$recipientID')");
            if (mysqli_num_rows($messages) > 0) {
            $i=0;
            while($row = mysqli_fetch_array($messages)) {
                $subjectUnit = $row['subjectUnit'];
            ?>
             <div class="<?php if($row['senderID']==$userID){ echo 'chatBubble1'; } else if($row['receipientID']==$userID){ echo 'chatBubble2'; }?>">
                <p><?php
               $length = 35;
               if (strlen($row['message']) < $length) {
                   echo $row['message'];
               } else {
                   for ($k = 0; $k < strlen($row['message']); $k += $length) {
                       echo substr($row['message'], $k, $length) . '<br>';
                   }
               }
               
                    ?>
                </p>
                <span><?php echo substr($row['time'],11)?></span>
            </div>
            <?php
            $i++; }}
            ?>
        </div>
        <form class="typingArea" method="POST" action="processing.php">
                        <textarea type="text" name="message" placeholder="type here ..."></textarea>
                        <input type="hidden" name="senderID" value="<?php echo  $userID?>" />
                        <input type="hidden" name="recipientID" value="<?php echo  $recipientID?>" />
                        <input type="hidden" name="subjectUnit" value="<?php echo  $subjectUnit?>" />
                        <input type="hidden" name="to" value="<?php echo  $to?>" />
                        <button type="submit" id="sendMsg" name="send"><i class="fa-solid fa-paper-plane"></i></button>
        </form>
       
        </div>
        <?php
                        }
        ?>
                          </div>
    </div>
        <?php
                     
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
                            echo '<style type="text/css">
                            .fa-heart {
                                color: black;
                            }
                            </style>';
                              echo '<script> window.location.href = "listingChat.php"</script>'; 
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
                            echo '<style type="text/css">
                            .fa-heart {
                                color: #c89364;
                            }
                            </style>';
                            echo '<script> window.location.href = "listingChat.php"</script>'; 
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
        </div>

<div class="creditMsg">
            <p>You can use your credits to communicate directly with us and to view the unit's location. Each credit once in use expires after 24hours.</p>
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