<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
    <style>

      *{
    box-sizing: border-box;
    -webkit-box-sizing: border-box;
    -moz-box-sizing: border-box;
}
body{
    font-family: Helvetica;
    -webkit-font-smoothing: antialiased;
    background: rgba( 71, 147, 227, 1);
}
h2{
    text-align: center;
    font-size: 18px;
    text-transform: uppercase;
    letter-spacing: 1px;
    color: white;
    padding: 30px 0;
}

/* Table Styles */

.table-wrapper{
    margin: 10px 70px 70px;
    box-shadow: 0px 35px 50px rgba( 0, 0, 0, 0.2 );
}

.fl-table {
    border-radius: 5px;
    font-size: 12px;
    font-weight: normal;
    border: none;
    border-collapse: collapse;
    width: 100%;
    max-width: 100%;
    white-space: nowrap;
    background-color: white;
}

.fl-table td, .fl-table th {
    text-align: center;
    padding: 8px;
}

.fl-table td {
    border-right: 1px solid #f8f8f8;
    font-size: 12px;
}

.fl-table thead th {
    color: #ffffff;
    background: #4FC3A1;
}


.fl-table thead th:nth-child(odd) {
    color: #ffffff;
    background: #324960;
}

.fl-table tr:nth-child(even) {
    background: #F8F8F8;
}

/* Responsive */

@media (max-width: 767px) {
    .fl-table {
        display: block;
        width: 100%;
    }
    .table-wrapper:before{
        content: "Scroll horizontally >";
        display: block;
        text-align: right;
        font-size: 11px;
        color: white;
        padding: 0 0 10px;
    }
    .fl-table thead, .fl-table tbody, .fl-table thead th {
        display: block;
    }
    .fl-table thead th:last-child{
        border-bottom: none;
    }
    .fl-table thead {
        float: left;
    }
    .fl-table tbody {
        width: auto;
        position: relative;
        overflow-x: auto;
    }
    .fl-table td, .fl-table th {
        padding: 20px .625em .625em .625em;
        height: 60px;
        vertical-align: middle;
        box-sizing: border-box;
        overflow-x: hidden;
        overflow-y: auto;
        width: 120px;
        font-size: 13px;
        text-overflow: ellipsis;
    }
    .fl-table thead th {
        text-align: left;
        border-bottom: 1px solid #f7f7f9;
    }
    .fl-table tbody tr {
        display: table-cell;
    }
    .fl-table tbody tr:nth-child(odd) {
        background: none;
    }
    .fl-table tr:nth-child(even) {
        background: transparent;
    }
    .fl-table tr td:nth-child(odd) {
        background: #F8F8F8;
        border-right: 1px solid #E6E4E4;
    }
    .fl-table tr td:nth-child(even) {
        border-right: 1px solid #E6E4E4;
    }
    .fl-table tbody td {
        display: block;
        text-align: center;
    }
}

.hidden_rfid{
    visibility: hidden;
}
    
    </style>
  </head>
  <body>

    <?php
include ('connection.php');
/* Attempt MySQL server connection. Assuming you are running MySQL
server with default setting (user 'root' with no password) */
 


 
// Attempt select query execution
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
  }
  
  $sql = "SELECT rfid, laeufer_name, rundenanzahl,letzte_rundenzeit, bestzeit, anfang_runde FROM data";
  $result = $con->query($sql);
  
  echo '<h2>Schwimmzeiten!</h2>
  <div class="table-wrapper">
  <table class="fl-table">
    <thead>
    <tr>
      <th>Läufer Name</th>
      <th>Rundenanzahl</th>
      <th>Letzte Rundenzeit</th>
      <th>Bestzeit</th>
      
    </tr>
</thead>
<tbody>';



  if ($result->num_rows > 0) {
    // output data of each row
  
 
    while($row = $result->fetch_assoc()) {
      echo "<tr>";
      //echo "<td>".$row["rfid"]."</td>";
      echo "<td id='test'>".$row["laeufer_name"]."</td>";
      echo "<td>".$row["rundenanzahl"]."</td>";
      echo "<td>".$row["letzte_rundenzeit"]."</td>";
      echo "<td>".$row["bestzeit"]."</td>";
      //echo "<td>".$row["anfang_runde"]."</td>";
      echo "</tr>";
      echo "<p class='hidden_rfid'>13134</p>";
    }
    while($row = $result->fetch_assoc()) {
      echo "id: " . $row["rfid"]. " - laeufer_name: " . $row["laeufer_name"]. " -rundenanzahl: " . $row["rundenanzahl"]. " -letzte_rundenzeit: " . $row["letzte_rundenzeit"]." -bestzeit: " . $row["bestzeit"]. " -anfang_runde: " . $row["anfang_runde"]. "<br>";
    }
  } else {
    echo "0 results";
  }

//localhost/wlan/get_data.php
mysqli_close($con);
?>

</table>
</div>

  </body>
</html>

