<?php
include "db.php";

$id = $_GET['id'];
mysqli_query($conn, "DELETE FROM books WHERE book_id = $id");

header("Location: index.php");
?>
