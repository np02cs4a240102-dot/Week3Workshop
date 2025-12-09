<?php
$name = $_POST['name'] ?? '';
$email = $_POST['email'] ?? '';
$password = $_POST['password'] ?? '';
$confirm_password = $_POST['confirm_password'] ?? '';

$errors = [];

// 1. Validation
if (empty($name)) {
    $errors[] = "Name is required.";
}

if (empty($email)) {
    $errors[] = "Email is required.";
} elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors[] = "Invalid email format.";
}

if (empty($password)) {
    $errors[] = "Password is required.";
} elseif (strlen($password) < 6) {
    $errors[] = "Password must be at least 6 characters.";
} 


if ($password !== $confirm_password) {
    $errors[] = "Passwords do not match.";
}

// Show errors and exit if any
if (!empty($errors)) {
    echo "<div style='color:red;'><h3>Errors:</h3><ul>";
    foreach ($errors as $error) {
        echo "<li>$error</li>";
    }
    echo "</ul></div>";
    echo "<a href='registration.php'>Go Back</a>";
    exit();
}

// 2. Read existing users from user.json
$jsonFile = 'user.json';

if (!file_exists($jsonFile)) {
    file_put_contents($jsonFile, json_encode([]));
}

$jsonData = file_get_contents($jsonFile);
if ($jsonData === false) {
    echo "<div style='color:red;'>Error reading user.json file.</div>";
    exit();
}

$users = json_decode($jsonData, true);
if (!is_array($users)) {
    $users = [];
}

// 3. Check for duplicate email
foreach ($users as $user) {
    if ($user['email'] === $email) {
        echo "<div style='color:red;'>This email is already registered.</div>";
        echo "<a href='registration.php'>Go Back</a>";
        exit();
    }
}

// 4. Hash password
$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

// 5. Add new user
$newUser = [
    'name' => $name,
    'email' => $email,
    'password' => $hashedPassword
];

$users[] = $newUser;

// 6. Save updated array back to user.json
if (file_put_contents($jsonFile, json_encode($users, JSON_PRETTY_PRINT)) === false) {
    echo "<div style='color:red;'>Error writing to user.json file.</div>";
    exit();
}

// 7. Success message
echo "<div style='color:green;'><h2>Registration Successful!</h2>";
echo "<p>Welcome, $name</p></div>";
?>
