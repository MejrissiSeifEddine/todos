<?php
// Connect to database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "todos";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Handle checkbox refresh
if (isset($_POST['refresh'])) {
    foreach ($_POST['completed'] as $key => $value) {
      $id = $key;
      $sql = "UPDATE todos SET completed='1' WHERE id=$id";
      if ($conn->query($sql) === FALSE){
        echo "Error updating task: " . $conn->error;
      }
    }
  }

// Get tasks from database
$sql = "SELECT * FROM todos";
$result = $conn->query($sql);

// Display tasks in table
?>

<!DOCTYPE html>
<html>
<head>
	<title>Show Tasks</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<body>
	<div class="container">
		<h2>Task List</h2>
		<form method="post">
			<table class="table">
				<thead>
						<tr>
							<th>Task</th>
							<th>Description</th>
							<th>Deadline</th>
							<th>Completed</th>
						</tr>
				</thead>
				<tbody>
					<?php while($row = $result->fetch_assoc()) { ?>
					<tr>
						<td><?php echo $row['title']; ?></td>
						<td><?php echo $row['description']; ?></td>
						<td><?php echo $row['due_date']; ?></td>
						<td><input type="checkbox" name="completed[<?php echo $row['id']; ?>]" <?php echo ($row['completed'] == '1') ? 'checked' : ''; ?>></td>
					</tr>
					<?php } ?>
				</tbody>
			</table>
			<button type="submit" class="btn btn-primary" name="refresh">Refresh</button>
		</form>
		<br>
		<button onclick="location.href='home.html';" type="button" href="index.php" class="btn btn-secondary">Back to Home Page</button>
	</div>
</body>
</html>

<?php
// Close database connection
$conn->close();
?>