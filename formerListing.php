<div class="list" id="list">
    <?php 
            
            $userID = 0;
            // $records;
            // if(empty($_GET)){
           $records = mysqli_query($conn,"SELECT * FROM  units");
            // }else if($_GET['filter'] == true && $_GET['filter'] !== ""){
            //     $records = mysqli_query($conn,"SELECT * FROM  units where '$filter' == '$val'");
                if (mysqli_num_rows($records) > 0) {
            $i=0;
            while($result = mysqli_fetch_array($records)) {
                $userID = $result['userID'];
        ?>
        <div class="card" id="card<?php echo $result['id']?>">
        <?php
        $tour = explode('*', $result['virtualTour']);
        ?>
        <div class="tourCard firstSlide" id="firstSlide<?php echo $result['id']?>">
            <img src="Uploads/<?php echo $tour[0]?>" class="previewImg " alt="living room"/>
            <?php if(count($tour) > 1){?>
            <a class="prev" onclick ="showImgs(<?php echo $result['id']?>)" >&#10094;</a>
            <a class="next" onclick ="showImgs(<?php echo $result['id']?>)" >&#10095;</a>   
            <?php } ?>  
        </div>
        <div class="tourCard secondSlide" id="secondSlide<?php echo $result['id']?>">
        <?php
        // if(isset($_GET['action'])){if ($_GET['action'] == 'showSlides'){
        for($j=0; $j < count($tour); $j++){
            ?>
            <img src="Uploads/<?php echo $tour[$j]?>" class="previewImg  slide fade" id="slide<?php echo $j?>" alt="living room"/>
            <?php
        // }
    // }
}
        ?>
         <a class="prev" onclick ="plusSlides(-1)" >&#10094;</a>
            <a class="next" onclick ="plusSlides(1)" >&#10095;</a>     
</div>
               
        <div class="details">
                <div>
                    <h5><?php echo $result['bedroomNo']?> bedroom house</h5>
                    <a href="listingChat.php?with=<?php echo $userID; $_SESSION['inView'] = $result['id']; ?>&inView=<?php echo  $_SESSION['inView']?>"><span id="card<?php echo $result['id']?>"><i class="fa-solid fa-message"></i></span>
                    </a>
                    <!-- <span id='pay' onClick="pay()">Pay</span> -->
                </div>
                <div>
                    <p class="first">For <?php if($result["category"] == "forSale"){echo 'sale at Ksh';}
                                    else if($result["category"] == "rental"){echo 'rent at Ksh';} echo $result['cost'];?></p>
                    <p>At <?php echo $result['location']?></p>
                    <p><?php echo $result['size']?> sqft</p>
                </div>
                <div>
                <?php
                $others =explode('*', $result['others']);
                    for($j=0; $j <count($others); $j++){
                ?> 
                <p><?php echo $others[$j];?></p>
                <?php
                };
                ?>
                </div>
        </div>
        </div>
        <?php
        $i++;}}
    // }
        ?>
    </div>