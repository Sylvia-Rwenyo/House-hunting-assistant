<?php
include_once 'conn.php';
session_start();
if($_SESSION['category'] == 'showing'){
    echo '<script> 
        window.location.href = "userProfile.php";
        </script>';
}else{
    $inView = 0;
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
    <script src="script.js"  ></script>
    <link rel="stylesheet" href="style.css">
    <title>Active Listings</title>
</head>
<body class="Listings" id="Listings">
    <div class="header">
        <h1>Active Listings</h1>
        <div class="search">
            <form id="searchForm" method="POST">
                <input name="searchQ" type="text"/>
                <button type="submit" name="search"><i class="fa-solid fa-search"></i></button>
            </form>
         </div> 
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
    <div class="mainListing">
        <div class="filterSection">
            <div id="openFilters" onClick="filters()">
                <i class="fa-solid fa-filter"></i>
            </div>
            <div id="openFilters2" onClick="closeFilters()"><span>Filters</span><i class="fa-solid fa-angle-up"></i></div>
                <form class="filters" id="filters" method="post">
                        <div>
                            <label>Cost</label>
                            <input name="cost"  type="number" />
                        </div>
                        <div>
                            <label>Location</label>
                            <input name="location" type="text"  />
                        </div>
                        <div>
                            <label>Bedrooms</label>
                            <input name="bedrooms"  type="number" />
                        </div>
                        <div>
                            <label>Bathrooms</label>
                            <input name="bathrooms"  type="number"  />
                        </div>
                        <div>
                            <label>Size in sqft</label>
                            <input name="size"  type="number" />
                        </div>
                        <div class="submit">
                            <input name="filter"  type="submit"  value="Apply"/>
                        </div>
                       
    </form> 
        </div>
        <div class="allCards" id="allCards">
        <?php

            if(isset($_POST['search']) || (isset($_GET['search']))){
                ob_start();
            ?>
            <h4 class="searchTitle">From your search</h4>
                <div class="cards" id="searchResults">
        <?php
         $userID = 0;
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
         
             $searchResults = "SELECT * FROM units WHERE " . implode(" OR ", $conditions) . " ORDER BY likes DESC";
         }        
         
                $fullQ =  mysqli_query($conn, $searchResults);
                if (mysqli_num_rows($fullQ) > 0) {
                    $i=0;
                    while($result = mysqli_fetch_array($fullQ)) {
                        $userID = $result['userID'];
                        $tour = explode('*', $result['virtualTour']);
                        $inView = $result['id'];

                ?>
            <div class="singleCard" id="singleCard<?php echo $result['id']?>" >
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
                                                        $stmt=mysqli_query($conn,"SELECT likedBy, id FROM units where id='$unitID'");
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
                    <a href="listingChat.php?inView=<?php echo  $inView?>">
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
            $searchResultsHTML = ob_get_clean(); // Get the buffered HTML content
            echo $searchResultsHTML;
            // exit; 
        ?>
        <?php
         $userID = 0;
         if (isset($_POST['filter'])) {
            $cost = $_POST['cost'] ?? '';
            $location = $_POST['location'] ?? '';
            $bedrooms = $_POST['bedrooms'] ?? '';
            $bathrooms = $_POST['bathrooms'] ?? '';
            $size = $_POST['size'] ?? '';
        
            // Prepare the SQL query with the filter criteria
            $sql = "SELECT * FROM units WHERE";
            $conditions = [];
        
            if (!empty($cost)) {
                $conditions[] = "cost = '" . mysqli_real_escape_string($conn, $cost) . "'";
            }
        
            if (!empty($location)) {
                $conditions[] = "location = '" . mysqli_real_escape_string($conn, $location) . "'";
            }
        
            if (!empty($bedrooms)) {
                $conditions[] = "bedroomNo = '" . mysqli_real_escape_string($conn, $bedrooms) . "'";
            }
        
            if (!empty($bathrooms)) {
                $conditions[] = "bathroomNo = '" . mysqli_real_escape_string($conn, $bathrooms) . "'";
            }
        
            if (!empty($size)) {
                $conditions[] = "size = '" . mysqli_real_escape_string($conn, $size) . "'";
            }
        
            if (empty($conditions)) {
                // No filters applied, retrieve all units
                $sql = "SELECT * FROM units";
            } else {
                // Add the conditions to the SQL query
                $sql .= ' ' . implode(' AND ', $conditions);
            }
        
            $sql .= " ORDER BY CASE WHEN " . implode(' AND ', $conditions) . " THEN 0 ELSE 1 END, likes DESC";
            ?>
                        <h4 class="searchTitle">From your filter search</h4>
                    <div class="cards" id="filterResults">
        <?php
        $records = mysqli_query($conn, $sql);
        if (mysqli_num_rows($records) > 0) {
            $i=0;
            while($result = mysqli_fetch_array($records)) {
                $userID = $result['userID'];
                $tour = explode('*', $result['virtualTour']);
                $inView = $result['id'];
                ?>
            <div class="singleCard" id="singleCard<?php echo $result['id']?>">
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
                 <a href="#" class="like-link" data-likes="<?php echo $result['likes'] ?>" data-id="<?php echo $result['id'] ?>" data-by="<?php echo $_SESSION['id'] ?>">
                    <button class="like-btn">
                        <i class="fa fa-heart"></i>
                        <span><?php echo $result['likes'] ?></span>
                    </button>
                </a>

                </div>
                    <div>
                        <p><?php echo $result['bedroomNo']?> bedroom house</p>
                    <a href="listingChat.php?inView=<?php echo  $inView?>">
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
            }}else{
                ?>
                <p style="margin-left: 1em;">There are no units matching your filter criteria</p>
        <?php
                }
            ?>
    </div>
            <?php
         }
        ?>
        <div class="cards" >
        <?php
            $sql = "SELECT * FROM units ORDER BY likes DESC";
        $records = mysqli_query($conn, $sql);
        if (mysqli_num_rows($records) > 0) {
            $i=0;
            while($result = mysqli_fetch_array($records)) {
                $userID = $result['userID'];
                $tour = explode('*', $result['virtualTour']);
                $inView = $result['id'];
                ?>
            <div class="singleCard" id="singleCard<?php echo $result['id']?>">
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
                 <a href="#" class="like-link" data-likes="<?php echo $result['likes'] ?>" data-id="<?php echo $result['id'] ?>" data-by="<?php echo $_SESSION['id'] ?>">
                    <button class="like-btn">
                        <i class="fa fa-heart"></i>
                        <span><?php echo $result['likes'] ?></span>
                    </button>
                </a>

                </div>
                    <div>
                        <p><?php echo $result['bedroomNo']?> bedroom house</p>
                    <a href="listingChat.php?inView=<?php echo  $inView?>">
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
            }}
            ?>
    </div>
        </div>
</div>
</div>
</body>
</html>
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
            //   echo '<script> window.location.href = "listing.php"</script>'; 
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
            // echo '<script> window.location.href = "listing.php"</script>'; 
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
}
?>
<script>
    const filters = () =>{
    document.getElementById('filters').style.display = 'block';
    document.getElementById('openFilters').style.display = 'none';
    document.getElementById('openFilters2').style.display = 'flex';
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
var formSubmitted = false;
var searchTimeout;

function handleSearchForm() {
    // Perform any necessary form processing here

    // Clear the timeout and submit the form
    clearTimeout(searchTimeout);
    $('#searchForm').submit();
  }
  // Function to submit the filters form
$('#searchForm').on('submit', function(event){
    event.preventDefault(); // Prevent the form from submitting normally
    // Perform the AJAX request
    $.ajax({
      url: 'listing.php',
      type: 'POST',
      data: $(this).serialize(),
      success: function(response) {
        // Update the search results container with the received response
        $('#filterResults').html(response);
      },
      error: function(xhr, status, error) {
        console.log(error); // Handle any errors
      }
    });
});


  $('#searchForm').on('submit', function(event) {
    event.preventDefault(); // Prevent the form from submitting normally
    // Perform the AJAX request
    $.ajax({
      url: 'listing.php?search=1',
      type: 'POST',
      data: $(this).serialize(),
      success: function(response) {
        // Update the search results container with the received response
        $('#Listings').html(response);
        formSubmitted = true;

        // Delay executing fetchData for 5 seconds (5000 milliseconds)
        setTimeout(fetchData, 15000);
        clearTimeout(searchTimeout); // Clear any existing timeout

    // Set a new timeout to delay the form submission by 2 seconds (adjust as needed)
    searchTimeout = setTimeout(function() {
        handleSearchForm();
        }, 2000); // Delay in milliseconds
      },
      error: function(xhr, status, error) {
        console.log(error); // Handle any errors
      }
    });
  });


  // Event listener for like link
  $('.like-link').on('click', function(event) {
    event.preventDefault();

    var link = $(this);
    var likes = parseInt(link.data('likes'));
    var id = link.data('id');
    var by = link.data('by');
    var isLiked = link.hasClass('liked');

    // Perform the AJAX request
    $.ajax({
      url: 'listing.php?likes',
      type: 'GET',
      data: {
        likes: likes,
        id: id,
        by: by
      },
      success: function(response) {
        if (isLiked) {
          link.removeClass('liked');
          link.find('.fa-heart').css('color', 'black');
          link.find('span').text(likes - 1);
        } else {
          link.addClass('liked');
          link.find('.fa-heart').css('color', '#c89364');
          link.find('span').text(likes + 1);
        }
      },
      error: function(xhr, status, error) {
        console.log(error); // Handle any errors
      }
    });
  });


function fetchData() {
  if (!formSubmitted) {
    $.ajax({
      url: 'listing.php', // Replace with your server-side script URL
      method: 'GET',
      success: function(response) {
        // Handle the response and update the HTML content
        $('#Listings').html(response);
        console.log("all good");
      },
      error: function(xhr, status, error) {
        // Handle errors
        console.error(error);
      }
    });
  }
}

// Call the getNewData function periodically to fetch new data
setInterval(fetchData, 60000);

</script>