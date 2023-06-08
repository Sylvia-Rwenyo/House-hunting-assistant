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
    <title>Join House Hunting Site</title>
</head>
<body class="homePage">
<div class="header">
    <h6>HOUSE HUNTING SITE</h6>
</div>
<form action="processing.php" method="post">
    <div class="registerForm">
        <input type="text" placeholder="enter your name" name="name">
        <input type="text" placeholder="enter your email address" name="emailAddress">
        <div class="loginPswd">
            <input type="password" id="password" placeholder="enter your password" name="password">&nbsp;<p onclick="pswdDisplay()" id="showPswd" >Show</p>
        </div>
        <div class="category">
            <div>
                <label>Looking for a house</label><br>
                <input type="radio" name="category" value="looking"><br>
            </div>
            <div>
                <label>Showing houses</label><br>
                <input type="radio" name="category"value="showing"><br>
            </div>
        </div>
    </div>
    <a href=""><button class="btn lg logIn" type="submit" name="signUp">Sign Up</button></a>
</form>
<div class="mainCTA2">
<h4>Welcome</h4>
</div>
</body>
<script>
    function pswdDisplay(){
    let showPswd = document.getElementById('showPswd');
    let pswd = document.getElementById("password");
    if(pswd.type == "text"){
        pswd.type = "password";
        showPswd.innerHTML = "Show";
    }else{
        pswd.type = "text";
        showPswd.textContent = "Hide";
        pswd.style.border = "none";
    }
}

</script>
</html>