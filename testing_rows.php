<?php

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
echo "Connected successfully";


$data = file('products.json');
$counter = 0;
foreach($data as $row) {
  $check = preg_match('/\"name\":(.*),"type"/', $row, $matches);
  $product_name = trim($matches[1], '"');
  preg_match('/\"sku\":(\d+),\"name\"/', $row, $matches);
  $sku = $matches[1];
  $cleared_name = trim(preg_replace('/ +/', ' ', preg_replace('/[^A-Za-z0-9 ]/', ' ', urldecode(html_entity_decode(strip_tags($product_name))))));
  //$cleared_name = trim(preg_replace('/[^A-Za-z0-9 ]/', ' ', urldecode(html_entity_decode(strip_tags($product_name)))));
  if($counter == 0) {
        $sql = "INSERT INTO testing (ProductName, SKU) VALUES ('".$cleared_name."','".$sku."')";
  }
  else {
        $sql .= ",('".$cleared_name."','".$sku."')";
  }
  $counter++;
  if($counter == 51645 ) {
        if ($conn->query($sql) === TRUE) {
                        //echo $from_array[0]." to ".$to_array[0]." created successfully \n";
                        echo $counter."\r\n";
                } else {
                         echo "Error: " . $sql . "<br>" . $conn->error; echo "\r\n";
                }
        $counter = 0;
  }

}
$conn->close();
