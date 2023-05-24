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
<body class="Listings">
    <div class="header">
        <h1>Active Listings</h1>
        <div class="search">
        <form id="searchForm" action="processing.php">
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
    <div class="mainListing">
        <div class="filterSection">
            <div id="openFilters" onClick="filters()"><i class="fa-solid fa-filter"></i></div>
            <div id="openFilters2" onClick="closeFilters()"><span>Sort</span><i class="fa-solid fa-angle-up"></i></div>
                <div class="filters" id="filters">
                        <div>
                            <label>Bedrooms</label>
                            <input name="bedrooms" id="filterBedrooms" type="number" oninput="filterBedroom()"/>
                        </div>
                        <div>
                            <label>Bathrooms</label>
                            <input name="bathrooms" id="filterBathrooms" type="number"  oninput="filterBathrooms()"/>
                        </div>
                        <div>
                            <label>Size in sqft</label>
                            <input name="size" id="filterSize" type="number"  oninput="filterSize()"/>
                        </div>
                        <div id="parkingSpace">
                            <label>Parking space</label>
                            <input name="filterParkingSpace" id="filterParkingSpace"  type="hidden"  onclick="filterParkingSpace()"/>
                        </div>
                        <div  id="playground">
                            <label>Playground</label>
                            <input name="filterPlayground"  id="filterPlayground" type="hidden"  onclick="filterPlayground()"/>
                        </div>
                </div> 
        </div>
        <?php
        if(!empty($_GET)){
            if(isset($_GET['action']) == 'filter'){
            ?>
            <h4>From you filter search</h4>
                <div class="cards">
        <?php
         $userID = 0;
            // $records;
            // if(empty($_GET)){
           $records = mysqli_query($conn,"SELECT * FROM  units order by likes DESC");
            // }else if($_GET['filter'] == true && $_GET['filter'] !== ""){
            //     $records = mysqli_query($conn,"SELECT * FROM  units where '$filter' == '$val'");
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
                    <a href="listingChat.php?with=<?php echo $userID; $_SESSION['inView'] = $result['id']; ?>&inView=<?php echo  $_SESSION['inView']?>">
                        <span id="card<?php echo $result['id']?>">
                            <i class="fa-solid fa-message"></i>
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
            <?php
            }
        }
        ?>
    <div class="cards">
        <?php
         $userID = 0;
            // $records;
            // if(empty($_GET)){
           $records = mysqli_query($conn,"SELECT * FROM  units order by likes DESC");
            // }else if($_GET['filter'] == true && $_GET['filter'] !== ""){
            //     $records = mysqli_query($conn,"SELECT * FROM  units where '$filter' == '$val'");
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
                    <a href="listingChat.php?with=<?php echo $userID; $_SESSION['inView'] = $result['id']; ?>&inView=<?php echo  $_SESSION['inView']?>">
                        <span id="card<?php echo $result['id']?>">
                            <i class="fa-solid fa-message"></i>
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
            echo '<style type="text/css">
            .fa-heart {
                color: black;
            }
            </style>';
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
            echo '<style type="text/css">
            .fa-heart {
                color: #c89364;
            }
            </style>';
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

</script>