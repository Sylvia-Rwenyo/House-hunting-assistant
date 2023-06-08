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
    <script src="script.js" async></script>
    <link rel="stylesheet" href="style.css">
    <title>Your chats</title>
</head>
<body class="profileBody">
    <div class="header">
        <h1>Your Chats</h1>
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
                <?php 
                $subjectUnit;
                    // get user info
                    $userID= $_SESSION['id'] ;
                    $records = mysqli_query($conn,"SELECT * FROM  registration where id='$userID' ");
                    if (mysqli_num_rows($records) > 0) {
                    $i=0;
                    while($result = mysqli_fetch_array($records)) {
                        $i++;
                    }}
                ?>
            
            <div class="message" id="message">
        <div class="singleMessages">
    <?php
        $userID = $_SESSION['id'];
        $messageWith = mysqli_query($conn,"SELECT * FROM  messages where receipientID ='$userID' || senderID ='$userID'  GROUP BY  receipientID");
        if (mysqli_num_rows($messageWith) > 0) {
         $j=0;
         while($results = mysqli_fetch_array($messageWith)) {
            $sentTo = $results['receipientID'];
            $from = $results['senderID'];

            $getDetails = mysqli_query($conn,"SELECT * FROM  registration where (id='$sentTo' || id='$from') ");
            if (mysqli_num_rows($getDetails) > 0) {
              $i=0;
              while($record = mysqli_fetch_array($getDetails)) {
                $to = 'userChats.php?action=chat&with='. $record['id']. '&id=';
              ?>
            <div class="singleMessage">
                <a href="userChats.php?action=chat&with=<?php echo $record['id']?>&id=?>">
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
                $msg = mysqli_query($conn,"SELECT * FROM  messages where  receipientID='$rec' ORDER BY `time` DESC LIMIT 1 ");
                if (mysqli_num_rows($msg) > 0) {
                $k=0;
                while($found = mysqli_fetch_array($msg)) {
                ?>
                <p><?php if(strlen($found['message']) > 40){ echo  substr($found['message'], 0, 40) . '...';}else{ echo $found['message'];}?></p>
                <?php
                $k++; }}
                ?>
            </div> 
              </a>  
            <?php 
                $i++; }}
                $j++; }}else{ echo 'Go to <a href="listing.php">Active listings</a> to chat with house seekers';}
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
                <span onClick="closeMessages()"><i class="fa-solid fa-x"></i></span>
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
            $i++; }}
            ?>
        </div>
        <form class="typingArea" method="POST" action="processing.php">
                        <textarea type="text" name="message" placeholder="type here ..."></textarea>
                        <input type="hidden" name="senderID" value="<?php echo  $userID?>" />
                        <input type="hidden" name="receipientID" value="<?php echo  $with?>" />
                        <input type="hidden" name="subjectUnit" value="<?php echo  $subjectUnit?>" />
                        <button type="submit" name="send"><FaRegPaperPlane/></button>
        </form>
        <?php
        }
        ?>
        </div>
    </div>
            <!-- <div class="paymentArea" id="paymentArea">
            <span onClick="closePaymentSection1()"><i class="fa-solid fa-x"></i></span>
                <div>
                    <h4>Payment History</h4>
                    <table>
                        <tr>
                            <th>From</th>
                            <th>Amount</th>
                            <th>Time</th>
                            <th>Confirmation code</th>
                        </tr>
                        <tr>
                            <td>Jane Doe</td>
                            <td>Ksh 100</td>
                            <td>17th March 2023</td>
                            <td>RHFJBJBJSDB</td>
                        </tr>
                        <tr>
                            <td>Jane Doe</td>
                            <td>Ksh 100</td>
                            <td>17th March 2023</td>
                            <td>RHFJBJBJSDB</td>
                        </tr>
                        <tr>
                            <td>Jane Doe</td>
                            <td>Ksh 100</td>
                            <td>17th March 2023</td>
                            <td>RHFJBJBJSDB</td>
                        </tr>
                    </table>
                </div>
            </div> -->
</body>
</html>
<?php
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
    function showImgs(){
    document.getElementById('firstSlide').style.display = "none";
    document.getElementById('secondSlide').style.display = "block";
}
const showMenu = () =>{
    document.getElementById('menuBars').style.display = 'none';
    document.getElementById('menu').style.display = 'block';
}
const closeMenu = () =>{
    document.getElementById('menuBars').style.display = 'block';
    document.getElementById('menu').style.display = 'none';
}
</script>
