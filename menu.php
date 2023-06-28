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
        <a href="listing.php" class="<?php echo isActive('listing.php'); ?>"><li>Active Listings</li></a>
        <a href="userProfile.php" class="<?php echo isActive('userProfile.php'); ?>"><li>Profile</i></li></a>
        <a href="" class="<?php echo isActive(''); ?>"><li>Help</li></a>
    </ul>
</div> 

