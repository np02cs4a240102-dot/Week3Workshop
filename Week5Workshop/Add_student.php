<?php
require "header.php";

$error = "";
$success = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    try {
        
        $name   = trim($_POST["name"]);
        $email  = trim($_POST["email"]);
        $skills = trim($_POST["skills"]);

      
        if (empty($name) || empty($email) || empty($skills)) {
            throw new Exception("All fields are required.");
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new Exception("Invalid email format.");
        }

        
        $skillsArray = explode(",", $skills);

     
        $skillsArray = array_map("trim", $skillsArray);

      
        $skillsString = implode(" | ", $skillsArray);

       
        $studentData = "Name: $name | Email: $email | Skills: $skillsString" . PHP_EOL;

      
        $file = fopen("students.txt", "a");

        if (!$file) {
            throw new Exception("Unable to open file.");
        }

        fwrite($file, $studentData);
        fclose($file);

        $success = "Student information saved successfully.";

    } catch (Exception $e) {
        $error = $e->getMessage();
    }
}
?>

<main>
    <h2>Add Student Information</h2>

    <?php if ($error): ?>
        <p style="color:red;"><?php echo $error; ?></p>
    <?php endif; ?>

    <?php if ($success): ?>
        <p style="color:green;"><?php echo $success; ?></p>
    <?php endif; ?>

    <form method="post" action="">
        <label>Name:</label><br>
        <input type="text" name="name"><br><br>

        <label>Email:</label><br>
        <input type="text" name="email"><br><br>

        <label>Skills (comma separated):</label><br>
        <input type="text" name="skills"><br><br>

        <button type="submit">Save Student</button>
    </form>
</main>

<?php
include "footer.php";
?>
