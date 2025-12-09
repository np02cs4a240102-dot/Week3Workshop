<form method="POST">
    Enter a sentence: <input type="text" name="sentence">
    <button>Check Vowels</button>
</form>

<?php
if (isset($_POST['sentence'])) {

    $text = $_POST['sentence'];
    $count = 0;

    
    $textLower = strtolower($text);

    
    for ($i = 0; $i < strlen($textLower); $i++) {
        if (
            $textLower[$i] == 'a' ||
            $textLower[$i] == 'e' ||
            $textLower[$i] == 'i' ||
            $textLower[$i] == 'o' ||
            $textLower[$i] == 'u'
        ) {
            $count++;
        }
    }

    echo "<h3>Number of vowels: $count</h3>";
}
?>
