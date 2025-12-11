<?php
    $userInput = "<script>alert('hack');</script> Welcome";
    $safeInput = htmlspecialchars($userInput);

    echo "Safe String: " . $safeInput . "<br><br>";

    $txt = "  Hello World  ";
    echo "Before trim: '$txt'<br>";
    echo "After trim: '" . trim($txt) . "'";
?>