<?php

if($_REQUEST['q']) {

$servername = "";
$username = "";
$password = "";
$db = "Testing";

// Create connection
$conn = new mysqli($servername, $username, $password, $db);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
//echo "Connected successfully";

$query = $_REQUEST['q'];
if(strlen($query) > 10) {
  $sql = "select ProductName, SKU from testing where ProductName like '%".$query."%'";

}
else {
$sql = "select ProductName, SKU from testing where MATCH(ProductName) AGAINST('*".$query."*' IN BOOLEAN MODE) LIMIT 50";
}
$result = $conn->query($sql);
while($row = $result->fetch_row()) {
        $name = $row[0];
        $sku = $row[1];
        $rows[] = $name."-".$sku;
}

echo json_encode($rows);
}
