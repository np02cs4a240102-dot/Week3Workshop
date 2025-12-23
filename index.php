<!DOCTYPE html>
<html>
<head>
    <title>Library Management System</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<h2>Add New Book</h2>
<form action="add_book.php" method="post">
    <input type="text" name="title" placeholder="Book Title" required>
    <input type="text" name="author" placeholder="Author" required>
    <input type="text" name="category" placeholder="Category" required>
    <input type="number" name="quantity" placeholder="Quantity" required>
    <button type="submit">Add Book</button>
</form>

<h2>Search by Category</h2>
<form action="search.php" method="get">
    <input type="text" name="category" placeholder="Enter Category">
    <button type="submit">Search</button>
</form>

<h2>Book List</h2>
<table>
    <tr>
        <th>ID</th>
        <th>Title</th>
        <th>Author</th>
        <th>Category</th>
        <th>Quantity</th>
        <th>Action</th>
    </tr>

<?php
include "db.php";
$result = mysqli_query($conn, "SELECT * FROM books");

while ($row = mysqli_fetch_assoc($result)) {
    echo "<tr>
            <td>{$row['book_id']}</td>
            <td>{$row['title']}</td>
            <td>{$row['author']}</td>
            <td>{$row['category']}</td>
            <td>{$row['quantity']}</td>
            <td>
                <a href='delete_book.php?id={$row['book_id']}'>Delete</a>
            </td>
          </tr>";
}
?>
</table>

</body>
</html>
