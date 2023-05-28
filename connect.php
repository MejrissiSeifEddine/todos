<?php
// Get form input data
$title = $_POST['task'];
$description = $_POST['desc'];
$dead = $_POST['dead'];
// Connect to database
$servername = "localhost";
$username = "root";
$password ="";
$dbname = "todos";

$conn = new mysqli($servername,$username,$password, $dbname);
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Insert data into database
$sql = "INSERT INTO todos (title, description,due_date)
VALUES ('$title', '$description','$dead')";

if ($conn->query($sql) === TRUE) {
  echo "<h1>New record created successfully</h1>";
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}

// Close database connection
$conn->close();
?>
<html>
    <head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    </head>
    <body>
    <button type="button" class="btn btn-primary" onclick="location.href='create.html';">back</button>
    </body>
</html>