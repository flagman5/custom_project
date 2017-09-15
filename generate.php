<?php
// Create connection
$conn = new mysqli($servername, $username, $password, $db);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
//echo "Connected successfully";


$alphas = range('A', 'Z');
foreach($alphas as $alphabet) {
$sql = "select ProductName, SKU from testing where ProductName like '".$alphabet."%' order by RAND() limit 10";
$result = $conn->query($sql);
while($row = $result->fetch_row()) {
        $name = $row[0];
        $sku = $row[1];
        //$object = new StdClass();
        //$object->name = $name."-".$sku;
        $rows[] = $name."-".$sku;
}
}
echo json_encode($rows);

