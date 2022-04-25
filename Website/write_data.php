<?php
include ('connection.php');
$sql_insert = "INSERT INTO data (rfid, laeufer_name, rundenanzahl, letzte_rundenzeit, bestzeit, anfang_runde ) VALUES ('".$_GET["rfid"]."', '".$_GET["laeufer_name"]."', '".$_GET["rundenanzahl"]."', '".$_GET["letzte_rundenzeit"]."', '".$_GET["bestzeit"]."', '".$_GET["anfang_runde"]."')";
if(mysqli_query($con,$sql_insert))
{
echo "Done";
mysqli_close($con);
}
else
{
echo "error is ".mysqli_error($con );
}

//http://localhost/wlan/write_data.php?rfid=1&laeufer_name=Schwimmer1&rundenanzahl=1&letzte_rundenzeit=00:00:00&bestzeit=12:00:00&anfang_runde=00:00:00


?>

