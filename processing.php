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
        $_SESSION["loggedIN"] = true;
        $loginStatus = $_SESSION["loggedIN"];
        $_SESSION["username"] = $name;
        $_SESSION["email"] = $emailAddress;
        if($_SESSION["loggedIN"]){
            if($category == "looking"){
            //redirect user to their listings page
            header("Location: listing.php"); 
            }else if($category == "showing"){
            //redirect user to their profile page
            header("Location: userProfile.php"); 
            }
        }else{
            //redirect to the home page
            header('location:index.php');
        }
			 } else {	
                //show error
		echo "Error: " . $sql . "
" . mysqli_error($conn);
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
        echo '$profilePhoto';
        header('location:userProfile.php');
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
        $_SESSION["loggedIN"] = true;
        $loginStatus = $_SESSION["loggedIN"];

        if($_SESSION['category'] == 'looking'){
            header("Location: listing.php"); 
        }else if($_SESSION['category'] == 'showing'){
            header("Location: userProfile.php"); 
        }
    }
    else
    {
        echo "Invalid Username /Password";
    }
}
if(isset($_GET['action'])){
    // log out if the user selects "Log Out" on the menu bar
        if($_GET['action']== "logOut"){
            session_start();
            session_unset();
            header("Location: index.php"); 
        }
    }
  
    if(isset($_POST['preview']))
{	 
    session_start();
    $files = array_filter($_FILES['virtualTour']['name']);
    $_SESSION['virtualTour'];
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

    $_SESSION["category"] = $_POST['category'];
	$_SESSION["cost"] = $_POST['cost'];
    $_SESSION["size"] = $_POST['size'];
    $_SESSION["bedroomNo"] = $_POST['bedroomNo'];
    $_SESSION["location"]= $_POST['location'];
     for($i=0; $i < count($_POST['others']); $i++){
    $_SESSION['others'][] = $_POST['others'][$i];
     }
    
     header('location:preview.php');

}
if(isset($_POST['editUpload']))
{	 
    session_start();
    $files = array_filter($_FILES['virtualTour']['name']);
    $_SESSION['virtualTour'];
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

    $_SESSION["category"] = $_POST['category'];
	$_SESSION["cost"] = $_POST['cost'];
    $_SESSION["size"] = $_POST['size'];
    $_SESSION["bedroomNo"] = $_POST['bedroomNo'];
    $_SESSION["location"]= $_POST['location'];
     for($i=0; $i < count($_POST['others']); $i++){
    $_SESSION['others'][] = $_POST['others'][$i];
     }
    
     header('location:preview.php');

}
if(isset($_GET['action'])){
    // log out if the user selects "Log Out" on the menu bar
        if($_GET['action']== "logOut"){
            session_start();
            session_unset();
            header("Location: index.php"); 
        }
    
    //delete an item from the menus table in the database if a restaurant admin user selects the trash icon in their menu 
        if($_GET['action'] == "deleteAccount"){
            $id = $_GET['id'];
            $sql = "DELETE FROM registration WHERE id=$id";
             if (mysqli_query($conn, $sql))
              {     
                session_start();
                session_unset();      
                header('location:index.php');
             } 
        
             else {
                echo "Error: " . $sql . "
        " . mysqli_error($conn);
             }
             mysqli_close($conn);
        }
        if($_GET['action']== "uploadUnit"){
            
            session_start();
            $cost = $_SESSION["cost"];
            $category = $_SESSION["category"];
            $location = $_SESSION["location"];
            $others = implode('*', $_SESSION["others"]);
            $virtualTour = implode("*", $_SESSION['virtualTour']);
            $size = $_SESSION["size"];
            $userID = $_SESSION['userID'];
            $bedroomNo = $_SESSION["bedroomNo"];
            //    statement to enter values into the registration table in the database
            $sql = "INSERT INTO units (cost, size, bedroomNo, category, location, virtualTour, others, userID)
            VALUES ('$cost','$size','$bedroomNo', '$category', '$location', '$virtualTour',  '$others', '$userID')";

            //  if sql query is executed...
            if (mysqli_query($conn, $sql)) {
                unset($_SESSION["category"]);
                unset($_SESSION["cost"]) ;
                unset($_SESSION["size"]);
                unset($_SESSION["bedroomNo"]);
                unset($_SESSION["location"]);
                unset($_SESSION["virtualTour"]);
                unset($_SESSION["others"]);
                header("Location: userProfile.php"); 
                    } else {	
                        //show error
                echo "Error: " . $sql . " " . mysqli_error($conn);
            }
            //close connection
            mysqli_close($conn);

        }
        }

?>