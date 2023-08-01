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
    <link rel="stylesheet" href="style.css">
    <title>Join House Hunting Site</title>
</head>
<body class="homePage">
<div class="header">
    <h6>HOUSE HUNTING SITE</h6>
</div>
<form action="processing.php" method="post">
    <div class="registerForm">
        <input type="text" placeholder="enter your name" name="name" required>
        <input type="text" placeholder="enter your email address" name="emailAddress" required>
        <div class="loginPswd">
            <input type="password" id="password" placeholder="enter your password" name="password">&nbsp;<p onclick="pswdDisplay()" id="showPswd" >Show</p>
        </div>
        <div id="passwordChecker">
            <label class="pswd-warning"><i class="fa fa-check"></i> Password should be 8 -20 characters long</label>
            <label class="pswd-warning"><i class="fa fa-check"></i> Password should include an uppercase letter</label>
            <label class="pswd-warning"><i class="fa fa-check"></i> Password should include a number</label>
            <label class="pswd-warning"><i class="fa fa-check"></i> Password should include a symbol</label>
            <label class="pswd-warning"><i class="fa fa-check"></i> Password must not include spaces</label>
        </div>
        <div class="category">
            <div>
                <label>Looking for a house</label><br>
                <input type="radio" name="category" value="looking" required><br>
            </div>
            <div>
                <label>Showing houses</label><br>
                <input type="radio" name="category"value="showing" required><br>
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

 //password checker functionality for registration form
 //declare the variabes storing the element containing the password and the one containing the text indicating the passwords strength
 let password =  document.getElementById('password');
let checker =  document.getElementById('passwordChecker');
let warnings = document.getElementsByClassName('pswd-warning');

//check for upper case letters
let poorRegExp = /[a-z]/;

//check for numbers
let weakRegExp = /(?=.*?[0-9])/;

//check for symbols
let strongRegExp = /(?=.*?[#?!@$%^&*-])/;

//check for spaces
let whitespaceRegExp = /^$|\s+/;

//when password is entered
password.oninput = function(){
    // display div containing warnings
    checker.style.display = 'grid';

    //store value of password in variable
    let passwordValue = password.value;

    if(passwordValue.length < 8 || passwordValue.length > 20){
        warnings[0].style.color = "red";
    }else if(passwordValue.length > 8 || passwordValue.length < 20){
        warnings[0].style.color = "green";
    }

    //check for upper case letters in password
    let upperCaseChecker= passwordValue.match(poorRegExp);

    if(!upperCaseChecker){
        warnings[1].style.color = "green";
    }
    else if(!upperCaseChecker  && !(passwordValue.length > 8 || passwordValue.length < 20)){
        warnings[1].style.color = "red";
    }

    //check for numbers in password
    let numbersChecker= passwordValue.match(weakRegExp);

    if(numbersChecker){
        warnings[2].style.color = "green";
    }else if(!numbersChecker && !(passwordValue.length > 8 || passwordValue.length < 20)){
        warnings[2].style.color = "red";
    }

    //check for symbols in password
    let symbolsChecker= passwordValue.match(strongRegExp);

    if(symbolsChecker){
        warnings[3].style.color = "green";
    }else if(!symbolsChecker  && !(passwordValue.length > 8 || passwordValue.length < 20)){
        warnings[3].style.color = "red";
    }

    //check for spaces in password
    let whitespaceChecker= passwordValue.match(whitespaceRegExp);

    if(whitespaceChecker){
        warnings[4].style.color = "red";
    }else if(!whitespaceChecker && (passwordValue.length > 8 || passwordValue.length < 20)){
        warnings[4].style.color = "green";
    }
}

</script>
</html>