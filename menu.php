<div class="menu" id="menu">
    <span class="menuBar" id="menuBar" onClick="closeMenu()" style="font-size: 1.25em;  margin-left: 80%;"><i class="fa-solid fa-x"></i></span>
    <ul>
        <?php
        // Function to check if the current page name matches the given link name
        function isActive($linkName)
        {
            $currentPage = basename($_SERVER['PHP_SELF']);
            return ($currentPage === $linkName) ? 'active' : '';
        }
        ?>
        <li><a href="index.php" class="<?php echo isActive('index.php'); ?>">Home</a></li>
        <li><a href="listingChat.php?inV=<?php if(isset($_SESSION['inView'])){echo $_SESSION['inView'];}else{echo 0;};?>" class="<?php echo isActive('listingChat.php'); ?>">Chats</i></a></li>
        <li><a href="posts.php" class="<?php echo isActive('posts.php'); ?>">Posts</i></a></li>
        <li><a href="profile.php" class="<?php echo isActive('profile.php'); ?>">Profile</i></a></li>
        <li><a href="forum.php" class="<?php echo isActive('forum.php'); ?>">Help</a></li>
    </ul>
</div> 

