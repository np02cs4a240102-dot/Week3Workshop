<?php

    $globalVar = "I am global";

    function testScope1() {
        // This will NOT work
        echo $globalVar; 
    }

    function testScope2() {
        // Correct way
        global $globalVar;
        echo $globalVar;
    }

    echo "<b>Without global:</b><br>";
    testScope1();  // Undefined variable

    echo "<br><br><b>With global:</b><br>";
    testScope2();  // Works

?>