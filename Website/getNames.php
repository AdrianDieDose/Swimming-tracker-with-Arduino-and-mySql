<?php
include ('connection.php');
/* Attempt MySQL server connection. Assuming you are running MySQL
server with default setting (user 'root' with no password) */
$rfids = array();


 
// Attempt select query execution
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
  }
  
  $sql = "SELECT laeufer_name FROM data";
  $result = $con->query($sql);
  




  if ($result->num_rows > 0) {
    // output data of each row
    
    while($row = $result->fetch_assoc()) {
      array_push($rfids, $row["laeufer_name"]);
      }
      
   
  } else {
    $rfids[0] = "0 results";
  }

  header('Content-type: application/json');
  echo json_encode($rfids);

//localhost/wlan/get_data.php
mysqli_close($con);
?>
