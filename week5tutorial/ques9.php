<?php
    $file = fopen("note.txt", "r");

    while(!feof($file)) {
        echo fgets($file) . "<br>";
    }

    fclose($file);
?>