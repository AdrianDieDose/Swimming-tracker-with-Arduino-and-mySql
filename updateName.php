<?php
include ('connection.php');
/* Attempt MySQL server connection. Assuming you are running MySQL
server with default setting (user 'root' with no password) */
 


 
// Attempt select query execution
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
  }
  

  //'".$_GET["rfid"]."'"
  $sql1 = "UPDATE DATA
  SET laeufer_name = '".$_GET["laeufer_name"]."'
  WHERE rfid = '".$_GET["rfid"]."'";
  ;


  if(mysqli_query($con,$sql1) ){
  echo "Done";
  }
  else
  {
  echo "error is ".mysqli_error($con );
  }

 




//localhost/wlan/get_data.php
http://localhost/wlan/update.php?rfid=3

//rundenzahl
//letzte_rundenzeit
//bestzeit
?>
