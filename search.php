<!DOCTYPE html>
<html>
<head>
    <title>Search Results</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<h2>Search Results</h2>

<table>
<tr>
    <th>ID</th>
    <th>Title</th>
    <th>Author</th>
    <th>Category</th>
    <th>Quantity</th>
</tr>

<?php
include "db.php";

$category = $_GET['category'];
$result = mysqli_query($conn, 
    "SELECT * FROM books WHERE category LIKE '%$category%'");

while ($row = mysqli_fetch_assoc($result)) {
    echo "<tr>
            <td>{$row['book_id']}</td>
            <td>{$row['title']}</td>
            <td>{$row['author']}</td>
            <td>{$row['category']}</td>
            <td>{$row['quantity']}</td>
          </tr>";
}
?>
</table>

<a href="index.php">⬅ Back</a>

</body>
</html>
