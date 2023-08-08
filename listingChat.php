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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="style.css">
    <title>Chat with</title>
</head>
<body class="Listings" id="listingsChatPage">
    <div class="header">
        <h1>Active Listings</h1>
        <span class="menuBar" id="menuBars" onClick="showMenu()"><i class="fa-solid fa-bars"></i></span>
        <?php
            include_once 'menu.php';
        ?>
    </div>
    </div>
    <div class="listingsChat" id="listingsChat">
    <?php 
      
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
            $to = '';
            $subjectUnit;
            if(!empty($_GET) && isset($_GET['inV'])){
                $subjectUnit = $_GET['inV'];
            $id = $_GET['inV'];
            }else if(!empty($_GET) && isset($_GET['id'])){
                $id = $_GET['id']; 
            }
            else{
            }

            $mail = $_SESSION['email'];
            $_SESSION['id'] = 0;
            $records = mysqli_query($conn,"SELECT * FROM  registration where emailAddress='$mail' ");
            if (mysqli_num_rows($records) > 0) {
            $i=0;
            while($result = mysqli_fetch_array($records)) {
                $_SESSION['id'] = $result['id'];
                $_SESSION['credits'] = $result["credits"];
                if(  $_SESSION['credits'] < 1){
                    echo '
                    <style>
                    #payPrompt1{
                        display: block;
                    </style>
                    ';
                }
                $i++;
            }}
            $userID = $_SESSION['id'];
            $uploaderID = 0;
            $records = mysqli_query($conn,"SELECT * FROM  units where id =  '$userID'");
            if (mysqli_num_rows($records) > 0) {
            $i=0;
            while($result = mysqli_fetch_array($records)) {
                $uploaderID = $result['userID'];
                $tour = explode('*', $result['virtualTour']);

        ?>
         <div class="payPrompt"  id="payPrompt1">
            <div>
                <p>To continue, top up your credits</p>
                <a href="paymentSection.php?userID=<?php echo $_SESSION['id']?>&id=<?php echo $_GET['inV']?>&from=listingChat.php?w=<?php echo $_SESSION['recipientID']?>&inV=<?php echo $_GET['inV']?>">here</a>
            </div>
        </div>
        <div class="cards">
        <div class="singleCard" id="singleCard<?php echo $result['id']?>" >
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
                    <a href="listingChat.php?l=<?php echo $result['likes']?>&inV=<?php echo $result['id']?>&by=<?php echo $_SESSION['id']?>">
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
                        <a href="listingChat.php?with=<?php if(isset($_SESSION['recipientID'])){ echo $_SESSION['recipientID'];} $_SESSION['inV'] = $result['id']; ?>&inV=<?php echo  $_SESSION['inV']?>">
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
        $i++;}}else{
            echo '
                <style>
                .listingsChat .message, .creditMsg{
                    width: 80%;
                    margin-left: 10%;
                }
                .message .chat .chatBubble1 span, .message .chat .chatBubble2 span{
                    margin-left: 80%;
                </style>
            ';
            }
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
                $to = 'listingChat.php?action=chat&w=' . $record['id'].'&inV=' . $_GET['inV'];
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
    }else {
        ?>
            <div class="singleMessage">
                <a href="listingChat.php?action=chat&w=<?php echo $_SESSION['recipientID'];?>
                    &inV=<?php echo $_GET['inV']?>">
                    <div class="intro">
                        <h5>Hhs admin</h5>
                    </div>
                    <p>Start your chat with us</p>
                </a>
            </div>
            <?php
                }
    ?>
</div>

            <div class="chat" id="chat">
                <div class="bubbles" id="allBubbles">
                    <div class="top">
                <div>
                    <?php
                    $recipientID = $_SESSION['recipientID'];
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
             $prevDate = null;
            $messages = mysqli_query($conn,"SELECT * FROM  messages where (senderID='$recipientID' && receipientID ='$userID') || (senderID='$userID' && receipientID ='$recipientID')");
            if (mysqli_num_rows($messages) > 0) {
            $i=0;
            $lastMessageID = null;
            while ($row = mysqli_fetch_array($messages)) {
                // Get the timestamp of the current message
                $timestamp = strtotime($row['time']);
                // Format the time to display without seconds
                $formattedTime = date("H:i", $timestamp);
    
                // Get the date of the current message
                $date = date("j M Y", $timestamp);
    
                // Check if the current message's date is different from the previous message's date
                if ($date !== $prevDate) {
                    // Display the date header
                    echo '<div class="date-header">' . $date . '</div>';
        
                    // Update the previous date
                    $prevDate = $date;
                }
            ?>
             <div class="<?php if($row['senderID']==$userID){ echo 'chatBubble1'; } else if($row['receipientID']==$userID){ echo 'chatBubble2'; }?>">
                <p><?php
            //    $length = 33;
            //    if (strlen($row['message']) < $length) {
            //        echo $row['message'];
            //    } else {
            //        for ($k = 0; $k < strlen($row['message']); $k += $length) {
                       echo $row['message'];
                //    }
               
                    ?>
                </p>
                <span><?php echo $formattedTime; ?></span>
            </div>
            <?php
            $i++;
            $lastMessageID = 'message_' . $row['id'];
        }}else{
                date_default_timezone_set("Africa/Nairobi");
                $time = date("Y-m-d h:i:sa");
                mysqli_query($conn, "INSERT INTO messages ( senderID, receipientID, message, time) 
                VALUES ('$recipientID', '$userID', 'Hello, how can we help you?', '$time')");

            }
            ?>
        </div>
        <form class="typingArea" method="POST" action="processing.php">
                        <textarea type="text" name="message" placeholder="type here ..."></textarea>
                        <input type="hidden" name="senderID" value="<?php echo  $userID?>" />
                        <input type="hidden" name="recipientID" value="<?php echo  $recipientID?>" />
                        <input type="hidden" name="subjectUnit" value="<?php echo  $subjectUnit?>" />
                        <input type="hidden" name="to" value="<?php
                        if($to == ''){
                            $to = 'listingChat.php?w='. $recipientID.'&inV='.$_GET['inV'];
                        }
                         echo  $to;
                         ?>" />
                        <button type="submit" id="sendMsg" name="send"><i class="fa-solid fa-paper-plane"></i></button>
        </form>
            </div>
    </div>
        <?php
                        if(isset($_GET['l'])){
                            $by = $_GET['by'];
                            $id = $_GET['inV'];
                            $sql=mysqli_query($conn,"SELECT likedBy FROM units where id='$id'");
                            $row  = mysqli_fetch_array($sql);
                            //if sql query is executed...
                            if(is_array($row))
                            {
                            $likedBy = explode('*', $row['likedBy']);
                            if(in_array($by, $likedBy)){
                                $likes = $_GET['l'] - 1;
                                $likedBy =str_replace($row['likedBy'], '*'.$by, '');
                                $sql2 = "UPDATE units SET likes ='$likes', likedBy='$likedBy' where id = '$id'";
                        
                            //if sql query is executed...
                            if (mysqli_query($conn, $sql2)) {
                                  echo '<script> window.location.href = "listingChat.php?inV='. $id. '"</script>'; 
                                   } else {	
                                       //show error
                               echo "Error: " . $sql2 . "
                        " . mysqli_error($conn);
                            }
                            //close connection
                            mysqli_close($conn);
                    
                            }else{
                                $likes = $_GET['l'] + 1;
                                $sql2 = "UPDATE units SET likes ='$likes', likedBy=concat(likedBy,'*','$by') where id = '$id'";
                        
                            //if sql query is executed...
                            if (mysqli_query($conn, $sql2)) {
                                echo '<script> window.location.href = "listingChat.php?inV='. $id. '"</script>'; 
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

 // Event listener for like link
//  $('.like-link').on('click', function(event) {
//     event.preventDefault();

//     var link = $(this);
//     var likes = parseInt(link.data('likes'));
//     var id = link.data('id');
//     var by = link.data('by');
//     var isLiked = link.hasClass('liked');

//     // Perform the AJAX request
//     $.ajax({
//       url: 'listingChat.php?likes',
//       type: 'GET',
//       data: {
//         likes: likes,
//         id: id,
//         by: by
//       },
//       success: function(response) {
//         if (isLiked) {
//           link.removeClass('liked');
//         } else {
//           link.addClass('liked');
//         }
//         fetchData();
//       },
//       error: function(xhr, status, error) {
//         console.log(error); // Handle any errors
//       }
//     });
//   });
function scrollToLastMessage() {
    var scrollableElement = document.getElementById('allBubbles');
  scrollableElement.scrollTop = scrollableElement.scrollHeight;
}
  function fetchData() {
    $.ajax({
      url: 'listingChat.php', // Replace with your server-side script URL
      method: 'GET',
      success: function(response) {
        // Handle the response and update the HTML content
        $('#listingsChatPage').html(response);
        console.log("all good");
      },
      error: function(xhr, status, error) {
        // Handle errors
        console.error(error);
      }
    });
  scrollToLastMessage();
}

document.addEventListener('DOMContentLoaded', function () {
    scrollToLastMessage();
});

// Call the getNewData function periodically to fetch new data
setInterval(fetchData, 60000);

</script>
<?php
}
?>