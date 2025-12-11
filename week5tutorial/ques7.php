<?php
    $file = fopen("note.txt", "w");

    fwrite($file, "This is line one.\n");
    fwrite($file, "This is line two.\n");

    fclose($file);
?>