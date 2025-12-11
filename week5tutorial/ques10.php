<?php
    $file = fopen("note.txt", "a");
    fwrite($file, "Appended via PHP tutorial.\n");
    fclose($file);

    $file = fopen("note.txt", "r");
    echo nl2br(fread($file, filesize("note.txt")));
    fclose($file);
?>