<?php
    include_once 'conn.php';
    
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $fileCount = count($_FILES['virtualTour']['name']);
        
        for ($i = 0; $i < $fileCount; $i++) {
            // Obtain temp file
            $tmpFilePath = $_FILES['virtualTour']['tmp_name'][$i];
    
            // Make sure a file is present
            if ($tmpFilePath != "") {
                // Generate a unique identifier (unit_id)
                $unit_id = 0;
                $path = 'Preview/';
                if(isset($_POST['editUpload'])){
                    $unit_id = $_POST['editUpload'];
                    $path = 'Uploads/';
                }else{
                    $sql = mysqli_query($conn, "SELECT id FROM units ORDER BY id ASC LIMIT 1");
                    if ($sql && mysqli_num_rows($sql) > 0) {
                        $row = mysqli_fetch_assoc($sql);
                        $unit_id = $row['id'] + 1;
                    }
                }
    
                // Determine the room and position based on the form name
                $room = $_POST['room']; // This corresponds to the room name
                $position = $_POST['position']; // This remains the same
    
                // Generate a new file name based on your criteria
                $newFileName = $room . '_' . $position . '_' . $unit_id . '_' . basename($_FILES['virtualTour']['name'][$i]);
    
                // Replace any double underscores with a single underscore
                $newFileName = str_replace('__', '_', $newFileName);
    
                // Set up the new file path
                $newFilePath = $path . $newFileName;
    
                // Upload the file to the target directory
                move_uploaded_file($tmpFilePath, $newFilePath);
    
                // Store the new file name in the session variable or database as needed
            }
        }
                // Handle redirection as needed
                if(isset($_POST['editUpload'])){
                    echo ' <script> 
                    window.location.href = "addUnit.php?action=editUpload&a=4&id='.$unit_id.'" ;
                    </script>';
                } else {
                    echo ' <script> 
                    window.location.href = "addUnit.php?a=9" ;
                    </script>';
                }
            }

        ?>