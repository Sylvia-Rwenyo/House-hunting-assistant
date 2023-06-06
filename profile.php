    <?php 
        include_once 'conn.php';
        session_start();
        $user = $_SESSION["username"];
        if($_SESSION["loggedIN"] == false){
            echo ' <script> 
            window.location.href = "index.php";
            </script>';       
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
        <title>Edit Your profile</title>
    </head>
    <body class="profileBody" id="editProfileSection">
        <div class="header">
            <h1><?php 
            echo ucwords($user);
            ?></h1>
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
            // get user info
            if(isset($_GET)){
                $id=$_GET['id'];
                }else{
                $id = $_SESSION['id'];
                }  
                $records = mysqli_query($conn,"SELECT * FROM  registration where id='$id'");
            if (mysqli_num_rows($records) > 0) {
            $i=0;
            while($result = mysqli_fetch_array($records)) {
        ?>
            <div class="profile" id="completeProfile">
                <div class="intro">
                    <img src="<?php if($result['profilePhoto'] == ''){
                        echo 'Images/user.png';} else{
                            echo 'Uploads/'.$result['profilePhoto'];} 
                           ?>"
                        alt="profile photo"/>
                    <div class="rating">
                    <h4><?php echo $result['name'];?></h4>
                        <div>
                        <i class="fa-solid fa-star"></i>                   
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                        </div>
                    </div>

                </div>
                <div class="contactInfo">
                <p><a href='mailto:<?php echo $result['emailAddress']?>'><i class="fa-solid fa-envelope"></i>&nbsp;&nbsp;&nbsp;<?php echo $result['emailAddress']?></a></p>
                <p><a href='tel:<?php if($result['phoneNumber'] == 0){
                    echo '';} else{ echo $result['phoneNumber'];}?>'>
                    <i class="fa-solid fa-phone"></i>&nbsp;&nbsp;&nbsp;
                    <?php if($result['phoneNumber'] == 0){
                     echo 'Add phone number';} else{ echo $result['phoneNumber'];}
                     $i++;
                     }}?></a></p>
                <p onclick="editProfile()"><i class="fa-solid fa-pencil"></i></p>
            </div>
            </div>
                <?php 
            // get user info
            if(isset($_GET)){
            $id=$_GET['id'];
            }else{
            $id = $_SESSION['id'];
            }
            $records = mysqli_query($conn,"SELECT * FROM  registration where id='$id' ");
            if (mysqli_num_rows($records) > 0) {
            $i=0;
            while($result = mysqli_fetch_array($records)) {
        ?>
            <div class="profile" id="editingProfile">
                <form action="processing.php" method="POST" enctype="multipart/form-data">
                <div class="intro" id="editPhoto">
                <img src="<?php if($result['profilePhoto'] == ''){
                        echo 'Images/user.png';} else{
                            echo 'Uploads/'. $result['profilePhoto'];} ?>"
                        alt="profile photo" id="pfp"/>  
                <input name="profilePhoto"  type="file" id="profilePhoto"/>

                <div class="rating">
                    <input  name="name" value="<?php echo $result['name']?>" />
                    <span><input  name="password" value="<?php echo $result['password']?>" placeholder="password" id="password" type="password"/>
                    <p onclick="pswdDisplay()" id="showPswd" >Show</p></span>
                    <input  name="id" value="<?php echo $result['id']?>" type="hidden" />

                </div>
                </div>
                <div class="contactInfo">
                    <div><i class="fa-solid fa-envelope"></i>&nbsp;&nbsp;&nbsp;
                    <input type="text" name="emailAddress" value="<?php echo $result['emailAddress']?>" /></div>
                    <div><i class="fa-solid fa-phone"></i>&nbsp;&nbsp;&nbsp;
                    <?php 
                    if($result['phoneNumber'] == 0){
                        echo '<input type="text" placeholder="phoneNumber" name="phoneNumber" id="phoneNumber" />';
                    }else{
                        ?>
                    <input type="number" name="phoneNumber" value="<?php echo $result['phoneNumber']; } $i++ ;}} ?>" />
                    </div>
                    <div><input type="submit" class="btn editBtn"  name="editProfile" value="Update" /></a></div>
                </div>
            </form>
            </div>
            <div class="profile logOut">
            <a href="processing.php?action=logOut"><h5 class="intro">Log Out</h5></a>
             </div>
             <div class="profile deleteAccount">
             <h5 class="intro" id="deletePrompt">Delete Account</h5>
                <p class="intro" id="deleteQ">Are you sure that you want to delete your account?</p>
                <div class="intro" id="confirmDelete">
                    <a href="processing.php?action=deleteAccount&id=<?php echo $id; ?>" class="btn delete"><p>Yes</p></a>
                    <a class="btn cancel" onclick="cancelDelete()"><p>Cancel</p></a>
                </div>
             </div>
    </body>
    </html>
    <script>
        var deleteQ = document.getElementById('deleteQ');
        var confirmDelete = document.getElementById('confirmDelete');
        deleteQ.style.display = "none";
        confirmDelete.style.display = "none";

        document.getElementById('deletePrompt').onclick = () =>{
            deleteQ.style.display = "block";
            confirmDelete.style.display = "flex";
        }
        function cancelDelete(){
            deleteQ.style.display = "none";
        confirmDelete.style.display = "none";
        }

    </script>
    <?php
        }
        ?>