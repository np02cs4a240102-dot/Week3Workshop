<?php
    $str = "Full Stack Development with PHP";

    echo "Length: " . strlen($str) . "<br>";
    echo "Word Count: " . str_word_count($str) . "<br>";
    echo "Reverse: " . strrev($str) . "<br>";
    echo "Position of PHP: " . strpos($str, "PHP") . "<br>";
    echo "Replace: " . str_replace("PHP", "JavaScript", $str) . "<br>";
?>