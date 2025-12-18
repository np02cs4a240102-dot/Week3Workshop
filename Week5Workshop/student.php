<?php
require "header.php";
?>

<main>
    <h2>Student List</h2>

<?php
$file = "students.txt";

if (!file_exists($file)) {
    echo "<p>No student records found.</p>";
} else {

    $students = file($file, FILE_IGNORE_NEW_LINES);

    if (count($students) == 0) {
        echo "<p>No student records available.</p>";
    } else {

        echo "<ul>";

        foreach ($students as $student) {

            // Split each line into parts
            $parts = explode("|", $student);

            // Extract data
            $name  = trim(str_replace("Name:", "", $parts[0]));
            $email = trim(str_replace("Email:", "", $parts[1]));
            $skillsString = trim(str_replace("Skills:", "", $parts[2]));

            // Convert skills string to array
            $skillsArray = explode("|", $skillsString);

            echo "<li>";
            echo "<strong>Name:</strong> $name <br>";
            echo "<strong>Email:</strong> $email <br>";
            echo "<strong>Skills:</strong>";

            echo "<ul>";
            foreach ($skillsArray as $skill) {
                echo "<li>" . trim($skill) . "</li>";
            }
            echo "</ul>";

            echo "</li><br>";
        }

        echo "</ul>";
    }
}
?>

</main>

<?php
include "footer.php";
?>
