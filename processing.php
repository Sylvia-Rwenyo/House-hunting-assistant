<?php
//connect to database
include_once 'conn.php';

$loginStatus = false;
$cost;
$category;
$location;
$others;
$virtualTour = "";
$size;
$bedroomNo;
// session_start(); 
// $_SESSION["category"] = '';
// $_SESSION["cost"] = 0;
// $_SESSION["size"] = 0;
// $_SESSION["bedroomNo"] = 0;
// $_SESSION["location"] = '';
// $_SESSION['others'] = array();
// $_SESSION['virtualTour'] = array();

//sign up
// check that signup is not null
if(isset($_POST['signUp']))
{	
    //create session
    session_start();
    
    //store values submitted in the signup form in variables
	 $name = $_POST['name'];
	 $emailAddress = $_POST['emailAddress'];
	 $password = $_POST['password'];
     $category = $_POST['category'];
     //statement to enter values into the registration table in the database
	 $sql = "INSERT INTO registration (name,emailAddress, password, category)
	 VALUES ('$name','$emailAddress','$password', '$category')";

     //if sql query is executed...
	 if (mysqli_query($conn, $sql)) {
            login($conn);
		} else {	
                //show error
		echo "Error: " . $sql . " " . mysqli_error($conn);
	 }
        //close connection
        mysqli_close($conn);

    }
if(isset($_POST['editProfile']))
{	 
     // specify directory for uploading the file
     $target_dir3 = "Uploads/";
     $fileName3 = basename($_FILES["profilePhoto"]["name"]);
     $targetFilePath3 = $target_dir3 . $fileName3;
     $imageFileType3 = strtolower(pathinfo($targetFilePath3,PATHINFO_EXTENSION));

    //if file input is not empty
     if(!empty($_FILES["profilePhoto"]["name"])){
     //move uploaded file
     move_uploaded_file($_FILES["profilePhoto"]["tmp_name"], $targetFilePath3);
     } 
    session_start();
   //store values submitted in the edit profile form in variables
    $id = $_POST['id'];
    $name = $_POST['name'];
    $emailAddress = $_POST['emailAddress'];
    $password = $_POST['password'];
    $profilePhoto = $fileName3;
    $phoneNumber = $_POST['phoneNumber'];
    //statement to update values
    $sql = "UPDATE registration SET name='$name', emailAddress='$emailAddress', password='$password', 
                   profilePhoto='$profilePhoto', phoneNumber='$phoneNumber' WHERE id='$id'";

    // if sql query is executed and database connection is established
    if (mysqli_query($conn, $sql)) {
        $_SESSION["username"]=$name;
        $_SESSION["mail"]=$emailAddress;
        echo ' <script> 
        window.location.href = "userProfile.php";
        </script>
        ';
    } else {	
    echo "Error: " . $sql . "
" . mysqli_error($conn);
    }
    mysqli_close($conn);
}
if(isset($_POST['logIn']))
{
    //create session
    session_start();
    login($conn);
}
function login($conn){
      //import variables from an array into local symbol table
      extract($_POST);
      $emailAddress = $_POST ["emailAddress"];
      $password = $_POST ["password"];
  
       //statement to select values from the registration table in the database
      $sql=mysqli_query($conn,"SELECT * FROM registration where emailAddress='$emailAddress' and password='$password'");
      //fetch the result row as an array
      $row  = mysqli_fetch_array($sql);
      //if sql query is executed...
      if(is_array($row))
      {
          $_SESSION["email"]=$row['emailAddress'];
          $_SESSION["username"]=$row['name'];
          $_SESSION["id"]=$row['id'];
          $_SESSION['category']=$row['category'];
          $_SESSION['credits']=$row['credits'];
          $_SESSION["loggedIN"] = true;
          $loginStatus = $_SESSION["loggedIN"];
          if($_SESSION['category'] == 'looking'){
              echo ' <script> 
          window.location.href = "listing.php"
          </script>
          '; 
          }else if($_SESSION['category'] == 'showing'){
              echo ' <script> 
          window.location.href = "userProfile.php"
          </script>
          '; 
          }
      }
      else
      {
          echo "Invalid Username /Password";
      }
}
if(isset($_GET['action1'])){
    if($_GET['action1'] == "msgAdmin"){
        assignReceipient($conn);
        $redirect = $_GET['from'];
        echo ' <script> 
        window.location.href = "'. $redirect . $receipientID .'";
        </script>
        ';
    }
}
if(isset($_GET['action'])){
    // log out if the user selects "Log Out" on the menu bar
        if($_GET['action']== "logOut"){
            session_start();
            session_unset();
            echo ' <script> 
        window.location.href = "index.php";
        </script>
        '; 
        }
    }
    if(isset($_POST['next1'])){	
        session_start(); 
        unset($_SESSION["unitCategory"]);
        unset($_SESSION["cost"]) ;
        unset($_SESSION["size"]);
        unset($_SESSION["bedroomNo"]);
        unset($_SESSION["location"]);
        unset($_SESSION["bathroomNo"]);
      
        $_SESSION["unitCategory"] = $_POST['category'];
        $_SESSION["cost"] = $_POST['cost'];
        $_SESSION["size"] = $_POST['size'];
        $_SESSION["bedroomNo"] = $_POST['bedroomNo'];
        $_SESSION["location"]= $_POST['location'];
        $_SESSION["bathroomNo"]= $_POST['bathroomNo'];
        $_SESSION["next1"] = true;

        if(isset($_POST['edit'])){
            echo ' <script> 
            window.location.href = "addUnit.php?action=edit&a=2" ;
            </script>';
        }else if(isset($_POST['editUpload'])){
            $id = $_POST['editUpload'];
            echo ' <script> 
            window.location.href = "addUnit.php?action=editUpload&a=2&id='.$id.'" ;
            </script>';
        }else if(isset($_POST['state'])){
            echo ' <script> 
            window.location.href = "addUnit.php?a=5" ;
            </script>';
         }else{
         echo ' <script> 
            window.location.href = "addUnit.php?a=2" ;
            </script>';
        }
    
    }
    
    if(isset($_POST['next2-1']))
    {	 
        session_start();
        unset($_SESSION["condition"]);
        unset($_SESSION["accessibility"]);
        $_SESSION["condition"]= $_POST['condition'];
        for($i=0; $i < count($_POST['accessibility']); $i++){
            $_SESSION['accessibility'][] = $_POST['accessibility'][$i];
             }
         $_SESSION["next2-1"] = true;

         if(isset($_POST['edit'])){
            echo ' <script> 
            window.location.href = "addUnit.php?action=edit&a=3" ;
            </script>';
        }else if(isset($_POST['editUpload'])){
            $id = $_POST['editUpload'];
            echo ' <script> 
            window.location.href = "addUnit.php?action=editUpload&a=3&id='.$id.'" ;
            </script>';
        }else if(isset($_POST['state'])){
            echo ' <script> 
            window.location.href = "addUnit.php?a=8" ;
            </script>';
         }else{
         echo ' <script> 
            window.location.href = "addUnit.php?&a=3" ;
            </script>';
        }
    }if(isset($_POST['next2']))
    {	 
        session_start();
        unset($_SESSION["others"]);
        unset($_SESSION["amenities"]);
        for($i=0; $i < count($_POST['amenities']); $i++){
        $_SESSION['amenities'][] = $_POST['amenities'][$i];
            }
         for($i=0; $i < count($_POST['others']); $i++){
        $_SESSION['others'][] = $_POST['others'][$i];
         }
         $_SESSION["next2"] = true;

         if(isset($_POST['edit'])){
            echo ' <script> 
            window.location.href = "addUnit.php?action=edit&a=4" ;
            </script>';
        }else if(isset($_POST['editUpload'])){
            $id = $_POST['editUpload'];
            echo ' <script> 
            window.location.href = "addUnit.php?action=editUpload&a=4&id='.$id.'" ;
            </script>';
        }else{
         echo ' <script> 
            window.location.href = "addUnit.php?&a=9" ;
            </script>';
        }
    }
   
    if(isset($_POST['preview']))
{	 
    session_start();
    if(!isset($_SESSION['virtualTour'])){
        $_SESSION['virtualTour'];
   
    $files = array_filter($_FILES['virtualTour']['name']);
        //count the no of uploaded files
    $fileCount = count($_FILES['virtualTour']['name']);
    for($i=0; $i < $fileCount; $i++){
        //obtain temp file
        $tmpFilePath = $_FILES['virtualTour']['tmp_name'][$i];
        //make sure a file is present
        if($tmpFilePath != ""){
            //set up new file path
            $newFilePath = "Uploads/".$_FILES['virtualTour']['name'][$i];
            $_SESSION['virtualTour'][] = $_FILES['virtualTour']['name'][$i];
            //upload file to temp dir
            move_uploaded_file($tmpFilePath, $newFilePath);
        }
    }
    }else{
        $files = array_filter($_FILES['virtualTour']['name']);
        //count the no of uploaded files
    $fileCount = count($_FILES['virtualTour']['name']);
    for($i=0; $i < $fileCount; $i++){
        //obtain temp file
        $tmpFilePath = $_FILES['virtualTour']['tmp_name'][$i];
        //make sure a file is present
        if($tmpFilePath != ""){
            //set up new file path
            $newFilePath = "Uploads/".$_FILES['virtualTour']['name'][$i];
            $_SESSION['virtualTour'][] = $_FILES['virtualTour']['name'][$i];
            //upload file to temp dir
            move_uploaded_file($tmpFilePath, $newFilePath);
        }
    }
    }
    if(isset($_POST['editUpload'])){
        echo ' <script> 
        window.location.href = "preview.php?state=edited&id='. $_POST['editUpload'].'" ;
        </script>';
    }else{
     echo ' <script> 
        window.location.href = "preview.php" ;
        </script>';
    }

}

if(isset($_GET['action'])){
    // log out if the user selects "Log Out" on the menu bar
        if($_GET['action']== "logOut"){
            session_start();
            session_unset();
            echo ' <script> 
                        window.location.href = "index.php"
                    </script>
        '; 
        }
    
        if($_GET['action'] == "deleteAccount"){
            $id = $_GET['id'];
            $sql = "DELETE FROM registration WHERE id=$id";
             if (mysqli_query($conn, $sql))
              {     
                session_start();
                session_unset();      
                echo ' <script> 
                         window.location.href = "index.php";
                       </script>';
             } 
        
             else {
                echo "Error: " . $sql . "
        " . mysqli_error($conn);
             }
             mysqli_close($conn);
        }
        if ($_GET['action'] == "deleteUpload") {
            $id = $_GET['id'];
        
            $stmt = $conn->prepare("DELETE FROM units WHERE id = ?");
            $stmt->bind_param("i", $id);
        
            if ($stmt->execute()) {
                echo '<script>
                         window.location.href = "userProfile.php";
                      </script>';
            } else {
                echo "Error: " . $stmt->error;
            }
        
            $stmt->close();
            $conn->close();
        }
        
        if($_GET['action']== "uploadUnit"){
            session_start();
            $cost = $_SESSION["cost"];
            $category = $_SESSION["unitCategory"];
            $location = $_SESSION["location"];
            $condition = $_SESSION["condition"];
            $accessibility = implode('*', $_SESSION["accessibility"]);
            $amenities = implode("*", $_SESSION['amenities']);
            $others = implode('*', $_SESSION["others"]);
            $virtualTour = implode("*", $_SESSION['virtualTour']);
            $size = $_SESSION["size"];
            $userID = $_SESSION['id'];
            $bedroomNo = $_SESSION["bedroomNo"];
            $bathroomNo = $_SESSION["bathroomNo"];
            //    statement to enter values into the registration table in the database
            $sql = "INSERT INTO units (cost, size, bedroomNo, category, location, virtualTour, others, accessibility, unitCondition, amenities, userID)
            VALUES ('$cost','$size','$bedroomNo', '$category', '$location', '$virtualTour',  '$others','$accessibility','$condition',  '$amenities', '$userID')";

            //  if sql query is executed...
            if (mysqli_query($conn, $sql)) {
                unset($_SESSION["unitCategory"]);
                unset($_SESSION["cost"]) ;
                unset($_SESSION["size"]);
                unset($_SESSION["bedroomNo"]);
                unset($_SESSION["location"]);
                unset($_SESSION["virtualTour"]);
                unset($_SESSION["others"]);
                unset($_SESSION["condition"]);
                unset($_SESSION["bathroomNo"]);
                unset($_SESSION["amenities"]);
                unset($_SESSION["accessibility"]);
                echo ' <script> 
        window.location.href = "userProfile.php";
        </script>
        '; 
                    } else {	
                        //show error
                echo "Error: " . $sql . " " . mysqli_error($conn);
            }
            //close connection
            mysqli_close($conn);

        }
        if($_GET['action']== "editUnit"){
            session_start();
            $cost = $_SESSION["cost"];
            $category = $_SESSION["unitCategory"];
            $location = $_SESSION["location"];
            $condition = $_SESSION["condition"];
            $accessibility = implode('*', $_SESSION["accessibility"]);
            $amenities = implode("*", $_SESSION['amenities']);
            $others = implode('*', $_SESSION["others"]);
            $virtualTour = implode("*", $_SESSION['virtualTour']);
            $size = $_SESSION["size"];
            $userID = $_SESSION['id'];
            $bedroomNo = $_SESSION["bedroomNo"];
            $bathroomNo = $_SESSION["bathroomNo"];
            $id = $_GET['id'];
            //    statement to enter values into the registration table in the database
            $sql = "UPDATE units SET cost = '$cost', size = '$size', bedroomNo = '$bedroomNo',bathroomNo = '$bathroomNo', category = '$category', location = '$location',
                                             virtualTour = '$virtualTour', others = '$others', accessibility = '$accessibility', unitCondition = '$condition',
                                              amenities = '$amenities' where id = '$id' ";

            //  if sql query is executed...
            if (mysqli_query($conn, $sql)) {
                unset($_SESSION["unitCategory"]);
                unset($_SESSION["cost"]) ;
                unset($_SESSION["size"]);
                unset($_SESSION["bedroomNo"]);
                unset($_SESSION["location"]);
                unset($_SESSION["virtualTour"]);
                unset($_SESSION["others"]);
                unset($_SESSION["condition"]);
                unset($_SESSION["bathroomNo"]);
                unset($_SESSION["amenities"]);
                unset($_SESSION["accessibility"]);
                echo ' <script> 
        window.location.href = "userProfile.php";
        </script>
        '; 
                    } else {	
                        //show error
                echo "Error: " . $sql . " " . mysqli_error($conn);
            }
            //close connection
            mysqli_close($conn);

        }
        }
      
        if(isset($_POST['send'])){
            session_start();
            $recipientID = $_POST['recipientID'];
            $to = $_POST['to'];
            $message = $_POST['message'];
            $senderID = $_POST['senderID'];
            $subjectUnit = $_POST['subjectUnit'];
             date_default_timezone_set("Africa/Nairobi");
             $time = date("Y-m-d h:i:sa");
            $sql = "INSERT INTO messages (message,senderID, receipientID, time, subjectUnit)
            VALUES ('$message','$senderID','$recipientID', '$time', '$subjectUnit')";
        
            //if sql query is executed...
            if (mysqli_query($conn, $sql)) {
                echo '<script> window.location.href = "'. $to.'"; </script>';
                   } else {	
                       //show error
               echo "Error: " . $sql . "
        " . mysqli_error($conn);
            }
            //close connection
            mysqli_close($conn);
        }
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
            $chosenEmail = $emails[$nextIndex];
            
            // Retrieve the corresponding ID of the chosen email
            $getID = mysqli_query($conn, "SELECT id FROM registration WHERE emailAddress = '$chosenEmail'");
            if ($getID && mysqli_num_rows($getID) > 0) {
                $row = mysqli_fetch_assoc($getID);
                $recipientID = $row['id'];
            } else {
                // Handle error condition if the ID retrieval fails
                $recipientID = null;
            }
            
            // Store the recipient ID in the session
            $_SESSION['recipientID'] = $recipientID;
            
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
        
        if(isset($_POST['pay'])){
            session_start();
            $id = $_POST['id'];
            $userID = $_POST['userID'];
            $phoneNo = $_POST['phoneNumber'];
            $amount = $_POST['amount'];
            $password = $_POST['password'];
            $credits = $_POST['amount']/ 50;
            $from = $_POST['from'];
            date_default_timezone_set("Africa/Nairobi");
            $time = date("Y-m-d h:i:sa");
            $sqlQ=mysqli_query($conn,"SELECT * FROM registration where id='$userID'");
            $row  = mysqli_fetch_array($sqlQ);
            //if sql query is executed...
            if(is_array($row))
            {
                $setCredits = $row['credits'];
                if($password == $row['password']){
            $sql = "INSERT INTO credits (phoneNumber, amount, credits, time, userID)
            VALUES ('$phoneNo','$amount','$credits', '$time', '$userID')";
        
            //if sql query is executed...
            if (mysqli_query($conn, $sql)) {
                $totalCredits = $setCredits +$credits;
                $_SESSION['credits'] = $totalCredits;
                $sqlz = "UPDATE registration SET credits='$totalCredits' where id = '$userID' ";
                if (mysqli_query($conn, $sqlz)){
                echo '<script> window.location.href ="'. $from .'&id='. $id.'&inV='. $id.'"; </script>';
                }
            }else {	
                //show error
               echo "Error: " . $sql . "
        " . mysqli_error($conn);
            }
            }
        }
            
            //if sql query is executed...
            if (!$sqlQ) {
               echo "Error: " . $sqlQ . "
        " . mysqli_error($conn);
            }
        }

        $time = date_create(date("Y-m-d h:i:sa"));
        $sqlQ=mysqli_query($conn,"SELECT * FROM creditpasses where expired=0");
        $row  = mysqli_fetch_array($sqlQ);
        //if sql query is executed...
        if(is_array($row)){
            
           $priorTime =  date_create($row['time']);
        //    echo $priorTime;
        //    echo $time;
         $diff = date_diff($time, $priorTime);
          $timed =  $diff->format("%i");
          echo $timed;
          echo $row["id"];
          if($timed > 4 ){
            $id = $row["id"];
            $expiryTime = date("Y-m-d h:i:sa");
            $sqlz = "UPDATE creditpasses SET expired = 1, expiryDate='$expiryTime' where id = '$id' ";
            if (!mysqli_query($conn, $sqlz)){
            //show error
            echo "Error: " . $sql . "
            " . mysqli_error($conn);
            }else{
                $userID = $row["userID"];
                $sqlY=mysqli_query($conn,"SELECT * FROM registration where id='$userID'");
                $row  = mysqli_fetch_array($sqlY);
            //if sql query is executed...
            if(is_array($row)){
                $setCredits = $row['credits']- 1;
                $_SESSION['credits'] = $setCredits;
                $sqlx = "UPDATE registration SET credits='$setCredits' where id = '$userID' ";
                if (!mysqli_query($conn, $sqlx)){
                    //show error
                    echo "Error: " . $sql . "
                    " . mysqli_error($conn);     
                           }
            }
        }
          }}

//post a question to the forum
// check that the question is not null
if(isset($_POST['postToForum']))
{	
    
    //store values submitted in the form in a variable
	 $question = $_POST['question_text'];

     //statement to enter values into the registration table in the database
	 $sql = "INSERT INTO forum_questions (question_text)
	 VALUES ('$question')";

     //if sql query is executed...
	 if (mysqli_query($conn, $sql)) {
            echo'
                <script>
                    window.location.href = "forum.php";
                </script>
            ';
		} else {	
                //show error
		echo "Error: " . $sql . " " . mysqli_error($conn);
	 }
        //close connection
        mysqli_close($conn);

    }

    //post a question to the forum
// check that the question is not null
if(isset($_POST['editFQ']))
{	
    
    //store values submitted in the form in a variable
    $answer_id = $_POST['answer_id'];
	 $answer = $_POST['answer_text'];

     $sql = "UPDATE forum_answers SET answer_text='$answer' WHERE answer_id=$answer_id";
     //if sql query is executed...
	 if (mysqli_query($conn, $sql)) {
            echo'
                <script>
                    window.location.href = "userProfile.php";
                </script>
            ';
		} else {	
                // show error
		echo "Error: " . $sql . " " . mysqli_error($conn);
	 }
        //close connection
        mysqli_close($conn);

    }
    if (isset($_POST['answerFQ'])) {
        // Store values submitted in the form in variables
        $answer = $_POST['answer_text'];
        $questionID = $_POST['question_id'];
    
        $sql = "INSERT INTO forum_answers (answer_text, question_id) VALUES (?, ?)";
        $stmt = $conn->prepare($sql);
    
        if ($stmt) {
            // Bind parameters to the statement
            $stmt->bind_param("ss", $answer, $questionID);
    
            // Execute the prepared statement
            if ($stmt->execute()) {
                // Redirect to another page upon successful insertion
                header("Location: userProfile.php");
                exit();
            } else {
                // Show an error message
                echo "Error: " . $stmt->error;
            }
    
            // Close the statement
            $stmt->close();
        } else {
            // Show an error message if the statement preparation fails
            echo "Error: " . $conn->error;
        }
    
        // Close the database connection
        mysqli_close($conn);
    }
    
    if(isset($_POST['cancelFQ']))
    {	
                echo'
                    <script>
                        window.location.href = "userProfile.php";
                    </script>
                ';
    
        }
?>