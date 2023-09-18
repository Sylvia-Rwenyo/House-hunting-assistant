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
    <title>Contact us</title>
</head>
<body class="contacts">
    <div class="header">
        <h6>View Nyumba</h6>
    </div>
                <span class="menuBar" id="menuBars" onClick=showMenu() ><FaBars/></span>
                <?php
                 include_once 'menu.php';
                ?>
            <div class="mainSection">
                <div class="title">
                    <h4>Contact us</h4>
                </div>
                <div class="contactInfo">
                    <div class="links">
                        <div class="admChat">
                            <a href="listingChat.php?with=<?php $_SESSION['id']; ?>&inView=0">
                                <span id="card">
                                    <i class="fa-solid fa-message"></i>
                                </span>
                            </a>
                            <p>
                                We are always on stand by.
                            </p>
                        </div>
                        <div class="buttons">
                            <a href="register.php"><button class="btn lg listHome"> List a Home</button></a>
                            <a href="register.php"><button class="btn lg buyHome">Find a home</button></a>
                        </div>
                    </div>
                </div>
            </div>
</body>
</html>