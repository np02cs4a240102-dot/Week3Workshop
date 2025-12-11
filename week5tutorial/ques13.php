<?php
    try {
        $a = 10;
        $b = 0;

        if ($b == 0) {
            throw new Exception("Division by zero error!");
        }

        echo $a / $b;

    } catch (Exception $e) {
        echo "Custom Error: " . $e->getMessage();
    }
?>