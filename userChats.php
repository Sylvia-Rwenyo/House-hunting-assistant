<?php 
    include_once 'conn.php';
    session_start();
    $user = $_SESSION["username"];
    if($_SESSION["loggedIN"] == false){
        echo ' <script> 
        window.location.href = "index.php";
        </script>';
        }else{
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
    <link rel="stylesheet" href="style.css">
    <title>Your chats</title>
</head>
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
function showMenu(){
    document.getElementById('menuBars').style.display = 'none';
    document.getElementById('menu').style.display = 'block';
}
function closeMenu(){
    document.getElementById('menuBars').style.display = 'block';
    document.getElementById('menu').style.display = 'none';
}
</script>

<body class="profileBody">
    <div class="header">
        <h1>Your Chats</h1>
        <span class="menuBar" id="menuBars" onClick="showMenu()"><i class="fa-solid fa-bars"></i></span>
        <div class="menu" id="menu">
            <span class="menuBar" id="menuBar" onClick="closeMenu()"><i class="fa-solid fa-x"></i></span>
            <ul>
                <a href="listing.php"><li  class="active">Active Listings</li></a>
                <a href="userProfile.php?id=<?php echo$_SESSION['id']; ?>"><li  class="active">Profile</li></a>
                <a href="userChats.php"><li  class="active">Help</li></a>
            </ul>
        </div>
    </div>
    </div>
    <?php
        $to;
   if(stristr( 'hhs@admin.com hhs2@admin.com hhs1@admin.com', $_SESSION['email']) && $_SESSION['category'] == 'showing'){
    ?> 
    <div class="adminMsg">
        <p>
            Welcome admin, you will see all chats from users assigned to you down below. Contact the head office incase of any issues that you may need assistance with.
        </p>
    </div>
            <div class="message" id="message">
            <div class="singleMessages">
    <?php
    $userID = $_SESSION['id'];
    $stmt = $conn->prepare("SELECT * FROM messages WHERE receipientID = ? OR senderID = ? GROUP BY receipientID");
    $stmt->bind_param("ss", $userID, $userID);
    $stmt->execute();
    $messageWith = $stmt->get_result();

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
                $to = 'userChats.php?action=chat&with=' . $record['id'];
                ?>
                <div class="singleMessage">
                    <a href="<?php echo $to; ?>">
                        <div class="intro">
                            <h5><?php echo $record['name']; ?></h5>
                        </div>
                        <?php
                        $rec = $record['id'];
                        $msg = $conn->prepare("SELECT * FROM messages WHERE (receipientID = ? OR senderID = ?) AND (receipientID = ? OR senderID = ?) ORDER BY `time` DESC LIMIT 1");
                        $msg->bind_param("ssss", $rec, $rec, $userID, $userID);
                        $msg->execute();
                        $msgResult = $msg->get_result();

                        if ($msgResult->num_rows > 0) {
                            $found = $msgResult->fetch_assoc();
                            ?>
                            <p><?php echo strlen($found['message']) > 40 ? substr($found['message'], 0, 40) . '...' : $found['message']; ?></p>
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
 
        <div class="chat" id="chat">
        <div class="bubbles">
            <div class="top">
                <div>
                    <?php
                     if(empty($_GET)){
                        echo 'No chat opened';
                     }else if(isset($_GET )){
                        $with;
                        if(isset($_GET['action']) == 'chat'){
                            $with = $_GET['with'];
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
                 $length = 45;
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
                        <input type="hidden" name="recipientID" value="<?php echo  $with?>" />
                        <input type="hidden" name="subjectUnit" value="<?php echo  $subjectUnit?>" />
                        <input type="hidden" name="to" value="<?php echo  $to?>" />
                        <button type="submit" id="sendMsg" name="send"><i class="fa-solid fa-paper-plane"></i></button>
        </form>
        <?php
        }
        ?>
        </div>
    </div>
<?php
   }else{
?>
 <div class="message" id="message">
 <div class="singleMessages">
    <?php
    $noReciepient;
    $subjectUnit;
    $userID = $_SESSION['id'];
    $stmt = $conn->prepare("SELECT * FROM messages WHERE receipientID = ? OR senderID = ? GROUP BY receipientID");
    $stmt->bind_param("ss", $userID, $userID);
    $stmt->execute();
    $messageWith = $stmt->get_result();

    if ($messageWith->num_rows > 0) {
        $j = 0;
        $uniquePairs = array();

        while ($results = $messageWith->fetch_assoc()) {
            $sentTo = $results['receipientID'];
            $from = $results['senderID'];

            // Check if the pair of receipientID and senderID is already displayed
            if (in_array([$sentTo, $from], $uniquePairs) || in_array([$from, $sentTo], $uniquePairs)) {
                continue; // Skip this iteration
            }

            $uniquePairs[] = [$sentTo, $from]; // Add the pair to the array

            $getDetails = $conn->prepare("SELECT * FROM registration WHERE (id = ? OR id = ?) AND id != ?");
            $getDetails->bind_param("sss", $sentTo, $from, $userID);
            $getDetails->execute();
            $detailsResult = $getDetails->get_result();

            if ($detailsResult->num_rows > 0) {
                $record = mysqli_fetch_array($detailsResult);
                $to = 'userChats.php?action=chat&with=' . $record['id'];

                ?>
                <div class="singleMessage">
                    <a href="<?php echo $to; ?>">
                        <div class="intro">
                            <h5><?php echo $record['name']; ?></h5>
                        </div>
                        <?php
                        $rec = $record['id'];
                        $msg = $conn->prepare("SELECT * FROM messages WHERE (receipientID = ? OR senderID = ?) AND (receipientID = ? OR senderID = ?) ORDER BY `time` DESC LIMIT 1");
                        $msg->bind_param("ssss", $rec, $rec, $userID, $userID);
                        $msg->execute();
                        $msgResult = $msg->get_result();

                        if ($msgResult->num_rows > 0) {
                            $found = mysqli_fetch_array($msgResult);
                            ?>
                            <p><?php echo strlen($found['message']) > 40 ? substr($found['message'], 0, 40) . '...' : $found['message']; ?></p>
                            <?php
                        }
                        ?>
                    </a>
                </div>
                <?php
            }

            $j++;
        }
    } else {
        ?>
            <div class="singleMessage">
                <a href="userChats.php?action=chat&with=0">
                    <div class="intro">
                        <h5>Hhs admin</h5>
                    </div>
                    <p>Start your chat with us</p>
                </a>
            </div>
            <?php
            $noReciepient = true;
                }
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
                        if($_GET['action'] == 'chat' && isset($_GET['with'])){
                            $with = $_GET['with'];
                        }
                        if($with > 0){
                    $records = mysqli_query($conn,"SELECT name, id FROM  registration where id='$with'");
                    if (mysqli_num_rows($records) > 0) {
                    $i=0;
                    while($result = mysqli_fetch_array($records)) {
                    ?>
                    <a href="userProfile.php?id=<?php echo $with;?>"><h4><?php echo $result['name']?></h4>
                    </a><?php $i++; }}}else{ ?>
                        <a href="userProfile.php?id=<?php echo $with;?>"><h4>Hhs admin</h4>
                    </a><?php }?>
                    <p>direct message</p>
                </div>
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
               $length = 45;
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
                        <input type="hidden" name="recipientID" value="<?php echo $with ?>" />
                        <input type="hidden" name="to" value="userChats.php" />
                        <input type="hidden" name="subjectUnit" value="<?php echo  $subjectUnit?>" />
                        <button type="submit" id="sendMsg" name="send"><i class="fa-solid fa-paper-plane"></i></button>
        </form>
        <?php
        }
        ?>
        </div>
    </div>
</body>
</html>
<?php
}}
?>
