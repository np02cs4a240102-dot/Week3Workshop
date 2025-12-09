<?php 
$data = json_decode(file_get_contents("product.json"),true);

foreach ($data as $p) {
    echo "Name: ".$p["name"]." - Price: ".$p["price"]."<br>";
}
?>