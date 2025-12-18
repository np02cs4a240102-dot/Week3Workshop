<?php

function formatName($name) {
    return ucwords(strtolower(trim($name)));
}

function validateEmail($email) {
    return filter_var($email, FILTER_VALIDATE_EMAIL);
}

function cleanSkills($string) {
    $skills = explode(",", $string);
    return array_map('trim', $skills);
}

function saveStudent($name, $email, $skillsArray) {
    $file = fopen("students.txt", "a");
    $skills = implode("|", $skillsArray);
    fwrite($file, "$name,$email,$skills\n");
    fclose($file);
}

function uploadPortfolioFile($file) {
    $allowedTypes = ['application/pdf', 'image/jpeg', 'image/png'];
    $maxSize = 2 * 1024 * 1024;

    if ($file['error'] !== 0) {
        throw new Exception("File upload error.");
    }

    if (!in_array($file['type'], $allowedTypes)) {
        throw new Exception("Invalid file type.");
    }

    if ($file['size'] > $maxSize) {
        throw new Exception("File size exceeds 2MB.");
    }

    if (!is_dir("uploads")) {
        throw new Exception("Upload directory not found.");
    }

    $ext = pathinfo($file['name'], PATHINFO_EXTENSION);
    $newName = uniqid("portfolio_") . "." . $ext;

    move_uploaded_file($file['tmp_name'], "uploads/" . $newName);

    return $newName;
}
