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
        window.location.href = "index.php?action=logIn";
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
</script> 
    <div class="header">
        <h1>Profile</h1>
        <!-- <div class="search">
            <form id="searchForm" action="userProfile.php" method="POST">
                <input name="searchQ" type="text"/>
                <button type="submit" name="search"><i class="fa-solid fa-search"></i></button>
            </form>
         </div>  -->
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
            .viewing{background-color: rgb(98, 150, 67);}
            .showing{background-color: rgba(98, 150, 67, 0.3);}
            </style>';
        }
        if($_SESSION['category'] == 'showing'){
            $_SESSION['default'] = 1;
        }
        if (($_SESSION['category'] == 'showing' || isset($_SESSION['default'])) && !stristr( $_SESSION['email'], '@admin.com')){

        ?>

        <div class="switchMode">
            <a href="userProfile.php?mode=showing" class="showing"><button class="btn">Show</button></a>
            <a href="userProfile.php?mode=viewing" class="viewing"><button class="btn">View</button></a>
        </div>
        <?php
        }
        ?>
        <span class="menuBar" id="menuBars" onClick="showMenu()"><i class="fa-solid fa-bars"></i></span>
        <?php
            include_once 'menu.php';
        ?>
    </div>

    <!-- Header section code here -->
    <?php
    if (isset($_SESSION['id'])) {
            $profileID = $_SESSION['id'];
            $stmt = $conn->prepare("SELECT * FROM registration WHERE id = ?");
            $stmt->bind_param("i", $profileID);
            $stmt->execute();
            $result = $stmt->get_result();
        }else{
            $mail = $_SESSION['email'];
            $stmt = $conn->prepare("SELECT * FROM registration WHERE emailAddress = ?");
            $stmt->bind_param("s", $mail);
            $stmt->execute();
            $result = $stmt->get_result();
        }
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $_SESSION['id']= $row['id'];
                if(!isset($_SESSION['mail'])){
                    $_SESSION['mail'] = $row['emailAddress'];
                }
                ?>
                <div class="profile">
        <div class="intro">
            <img src="<?php echo ($row['profilePhoto'] == '') ? 'Images/user.png' : 'Uploads/' . $row['profilePhoto']; ?>" alt="profile photo"/>
            <div class="rating">
                <h4><?php echo $row['name']; ?></h4>
            </div>
            <div class="links">
                <p>
                    <a href="listingChat.php?inV=<?php if(isset($_SESSION['inView'])){echo $_SESSION['inView'];}else{echo 0;};?>" style="text-decoration: none; color: black;">
                        <i class="fa-solid fa-message"></i>
                    </a>
                </p>
                <p>
                    <a href="profile.php?id=<?php echo$row['id']; ?>" style="text-decoration: none; color: black;">
                    <i class="fa-solid fa-gears"></i></a>
                </p>
            </div>
        </div>
        <div class="contactInfo">
        </div>
    </div>

    <?php 
        }
    }

    if ($_SESSION['category'] == 'showing' && !stristr( $_SESSION['email'], '@admin.com')) {
        echo '<style>
        .showing{background-color: rgb(98, 150, 67);}
        .viewing{background-color: rgba(98, 150, 67, 0.5);}
        </style>';
        $userID = $_SESSION['id'];
    ?>
    <div class="uploads" id="uploads">
        <h4 class="uploadsHeader">Uploads&nbsp;&nbsp;<a href="addUnit.php"><i class="fa-solid fa-add"></i></a></h4>
        <?php
            if(isset($_POST['search'])){
            ?>
            <h4 class="searchTitle">From your search</h4>
                <div class="cards" id="searchResults">
        <?php
         $searchQ = $_POST['searchQ'];
         $keywords = explode(' ', $searchQ);
         
         if (count($keywords) > 0) {
             $conditions = [];
             foreach ($keywords as $keyword) {
                 if ($keyword === 'sale' || $keyword === 'for' || $keyword === 'for sale') {
                     $conditions[] = "category LIKE '%sale%'";
                 } else {
                     $conditions[] = "category = '$keyword' OR cost = '$keyword' OR location = '$keyword' OR size = '$keyword' OR bedroomNo = '$keyword'";
                 }
             }
         
             $searchResults = "SELECT * FROM units WHERE " . implode(" OR ", $conditions) . " && userID =' $userID '  ORDER BY likes DESC";
         }        
         
                $fullQ =  mysqli_query($conn, $searchResults);
                if (mysqli_num_rows($fullQ) > 0) {
                    $i=0;
                    while($result = mysqli_fetch_array($fullQ)) {
                        $userID = $result['userID'];
                ?>
            <div class="singleCard" id="singleCard<?php echo $result['id']?>">
            <?php
            $tour = explode('*', $result['virtualTour']);
                 if (strstr($tour[0], '.mp4')) {
                     ?>
                     <video controls>
                         <source src="Uploads/<?php echo $tour[0] ?>" type="video/mp4">
                     </video>
                 <?php
                 } else {
                     ?>
                     <img src="Uploads/<?php echo $tour[0] ?>" class="previewImg " id="slide<?php echo $result['id'] ?>" alt="living room"/>
                 <?php
                 }
                 ?>
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
                    <a href="listing-details.php?likes=<?php echo $result['likes']?>&id=<?php echo $result['id']?>&by=<?php echo $_SESSION['id']?>">
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
            <?php
            $i++;
            }}else {
                echo 'no result matching your search has been found';
            }
            ?>
    </div>
            <?php
            }
        ?>
        <div class="cards" >
            <?php
        // Make sure to initialize $conn and $userID variables before using them
        $sql = "SELECT * FROM units WHERE userID = '$userID' ORDER BY likes DESC";
        $records = mysqli_query($conn, $sql);
        
        if (!$records) {
            die("Query failed: " . mysqli_error($conn));
        }
        
        if (mysqli_num_rows($records) > 0) {
            $i = 0;
            while ($result = mysqli_fetch_array($records)) {
                ?>
                <div class="singleCard" id="singleCard<?php echo $result['id'] ?>">
                    <?php
                    $tour = explode('*', $result['virtualTour']);
                    if (strstr($tour[0], '.mp4')) {
                        ?>
                        <video controls>
                            <source src="Uploads/<?php echo $tour[0] ?>" type="video/mp4">
                        </video>
                    <?php
                    } else {
                        ?>
                        <img src="Uploads/<?php echo $tour[0] ?>" class="previewImg" id="slide<?php echo $i ?>" alt="living room"/>
                    <?php
                    }
                    ?>
                   
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
 <a href="listing-details.php?likes=<?php echo $result['likes']?>&id=<?php echo $result['id']?>&by=<?php echo $_SESSION['id']?>">
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
                    <p><i class="fa fa-location-dot"></i> <?php echo $result['location']?>&nbsp;&nbsp;<i class="fa fa-ellipsis"onclick="showDetails(<?php echo $result['id']?>)" ></i>
</p>
            </div>
            <?php
            $i++;
            }}else{
                ?>
                <p>No uploads yet. Add a listing <a href="addUnit.php">here <i class="fa fa-arrow-right"></i></a></p>
                <?php
            }
            ?>
        </div>
    </div><?php
    }else if(stristr($_SESSION['email'], '@admin.com') && $_SESSION['category'] == 'showing'){
        ?>
      <div class="uploads admin" id="uploads">
    <h4 class="uploadsHeader">User Queries</h4>
    <?php
    $sql = "SELECT fq.question_id, fq.question_text, fa.answer_text, fa.answer_id
            FROM forum_questions fq
            LEFT JOIN forum_answers fa ON fq.question_id = fa.question_id
            ORDER BY fq.question_id DESC";
    $records = mysqli_query($conn, $sql);
    if (mysqli_num_rows($records) > 0) {
        while ($result = mysqli_fetch_array($records)) {
            $questionID = $result['question_id'];
    ?>
    <div class="singleCard" id="fq<?php echo $result['question_id']; ?>"
         data-question-id="<?php echo $result['question_id']; ?>"
         data-answer-id="<?php echo $result['answer_id']; ?>"
         data-question-text="<?php echo $result['question_text']; ?>"
         data-answer-text="<?php echo $result['answer_text']; ?>">
        <h3><?php echo $result['question_text']; ?></h3>
        <div>
            <?php
            if ($result['answer_id'] !== null) {
                // Display existing answer if available
                echo "<p>{$result['answer_text']}</p>";
            } else {
                // Display a form to add an answer
                echo '<form method="POST" action="processing.php">';
                echo '<textarea name="answer_text" placeholder="Add an answer..."></textarea>';
                echo '<input type="hidden" name="question_id" value="' . $result['question_id'] . '">';
                echo '<button type="submit" name="answerFQ" class="btn lg logIn">Submit</button>';
                echo '</form>';
            }
            ?>
        </div>
    </div>
    <?php
        }
    }
    ?>
</div>

                <?php
                }
                if($_SESSION['category'] == 'looking'){
            ?>
            <div class="uploads" id="uploads">
                <h4 class="uploadsHeader">History</h4>
             <?php
                    $user = $_SESSION['id'];
                    $messagedWith = mysqli_query($conn,"SELECT * FROM  messages where  senderID ='$user'  GROUP BY  subjectUnit");
                    if (mysqli_num_rows($messagedWith) > 0) {
                        $i=0;
                        ?>
                        <div class="cards" id="list">
                            <?php
                        while($result = mysqli_fetch_array($messagedWith)) {
                            $subject = $result['subjectUnit'];
                            $history = mysqli_query($conn,"SELECT * FROM  units where  id ='$subject'");
                            if (mysqli_num_rows($history) > 0) {
                                $i=0;
                                while($records = mysqli_fetch_array($history)) {
                                   ?>
                             <div class="singleCard" id="singleCard<?php echo $records['id']?>" onclick="showDetails(<?php echo $records['id']?>)">
                <?php
                 $tour = explode('*', $records['virtualTour']);
                 if (strstr($tour[0], '.mp4')) {
                     ?>
                     <video controls>
                         <source src="Uploads/<?php echo $tour[0] ?>" type="video/mp4">
                     </video>
                 <?php
                 } else {
                     ?>
                     <img src="Uploads/<?php echo $tour[0] ?>" class="previewImg " id="slide<?php echo $records['id'] ?>" alt="living room"/>
                 <?php
                 }
                 ?>
                <div>
                    <?php
                    if($records['category'] == 'forSale'){
                    ?>
                    <p class="category">For sale</p>
                    <?php
                    }elseif($records['category'] == 'rental'){
                    ?>
                        <p class="category">Rental</p>
                        <?php
                        }
                        ?>
                    <a href="listing-details.php?likes=<?php echo $records['likes']?>&id=<?php echo $records['id']?>&by=<?php echo $_SESSION['id']?>">
                        <button class="like-btn">
                            <i class="fa fa-heart" <?php
                                                        $unitID=$records['id'];
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
                            <span><?php echo $records['likes']?></span>
                        </button>
                    </a>
                </div>
                    <div>
                        <p><?php echo $records['bedroomNo']?> bedroom house</p>
                    <a href="listingChat.php?with=<?php echo $userID; $_SESSION['inView'] = $records['id']; ?>&inView=<?php echo  $_SESSION['inView']?>">
                        <span id="card<?php echo $records['id']?>">
                            <i class="fa-solid fa-message"></i>
                        </span>
                    </a>
                    </div>
                    <p>Ksh <?php echo $records['cost']?></p>
                    <p><i class="fa fa-location-dot"></i> <?php echo $records['location']?>&nbsp;&nbsp;<i class="fa fa-ellipsis"onclick="showDetails(<?php echo $records['id']?>)" ></i>
            </div>
                       <?php
                       $i++;}}}
                       ?>
                </div>
                <?php
                }else{
                        ?>
            <div class="list" id="list" style="height: auto;">
            <h4>Your hunt history is empty</h4>
            <a href="index.php">
                See new listings here <i class="fa fa-arrow-right"></i>
            </a>
        </div>
        <?php
                       }
   ?> 
</body>
<?php
}
?>
<script>
   function editFQ(button) {
    const parentDiv = button.parentElement;
    const questionID = parentDiv.getAttribute('data-question-id');
    const answerID = parentDiv.getAttribute('data-answer-id');
    const questionText = parentDiv.getAttribute('data-question-text');
    const answerText = parentDiv.getAttribute('data-answer-text');

    const divID = 'fq' + questionID;
    const targetDiv = document.getElementById(divID);

    targetDiv.innerHTML = '';
    targetDiv.innerHTML = '<h3>' + questionText + '</h3> <form method="POST" action="processing.php">' +
        '<textarea name="answer_text">' + answerText + '</textarea><input type="hidden" name="answer_id" value="' + answerID + '"' +
        '<div><button type="submit" name="editFQ" class="btn lg logIn">Send</button>' +
        '<button class="btn lg logIn cancelFQ" name="cancelFQ">Back</button></div></form>';
}

</script>
</html>