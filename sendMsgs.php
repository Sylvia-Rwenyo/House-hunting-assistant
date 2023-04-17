<?php
include_once 'conn.php';
$message = $_POST['message'];
$senderID = $_POST['senderID'];
$receipientID = $_POST['receipientID'];
    date_default_timezone_set("Africa/Nairobi");
    $time = date("Y-m-d h:i:sa");
$sql = "INSERT INTO messages (message,senderID, receipientID, time)
VALUES ('$message','$senderID','$receipientID', '$time')";

//if sql query is executed...
if (!mysqli_query($conn, $sql)) {
            //show error
    echo "Error: " . $sql . "
" . mysqli_error($conn);
}
//close connection
mysqli_close($conn);
?>