<?php
include ('connection.php');
/* Attempt MySQL server connection. Assuming you are running MySQL
server with default setting (user 'root' with no password) */
 


 
// Attempt select query execution
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
  }
  
  //$sql = "SELECT '".$_GET["column"]."' FROM data WHERE rfid = '".$_GET["id"]."';
  //$sql = "SELECT bestzeit FROM data WHERE rfid = 3";
  
  
  //'".$_GET["rfid"]."'"
  $sql1 = "UPDATE DATA
  SET rundenanzahl = rundenanzahl+1, letzte_rundenzeit = TIMEDIFF(CURTIME(), anfang_runde ), anfang_runde = CURTIME()
  WHERE rfid = '".$_GET["rfid"]."'
  AND anfang_runde != '00:00:00'";

  $sql2 = "UPDATE DATA
  SET rundenanzahl = rundenanzahl+1,anfang_runde = CURTIME()
  WHERE rfid = '".$_GET["rfid"]."' 
  AND anfang_runde = '00:00:00'";

  $sql3 = "UPDATE DATA
  SET bestzeit = letzte_rundenzeit
  WHERE rfid = '".$_GET["rfid"]."' 
  AND letzte_rundenzeit < bestzeit";

  $sql4 = "INSERT INTO rundenzeiten(rfid,rundenzeit,runde)
  SELECT rfid, letzte_rundenzeit,rundenanzahl-1
  FROM DATA
  WHERE rfid = '".$_GET["rfid"]."' 
  AND rundenanzahl >1;";
  

  if(mysqli_query($con,$sql1) && mysqli_query($con,$sql2) && mysqli_query($con,$sql3) && mysqli_query($con,$sql4)){
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