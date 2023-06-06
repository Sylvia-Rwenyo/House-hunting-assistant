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
    <script src="script.js" async></script>
    <link rel="stylesheet" href="style.css">
    <title>Join House Hunting Site</title>
</head>
<body class="homePage">
<div class="header">
    <h6>HOUSE HUNTING SITE</h6>
</div>
<!-- login form -->
<form action="processing.php" method="post">
    <div class="registerForm" >
        <input type="text" placeholder="enter your email address" name="emailAddress">
        <div class="loginPswd" id="loginPwsd" tabindex="0">
            <input type="password" id="password" placeholder="enter your password" name="password">&nbsp;<p onclick="pswdDisplay()" id="showPswd" >Show</p>
        </div>
        </div>
    <button class="btn lg logIn" type="submit" name="logIn">Log In</button>
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