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
    <title>Credits Top up</title>
</head>
<body class="Listings">
    <div class="header">
        <h1>Top Up</h1>
        <span class="menuBar" id="menuBars" onClick="showMenu()"><i class="fa-solid fa-bars"></i></span>
        <?php
            include_once 'menu.php';
        ?>
    </div>
    </div>
    <div class="listingsChat payArea">
   
    <?php 
            include_once 'conn.php';
            session_start();
            $id = $_GET['id'];
            $userID = $_SESSION['id'];
            // $to = '';
            // $uploaderID = 0;
            // $records = mysqli_query($conn,"SELECT * FROM  units where id =  '$id'");
            // if (mysqli_num_rows($records) > 0) {
            // $i=0;
            // while($result = mysqli_fetch_array($records)) {
            //     $uploaderID = $result['userID'];
        ?>
        <div class="creditMsg">
            <p>Each credit is worth Ksh 50. You can use your credits to communicate directly with us and to view the unit's location. Each credit once in use expires after 24hours.</p>
        </div>
    <div class="paymentArea" id="paymentArea">
        <div id="payPrompt">
        <!-- <div>
            <label>Credit Card</label>
            <input type="radio" name="method" value="card" id="payMethodC"/>
        </div> -->
        <div>
            <label>Mpesa</label>
            <input type="radio" name="method" value="mpesa" id="payMethodM" checked/>
        </div>
    </div>
        <form class="paymentForm" id="creditCard">
            <input type="text" placeholder="full name" name="" />
            <input type="number" placeholder="card number" name=""/>
            <input type="number" placeholder="CVC" name="" />
            <input type="passcode" placeholder='pass code' name="" />
            <div>
                <!-- <input type="text" name='bill' id='bill1' value="Bill of Ksh 100" /> -->
                <button type="submit" id="bill" name="pay">Done</button>
            </div>
        </form>
        <form class="paymentForm" id="mpesa" method="POST" action="processing.php">
            <input type="number" placeholder="phone number" name="phoneNumber"/>
            <input type="number" placeholder="amount" name="amount" id="amount" />
            <div id="credits-pswd">
                <input type="password" id="pswd" placeholder='password' name="password" />
                &nbsp;<p onclick="pswdDisplay()" id="showPswd">Show</p>
            </div>
            <?php if(isset($_GET)){ ?>
            <input type="hidden" name="id" value="<?php echo $_GET['id']?>"/>
            <input type="hidden" name="userID" value="<?php echo $_GET['userID']?>"/>
            <input type="hidden" name="from" value="<?php echo $_GET['from']?>"/>
            <?php
            }
            ?>
            <div>
                  <!-- <input type="text" name='bill' id='bill1' value="Bill of Ksh 100" /> -->
                  <button type="submit" id="bill" name="pay">Done</button>
            </div>
        </form>
        
    </div>
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

// let selectCreditCard = document.getElementById('creditCard');
// let selectMpesa = document.getElementById('mpesa');
// let payMethodC = document.getElementById('payMethodC');
// let payMethodM = document.getElementById('payMethodM');

// if(selectMpesa.style.display == 'block'){
//     payMethodC.checked =  false;
//     payMethodM.checked =  true;
// }
// payMethodC.oninput = () =>{
//     payMethodC.checked =  true;
//     payMethodM.checked =  false;
//     selectCreditCard.style.display = 'block';
//     selectMpesa.style.display = 'none';
// }
// payMethodM.oninput = () =>{
//     payMethodC.checked =  false;
//     payMethodM.checked =  true;
//     selectCreditCard.style.display = 'none';
//     selectMpesa.style.display = 'block';
// }
// let amount = document.getElementById('amount');
// amount.oninput = () =>{
//     console.log(amount.value);
//     let credits = amount.value/50;
//     document.getElementById('bill').innerHTML = "Purchasing " + credits + " credits" ;
//     console.log(document.getElementById('bill').value = "Bill of Ksh" + amount.value);
// }

function pswdDisplay(){
    let showPswd = document.getElementById('showPswd');
    let pswd = document.getElementById("pswd");
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