<?php
    $fruits = "apple,banana,grape,orange";
    $array = explode(",", $fruits);

    foreach ($array as $fruit) {
        echo $fruit . "<br>";
    }

    echo "<br>Imploded: " . implode(" | ", $array);
?>