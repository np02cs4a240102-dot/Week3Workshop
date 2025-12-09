<form method="POST">
    Enter a number: <input type="number" name="number">
    <button>Enter</button>
</form>

<?php
if (isset($_POST['number'])) {

    $num = $_POST['number'];

    echo "<h3>Multiplication Table for $num</h3>";

    // Generate table from 1 to 10
    for ($i = 1; $i <= 10; $i++) {
        echo "$num x $i = " . ($num * $i) . "<br>";
    }
}
?>
