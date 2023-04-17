<?php 
    include_once 'conn.php';
    session_start();
    $user = $_SESSION["username"];
    if($_SESSION["loggedIN"] == false){
        header('location:index.php');
    }else{
        $id;
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
    <title>Your profile</title>
</head>
<body class="profileBody">
    <div class="header">
        <h1>Profile</h1>
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
                <?php 
                if(!empty($_GET)){
                    $profileID = $_GET['id'];
                    $records = mysqli_query($conn,"SELECT * FROM  registration where id='$profileID' ");
                    if (mysqli_num_rows($records) > 0) {
                    $i=0;
                    while($row = mysqli_fetch_array($records)) {
                        $_SESSION['userID'] = $row['id'];
                        $_SESSION['userCategory'] = $row['category'];
        ?>
        <div class="profile">
            <div class="intro">
                <img src="<?php if($row['profilePhoto'] == ''){
                    echo 'Images/user.png';} else{ echo'Uploads/' . $row['profilePhoto'];}?>" alt="profile photo"/>
                <div class="rating">
                <h4><?php echo $row['name']?></h4>
                    <form method="post" action="" id="ratingForm">
                        <div>
                            <i class="fa-solid fa-star" id="star1"><input type="hidden" name="rating[]" value="star"/></i>                   
                            <i class="fa-solid fa-star" id="star2"><input type="hidden" name="rating[]" value="star2"/></i>                   
                            <i class="fa-solid fa-star" id="star3"><input type="hidden" name="rating[]" value="star3"/></i>                   
                            <i class="fa-solid fa-star" id="star4"><input type="hidden" name="rating[]" value="star4"/></i>                   
                            <i class="fa-solid fa-star" id="star5"><input type="hidden" name="rating[]" value="star5"/></i>
                            <input type="hidden" name="rated" value="<?php echo $profileID?>" />    
                            <input type="submit" name="rate" id="rate"/>                 
                        </div>  
                    </form>
                    <?php 
                    if(isset($_POST['rate'])){
                        $rated = $_POST['rated'];
                        $star = 0;
                        if($_POST['rating'][0] == 'star'){
                            $star = 1;
                        }else if($_POST['rating'][0] == 'star2'){
                            $star = 2;
                        }else if($_POST['rating'][0] == 'star3'){
                            $star = 3;
                        }else if($_POST['rating'][0] == 'star4'){
                            $star = 4;
                        }else if($_POST['rating'][0] == 'star5'){
                            $star = 5;
                        }
                        
                        //statement to enter values into the registration table in the database
                        $sql = "UPDATE registration SET rating='$star' WHERE id='$rated'";
                   
                        //if sql query is executed...
                        if (mysqli_query($conn, $sql)) {
                                } else {	
                                   //show error
                           echo "Error: " . $sql . "
                   " . mysqli_error($conn);
                        }
                    }
                    ?>
                </div>
                <div>
                <p><a href="userChats.php?action=chat&with=<?php echo $profileID; $i++;}}?>" style="text-decoration: none; color: black;">chat<i class="fa-solid fa-message"></i></a></p>

                </div>
            </div>
            <div class="contactInfo">
            </div>
        </div>
        <div class="uploads" id="uploads">
        <h4 class="uploadsHeader">Uploads&nbsp;&nbsp;</h4>
             <div class="list" id="list">
             <?php
         $id = $_SESSION['id'];
         $userID = 0;
         $records = mysqli_query($conn,"SELECT * FROM  units where userID = '$profileID'");
         if (mysqli_num_rows($records) > 0) {
         $i=0;
         while($result = mysqli_fetch_array($records)) {
        ?>
       <div class="card" id="card<?php echo $result['id']?>">
        <?php
        $tour = explode('*', $result['virtualTour']);
        ?>
        <div class="tourCard firstSlide" id="firstSlide<?php echo $result['id']?>">
            <img src="Uploads/<?php echo $tour[0]?>" class="previewImg " alt="living room"/>
            <?php if(count($tour) > 1){?>
            <a class="prev" onclick ="showImgs(<?php echo $result['id']?>)" >&#10094;</a>
            <a class="next" onclick ="showImgs(<?php echo $result['id']?>)" >&#10095;</a>   
            <?php } ?>      
        </div>
        <div class="tourCard secondSlide" id="secondSlide<?php echo $result['id']?>">
        <?php
        // if(isset($_GET['action'])){if ($_GET['action'] == 'showSlides'){
        for($j=0; $j < count($tour); $j++){
            ?>
            <img src="Uploads/<?php echo $tour[$j]?>" class="previewImg  slide fade" id="slide<?php echo $j?>" alt="living room"/>
            <?php
        // }
    // }
}
        ?>
         <a class="prev" onclick ="plusSlides(-1)" >&#10094;</a>
            <a class="next" onclick ="plusSlides(1)" >&#10095;</a>     
</div>
       
<div class="details">
        <div>
            <h5><?php echo $result['bedroomNo']?> bedroom house</h5>
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
$i++;}}?>
        </div>
        <?php
        }else{
                    // get user info
                    $mail = $_SESSION['email'];
                    $_SESSION['userCategory'] = '';
                    $_SESSION['userID'] = 0;
                    $records = mysqli_query($conn,"SELECT * FROM  registration where emailAddress='$mail' ");
                    if (mysqli_num_rows($records) > 0) {
                    $i=0;
                    while($result = mysqli_fetch_array($records)) {
                        $_SESSION['userID'] = $result['id'];
                        $_SESSION['userCategory'] = $result['category'];

                ?>
        <div class="profile">
            <div class="intro">
                <img src="<?php if($result['profilePhoto'] == ''){
                    echo 'Images/user.png';} else{ echo'Uploads/' . $result['profilePhoto'];}?>" alt="profile photo"/>
                <div class="rating">
                <h4><?php echo $result['name']?></h4>
                    <div>
                        <i class="fa-solid fa-star"></i>                   
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                    </div>
                    
                </div>
                <div>
                <a href="userChats.php" style="text-decoration: none; color: black;"><span id="msg"><i class="fa-solid fa-message"></i></span></a>
                    <!-- <span id='pay' onClick="pay()">Pay</span> -->
                </div>
            </div>
            <div class="contactInfo">
                <p><a href='mailto:<?php echo $result['emailAddress']?>'><i class="fa-solid fa-envelope"></i>&nbsp;&nbsp;&nbsp;<?php echo $result['emailAddress']?></a></p>
                <p><a href='tel:<?php if($result['phoneNumber'] == 0){
                    echo '';} else{ echo $result['phoneNumber'];}?>'>
                    <i class="fa-solid fa-phone"></i>&nbsp;&nbsp;&nbsp;
                    <?php if($result['phoneNumber'] == 0){
                     echo 'Add phone Number in settings';} else{ echo $result['phoneNumber'];}?></a></p>
                <p><a href="profile.php?id=<?php $id= $result['id']; echo $id ; $i++;}}?>">edit<i class="fa-solid fa-gears"></i>&nbsp;&nbsp;&nbsp;</a></p>
            </div>
        </div>
            <div class="uploads" id="uploads">
            <?php
                if($_SESSION['userCategory'] == 'looking'){
            ?>
                <h4 class="uploadsHeader">History</h4>
             <?php
                    $user = $_SESSION['userID'];
                    $messagedWith = mysqli_query($conn,"SELECT * FROM  messages where  senderID ='$user'  GROUP BY  subjectUnit");
                    if (mysqli_num_rows($messagedWith) > 0) {
                        $i=0;
                        ?>
                        <div class="list" id="list">
                            <?php
                        while($result = mysqli_fetch_array($messagedWith)) {
                            $subject = $result['subjectUnit'];
                            $history = mysqli_query($conn,"SELECT * FROM  units where  id ='$subject'");
                            if (mysqli_num_rows($history) > 0) {
                                $i=0;
                                while($result = mysqli_fetch_array($history)) {
                                   ?>
                              <div class="card" id="card<?php echo $result['id']?>">
                               <?php
                               $tour = explode('*', $result['virtualTour']);
                               ?>
                               <div class="tourCard firstSlide" id="firstSlide<?php echo $result['id']?>">
                                   <img src="Uploads/<?php echo $tour[0]?>" class="previewImg " alt="living room"/>
                                   <?php if(count($tour) > 1){?>
            <a class="prev" onclick ="showImgs(<?php echo $result['id']?>)" >&#10094;</a>
            <a class="next" onclick ="showImgs(<?php echo $result['id']?>)" >&#10095;</a>   
            <?php } ?>      
                               </div>
                               <div class="tourCard secondSlide" id="secondSlide<?php echo $result['id']?>">
                               <?php
                               // if(isset($_GET['action'])){if ($_GET['action'] == 'showSlides'){
                               for($j=0; $j < count($tour); $j++){
                                   ?>
                                   <img src="Uploads/<?php echo $tour[$j]?>" class="previewImg  slide fade" id="slide<?php echo $j?>"  alt="living room"/>
                                   <?php
                               // }
                           // }
                       }
                               ?>
                                <a class="prev" onclick ="plusSlides(-1)" >&#10094;</a>
                                   <a class="next" onclick ="plusSlides(1)" >&#10095;</a>     
                       </div>
                              
                       <div class="details">
                               <div>
                                   <h5><?php echo $result['bedroomNo']?> bedroom house</h5>
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
                       $i++;}}}
                       ?>
                </div>
                <?php
                }else{
                        ?>
            <div class="list" id="list">
            <h4>Your hunt history is empty</h4>
        </div>
        <?php
                       }
        }else if($_SESSION['userCategory']  == 'showing'){
         $userID = 0;
        ?>
        <h4 class="uploadsHeader">Uploads<a href="addUnit.php">add<i class="fa-solid fa-circle-plus"></i></a></h4>
             <div class="list" id="list">
                <?php
                 $records = mysqli_query($conn,"SELECT * FROM  units where userID='$id'");
         if (mysqli_num_rows($records) > 0) {
         $i=0;
         while($result = mysqli_fetch_array($records)) {
            ?>
       <div class="card" id="card<?php echo $result['id']?>">
        <?php
        $tour = explode('*', $result['virtualTour']);
        ?>
        <div class="tourCard firstSlide" id="firstSlide<?php echo $result['id']?>">
            <img src="Uploads/<?php echo $tour[0]?>" class="previewImg " alt="living room"/>
            <?php if(count($tour) > 1){?>
            <a class="prev" onclick ="showImgs(<?php echo $result['id']?>)" >&#10094;</a>
            <a class="next" onclick ="showImgs(<?php echo $result['id']?>)" >&#10095;</a>   
            <?php } ?>     
        </div>
        <div class="tourCard secondSlide" id="secondSlide<?php echo $result['id']?>">
        <?php
        // if(isset($_GET['action'])){if ($_GET['action'] == 'showSlides'){
        for($j=0; $j < count($tour); $j++){
            ?>
            <img src="Uploads/<?php echo $tour[$j]?>" class="previewImg  slide fade" id="slide<?php echo $j?>"  alt="living room"/>
            <?php
        // }
    // }
}
        ?>
         <a class="prev" onclick ="plusSlides(-1)" >&#10094;</a>
            <a class="next" onclick ="plusSlides(1)" >&#10095;</a>     
</div>
       
<div class="details">
        <div>
            <h5><?php echo $result['bedroomNo']?> bedroom house</h5>
            <a href="addUnit.php?action=editUpload&id=<?php echo $result['id']?>" style="text-decoration: none; color: black;"><span id='edit'>edit<i class="fa-solid fa-pencil"></i></span></a>
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
$i++;}}}?>
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
        </div>
        
</body>
</html>
<?php
}}
?>
<script>


let ratingForm = document.getElementById('ratingForm');
document.getElementById('star1').onclick = () => {
        ratingForm.submit();
}
document.getElementById('star2')= () => {
        ratingForm.submit();
}
document.getElementById('star3')= () => {
        ratingForm.submit();
}
document.getElementById('star4')= () => {
        ratingForm.submit();
}
document.getElementById('star5')= () => {
        ratingForm.submit();
}

</script>