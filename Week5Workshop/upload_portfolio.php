<?php
require "header.php";

$error = "";
$success = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    try {
        // Check if file was uploaded
        if (!isset($_FILES["portfolio"]) || $_FILES["portfolio"]["error"] !== 0) {
            throw new Exception("No file uploaded or upload error.");
        }

        $file = $_FILES["portfolio"];

        // Allowed file types
        $allowedTypes = ["pdf", "jpg", "jpeg", "png"];

        // Get file info
        $fileName = $file["name"];
        $fileSize = $file["size"];
        $fileTmp  = $file["tmp_name"];

        // Get file extension
        $fileExt = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

        // Validate file type
        if (!in_array($fileExt, $allowedTypes)) {
            throw new Exception("Invalid file type. Only PDF, JPG, and PNG are allowed.");
        }

        // Validate file size (2MB max)
        if ($fileSize > 2 * 1024 * 1024) {
            throw new Exception("File size exceeds 2MB limit.");
        }

        // Check uploads directory
        $uploadDir = "uploads/";
        if (!is_dir($uploadDir)) {
            throw new Exception("Upload directory does not exist.");
        }

        // Rename file using string functions
        $newFileName = "portfolio_" . time() . "_" . strtolower(str_replace(" ", "_", $fileName));
        $targetPath = $uploadDir . $newFileName;

        // Move uploaded file
        if (!move_uploaded_file($fileTmp, $targetPath)) {
            throw new Exception("Failed to move uploaded file.");
        }

        $success = "Portfolio uploaded successfully!";

    } catch (Exception $e) {
        $error = $e->getMessage();
    }
}
?>

<main>
    <h2>Upload Portfolio File</h2>

    <?php if ($error): ?>
        <p style="color:red;"><?php echo $error; ?></p>
    <?php endif; ?>

    <?php if ($success): ?>
        <p style="color:green;"><?php echo $success; ?></p>
    <?php endif; ?>

    <form method="post" enctype="multipart/form-data">
        <label>Select Portfolio File (PDF, JPG, PNG | Max 2MB):</label><br><br>
        <input type="file" name="portfolio" required><br><br>

        <button type="submit">Upload File</button>
    </form>
</main>

<?php
include "footer.php";
?>
