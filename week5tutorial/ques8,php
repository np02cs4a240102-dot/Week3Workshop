<?php
    $file = fopen("note.txt", "r");

    $content = fread($file, filesize("note.txt"));
    echo nl2br($content);

    fclose($file);
?>