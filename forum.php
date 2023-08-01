<?php
include_once 'conn.php';
session_start();
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
    <!-- <script src="script.js"  ></script> -->
    <link rel="stylesheet" href="style.css">
    <title>Active Listings</title>
</head>
<body class="Listings" id="forum">
    <div class="header" id="listing-header">
        <h1>Active Listings</h1>
        <div class="search" id="listing-search">
            <form id="searchForm" method="POST">
                <input name="searchQ" type="text"/>
                <button type="submit" name="search"><i class="fa-solid fa-search"></i></button>
            </form>
         </div> 
        <span class="menuBar" id="menuBars" onClick="showMenu()"><i class="fa-solid fa-bars"></i></span>
        <?php
            include_once 'menu.php';
        ?>
    </div>
    <div class="cards">
    <?php
    if (isset($_POST['search']) || isset($_GET['search']) || isset($_POST['postToForum'])) {
        ob_start();
        ?>
        <h4 class="searchTitle">From your search</h4>
        <div class="cards" id="searchResults">
        <?php
        $searchQ = isset($_POST['searchQ']) ? $_POST['searchQ'] : '';

        $searchResults = "SELECT fq.question_text
                            FROM forum_questions fq
                            WHERE MATCH(question_text) AGAINST('$searchQ' IN NATURAL LANGUAGE MODE)";

        $fullQ = mysqli_query($conn, $searchResults);
        if (mysqli_num_rows($fullQ) > 0) {
            while ($result = mysqli_fetch_array($fullQ)) {
                $questionText = $result['question_text'];
                ?>
                <div class="singleCard">
                    <h5><?php echo $questionText; ?></h5>
                    <div>
                        <p>Answer</p>
                    </div>
                </div>
                <?php
            }
        } else {
            $newQuestion = isset($_POST['question_text']) ? $_POST['question_text'] : '';
            $insertQuestionQuery = "INSERT INTO forum_questions (question_text) VALUES ('$newQuestion')";
            mysqli_query($conn, $insertQuestionQuery);
            echo '<p style="margin-left: 1em">Your question will be answered within 24 hours.</p>';
        }
        ?>
        </div>
        <?php
        $searchResultsHTML = ob_get_clean();
        echo $searchResultsHTML;
    }
    ?>
    </div>
    <div class="cards">
        <div class="singleCard">
            <h5>Ask a question</h5>
            <form method="POST">
                <textarea name="question_text"></textarea>
                <button type="submit" name="postToForum" class="btn lg signUp"></button>
            </form>
        </div>
        <?php
        $sql = "SELECT fq.question_id, fq.question_text, fa.answer_text
                FROM forum_questions fq
                JOIN (
                    SELECT question_id, COUNT(*) AS answer_count
                    FROM forum_answers
                    GROUP BY question_id
                ) AS fa_counts ON fq.question_id = fa_counts.question_id
                JOIN forum_answers fa ON fq.question_id = fa.question_id
                WHERE fa_counts.answer_count > 0
                ORDER BY fa_counts.answer_count DESC";
        $records = mysqli_query($conn, $sql);
        if (mysqli_num_rows($records) > 0) {
            while ($result = mysqli_fetch_array($records)) {
                $questionID = $result['question_id'];
                ?>
                <div class="singleCard">
                    <h5><?php echo $result['question_text']; ?></h5>
                    <div>
                        <p><?php echo $result['answer_text']; ?></p>
                    </div>
                </div>
                <?php
            }
        }
        ?>
    </div>
</body>
</html>
<?php
if (isset($_SESSION['category'])) {
    if ($_SESSION['category'] == 'showing') {
        echo '<script> 
            window.location.href = "userProfile.php";
            </script>';
    }
}
?>

<script>
    // JavaScript code here
</script>

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
    document.getElementById('filterResults').style.display = 'none';
    document.getElementById('filterResult').style.display = 'none';

}
const showMenu = () =>{
    document.getElementById('menuBars').style.display = 'none';
    document.getElementById('menu').style.display = 'block';
    document.getElementById('listing-header').style.width = '80%';
    let screenWidth = window.innerWidth ;
    document.getElementById('listing-search').style.width = screenWidth * 0.28 + "px";
    console.log( document.getElementById('listing-search').style.width);
}
const closeMenu = () =>{
    document.getElementById('menuBars').style.display = 'block';
    document.getElementById('menu').style.display = 'none';
    document.getElementById('listing-header').style.width = '100%';
    document.getElementById('listing-search').style.width = '30%';
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
$('#filters').on('submit', function(event){
    event.preventDefault(); // Prevent the form from submitting normally
    document.getElementById('filters').style.display = 'block';
    document.getElementById('openFilters').style.display = 'none';
    document.getElementById('openFilters2').style.display = 'flex';
    // Perform the AJAX request
    $.ajax({
      url: 'help.php?filter=1',
      type: 'POST',
      data: $(this).serialize(),
      success: function(response) {
        // Update the search results container with the received response
        $('#Listings').html(response);
      },
      error: function(xhr, status, error) {
        console.log(error); // Handle any errors
      }
    });
});
  
function fetchData() {
  if (!formSubmitted) {
    $.ajax({
      url: 'forum.php', // Replace with your server-side script URL
      method: 'GET',
      success: function(response) {
        // Handle the response and update the HTML content
        $('#forum').html(response);
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