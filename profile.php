    <?php 
        include_once 'conn.php';
        session_start();
        $user = $_SESSION["username"];
        if(!isset($_SESSION["loggedIN"])){
            echo ' <script> 
            window.location.href = "index.php?action=logIn";
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
            <h1>Profile</h1>
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
        }else{
            echo '<style>
            .showing{background-color: rgb(98, 150, 67);}
            .viewing{background-color: rgba(98, 150, 67, 0.3);}
            </style>';
        }
        if($_SESSION['category'] == 'showing'){
            $_SESSION['default'] = 1;
        }
        if (($_SESSION['category'] == 'showing' || isset($_SESSION['default'])) && !stristr( $_SESSION['email'], '@admin.com')){

        ?>

        <div class="switchMode">
            <a href="profile.php?mode=showing" class="showing"><button class="btn">Show</button></a>
            <a href="profile.php?mode=viewing" class="viewing"><button class="btn">View</button></a>
        </div>
        <?php
        }
        ?>
            <span class="menuBar" id="menuBars" onClick="showMenu()"><i class="fa-solid fa-bars"></i></span>
            <?php
            include_once 'menu.php';
        ?>
        </div>
        </div> 
        <?php 
            // get user info
                $id = $_SESSION['id'];
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
                    </div>

                </div>
                <div class="contactInfo">
                <p><a href='mailto:<?php echo $result['emailAddress']?>'><i class="fa-solid fa-envelope"></i>&nbsp;&nbsp;&nbsp;<?php echo $result['emailAddress']?></a></p>
                <p><a href='tel:<?php if($result['phoneNumber'] == 0){
                    echo '';} else{ echo $result['phoneNumber'];}?>'>
                    <i class="fa-solid fa-phone"></i>&nbsp;&nbsp;&nbsp;Add your phone number
                    <?php if($result['phoneNumber'] == 0){
                     echo 'Add phone number';} else{ echo $result['phoneNumber'];}
                     $i++;
                     }}?></a></p>
                <p onclick="editProfile()"><i class="fa-solid fa-pencil"></i>&nbsp;&nbsp;&nbsp;Edit</p>
            </div>
            </div>
                <?php 
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
                    <input type="text" name="phoneNumber" placeholder="phoneNumber" value="<?php echo $result['phoneNumber']; } $i++ ;}} ?>" />
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
    const showMenu = () =>{
    document.getElementById('menuBars').style.display = 'none';
    document.getElementById('menu').style.display = 'block';
    }
    const closeMenu = () =>{
        document.getElementById('menuBars').style.display = 'block';
        document.getElementById('menu').style.display = 'none';
    }

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
        function editProfile(){
    document.getElementById('completeProfile').style.display = "none";
    document.getElementById('editingProfile').style.display = "block";
    }
    function pswdDisplay(){
        let showPswd = document.getElementById('showPswd');
        let pswd = document.getElementById("password");
        if(pswd.type == "text"){
            pswd.type = "password";
            // pswd.style.border = '1px solid darkgray';
            showPswd.innerHTML = "Show";
        }else{
            pswd.type = "text";
            showPswd.textContent = "Hide";
            pswd.style.border = "none";
            // pswd.style.border = '1px solid darkgray';
        }
    }
    let profilePhoto = document.getElementById('profilePhoto');
    let pfp = document.getElementById('pfp');
    pfp.onclick = () =>{
        profilePhoto.style.display = "block"
    }
    profilePhoto.oninput = () =>{
        // profilePhoto.style.display = "none"
        console.log(profilePhoto.value);
        let pfpName = profilePhoto.value;
    
        let photo = 'Uploads/' +  pfpName.replace('C:\\fakepath\\', '');
        pfp.src = photo;
    }
    let phoneNo = document.getElementById('phoneNumber');
        phoneNo.onclick = () =>{
        phoneNo.type = "number";
    }

    </script>
    <?php
        }
        ?>