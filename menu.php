<div class="menu" id="menu">
    <span class="menuBar" id="menuBar" onClick="closeMenu()"><i class="fa-solid fa-x"></i></span>
    <ul>
        <?php
        // Function to check if the current page name matches the given link name
        function isActive($linkName)
        {
            $currentPage = basename($_SERVER['PHP_SELF']);
            return ($currentPage === $linkName) ? 'active' : '';
        }
        ?>
        <li><a href="listing.php" class="<?php echo isActive('listing.php'); ?>">Active Listings</a></li>
        <li><a href="userProfile.php" class="<?php echo isActive('userProfile.php'); ?>">Profile</i></a></li>
        <li><a href="forum.php" class="<?php echo isActive('forum.php'); ?>">Help</a></li>
    </ul>
</div> 

