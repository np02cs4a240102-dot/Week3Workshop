<?php
echo"Name: Samrat Jung Basnet<br>";
echo"Today's Date: ". date(format: "Y-m-d ") . "<br>";
$hour = date("G <br>");

if ($hour < 12){
    echo "Good Morning <br>";
} elseif ($hour < 18){
    echo "Good Afternoon <br>";
}else {
    echo"Good Evening <br>";
}


