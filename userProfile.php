<?php
include_once 'conn.php';
session_start();

// Check if the session is already started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Check if the user is logged in
if (!isset($_SESSION["loggedIN"]) || $_SESSION["loggedIN"] !== true) {
    echo '<script> 
        window.location.href = "index.php";
        </script>';
    exit; // Add an exit statement after the redirect
}

$id = null; // Initialize the variable

// Start HTML markup
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://kit.fontawesome.com/2751fbc624.js" crossorigin="anonymous"></script>
    <script src="script.js"></script>
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

        <?php
        if (isset($_GET['mode'])) {
            if ($_GET['mode'] == "showing") {
                $_SESSION['category'] = 'showing';
            } else if ($_GET['mode'] == "viewing") {
                $_SESSION['category'] = 'looking';
            }
        }
        if ($_SESSION['category'] == 'looking') {
            echo '<style>
            .viewing{background-color:  #62A039;}
            .showing{background-color: rgb(131, 164, 111);}
            </style>';
        }
        ?>

        <div class="switchMode">
            <a href="userProfile.php?mode=showing" class="showing"><button class="btn">Show</button></a>
            <a href="userProfile.php?mode=viewing" class="viewing"><button class="btn">View</button></a>
        </div>

        <span class="menuBar" id="menuBars" onClick="showMenu()"><i class="fa-solid fa-bars"></i></span>
        <div class="menu" id="menu">
            <span class="menuBar" id="menuBar" onClick="closeMenu()"><i class="fa-solid fa-x"></i></span>
            <ul>
                <a href="listing.php"><li class="active">Active Listings</li></a>
                <a href="userProfile.php"><li class="active">Profile</li></a>
                <a href="tools.php"><li class="active">Tools</li></a>
                <a href="contacts.php"><li class="active">Help</li></a>
            </ul>
        </div>
    </div>

    <!-- Header section code here -->
    <?php
    if (isset($_SESSION['id'])) {
        $profileID = $_SESSION['id'];
        $stmt = $conn->prepare("SELECT * FROM registration WHERE id = ?");
        $stmt->bind_param("i", $profileID);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $_SESSION['userID'] = $row['id'];
                ?>
                <div class="profile">
        <div class="intro">
            <img src="<?php echo ($row['profilePhoto'] == '') ? 'Images/user.png' : 'Uploads/' . $row['profilePhoto']; ?>" alt="profile photo"/>
            <div class="rating">
                <h4><?php echo $row['name']; ?></h4>
            </div>
            <div class="links">
                <p><a href="userChats.php?action=chat&with=<?php echo $profileID; ?>" style="text-decoration: none; color: black;"><i class="fa-solid fa-message"></i></a></p>
                <p><a href="profile.php?id=<?php echo $profileID; ?>" style="text-decoration: none; color: black;"><i class="fa-solid fa-gears"></i></a></p>
            </div>
        </div>
        <div class="contactInfo">
        </div>
    </div>

    <?php 
        }
    }

    if ($_SESSION['category'] == 'showing') {
        echo '<style>
        .showing{background-color:  #62A039;}
        .viewing{background-color: rgb(131, 164, 111);}
        </style>';
    ?>
    <div class="uploads" id="uploads">
        <h4 class="uploadsHeader">Uploads&nbsp;&nbsp;<i class="fa-solid fa-add"></i></h4>
        <div class="cards" >
            <?php
        $sql = "SELECT * FROM units where userID = '$profileID' ORDER BY likes DESC";
        $records = mysqli_query($conn, $sql);
        if (mysqli_num_rows($records) > 0) {
            $i=0;
            while($result = mysqli_fetch_array($records)) {
                $userID = $result['userID'];
                $tour = explode('*', $result['virtualTour']);

                ?>
            <div class="singleCard" id="singleCard<?php echo $result['id']?>" onclick="showDetails(<?php echo $result['id']?>)">
                <img src="Uploads/<?php echo $tour[0]?>" class="previewImg " alt=""/>
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
                    <a href="addUnit.php?action=editUpload&id=<?php echo $result['id'];?>">
                        <span id="card<?php echo $result['id']?>">
                            <i class="fa-solid fa-edit"></i>
                        </span>
                    </a>
                    <a href="processing.php?action=deleteUpload&id=<?php echo $result['id'];?>">
                        <span id="card<?php echo $result['id']?>">
                            <i class="fa-solid fa-trash"></i>
                        </span>
                    </a>
                    </div>
                    <p>Ksh <?php echo $result['cost']?></p>
                    <p><i class="fa fa-location-dot"></i> <?php echo $result['location']?></p>
            </div>
            <?php
            $i++;
            }}
            ?>
        </div>
    </div>
             <?php
             }else if($_SESSION['category'] == 'looking'){
            ?>
            <div class="uploads" id="uploads">
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
   ?>
        
</body>
</html>
<?php
}}

?>