<form method="POST">
    Name: <input type="text" name="name"><br><br>
    Age: <input type="number" name="age"><br><br>
    Favorite Language: 
    <select name="language">
        <option value="">--Select--</option>
        <option value="PHP">PHP</option>
        <option value="JavaScript">JavaScript</option>
        <option value="Python">Python</option>
    </select><br><br>
    <button type="submit">Preview</button>
</form>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'] ?? '';
    $age = $_POST['age'] ?? '';
    $lang = $_POST['language'] ?? '';

    if (!$name || !$age || !$lang) {
        echo "<p style='color:red;'>Please fill all fields.</p>";
    } else {
        echo "<h3>User Info Preview:</h3>";
        echo "Hello <strong>$name</strong>! You are <strong>$age</strong> years old. Your favorite programming language is <strong>$lang</strong>.";
    }
}
?>
