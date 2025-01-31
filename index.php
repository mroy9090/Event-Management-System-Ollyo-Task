<?php
include('db_conn.php');
session_start();
?>

<!DOCTYPE html>
<html>

<head>
	<title>Event Management System</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-CuOF+2SnTUfTwSZjCXf01h7uYhfOBuxIhGKPbfEJ3+FqH/s6cIFN9bGr1HmAg4fQ" crossorigin="anonymous">
	<link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
	<link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css" />
</head>

<body>
	<div class="container">
		<div class="row">
			<div align="center">
				<h1>Event Management System</h1>

			</div>
		</div>
		<br>
		<br>
		<div class="row">
			<div class="table-responsive">
				<table class="table table-bordered" id="searchresult">
					<thead>
						<tr>
							<th scope="col">No.</th>
							<th scope="col">Event Name</th>
							<th scope="col">Event Date</th>
							<th scope="col">Event Time</th>
							<th scope="col">Event Category</th>
							<th scope="col">Venue</th>
							<th scope="col">Event Descriuption</th>
							<th scope="col">Event Ticket Price</th>
							<th scope="col">Event Ticket Total</th>
							<th scope="col">Join</th>
						</tr>
					</thead>
					<tbody>
						<?php
						if (isset($_POST['ascending'])) {
							$count = 0;

							if ($connect->connect_error) {
								die("Connection failed: " . $conn->connect_error);
							}
							$query = "SELECT * FROM events ORDER BY event_name ";
							if ($result = $connect->query($query)) {
								if ($result->num_rows > 0) {
									while ($row = $result->fetch_assoc()) {
										$count++;
										echo "<tr>";
										echo "<td>{$count}</td>";
										echo "<td>{$row['event_name']}</td>";
										echo "<td>{$row['event_date']}</td>";
										echo "<td>{$row['event_time']}</td>";
										echo "<td>{$row['event_category']}</td>";
										echo "<td>{$row['venue_name']}</td>";
										echo "<td>{$row['event_decription']}</td>";
										echo "<td>{$row['event_ticket_price']}</td>";
										echo "<td>{$row['event_ticket_total']}</td>";
										echo "<td>
												<a href='login.php' class='btn btn-outline-warning' name='edit'>Join</a>
											</td>";
										echo "</tr>";
									}
								}
							}
						} else if (isset($_POST['descending'])) {
							$count = 0;

							if ($connect->connect_error) {
								die("Connection failed: " . $conn->connect_error);
							}
							$query = "SELECT * FROM events ORDER BY event_name ";
							if ($result = $connect->query($query)) {
								if ($result->num_rows > 0) {
									while ($row = $result->fetch_assoc()) {
										$count++;
										echo "<tr>";
										echo "<td>{$count}</td>";
										echo "<td>{$row['event_name']}</td>";
										echo "<td>{$row['event_date']}</td>";
										echo "<td>{$row['event_time']}</td>";
										echo "<td>{$row['event_category']}</td>";
										echo "<td>{$row['venue_name']}</td>";
										echo "<td>{$row['event_decription']}</td>";
										echo "<td>{$row['event_ticket_price']}</td>";
										echo "<td>{$row['event_ticket_total']}</td>";
										echo "<td>
												<a href='login.php' class='btn btn-outline-warning' name='edit'>Join</a>
											</td>";
										echo "</tr>";
									}
								}
							}
						} else {
							$count = 0;

							if ($connect->connect_error) {
								die("Connection failed: " . $conn->connect_error);
							}
							$query = "SELECT * FROM events";
							if ($result = $connect->query($query)) {
								if ($result->num_rows > 0) {
									while ($row = $result->fetch_assoc()) {
										$count++;
										echo "<tr>";
										echo "<td>{$count}</td>";
										echo "<td>{$row['event_name']}</td>";
										echo "<td>{$row['event_date']}</td>";
										echo "<td>{$row['event_time']}</td>";
										echo "<td>{$row['event_category']}</td>";
										echo "<td>{$row['venue_name']}</td>";
										echo "<td>{$row['event_decription']}</td>";
										echo "<td>{$row['event_ticket_price']}</td>";
										echo "<td>{$row['event_ticket_total']}</td>";
										echo "<td>
												<a href='login.php' class='btn btn-outline-warning' name='edit'>Join</a>
											</td>";
										echo "</tr>";
									}
								}
							}
						}
						?>
					</tbody>
				</table>

				

			</div>

		</div>

	</div>
	<script src=" https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js" integrity="sha384-eMNfghbCsoSCaU1Wj+RzTfDxLwpWWFr1EpI5UT4VpyELHT1zUtrPbZjlHggbHbx/" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha3/dist/js/bootstrap.min.js" integrity="sha384-jL6iK0a85dygY8B9OjWV7RfXcCcmfwr7ZfSvA7sXpSws0AC+QLYI6mAZxr7PW5hF" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha3/dist/js/bootstrap.min.js" integrity="sha384-t6I8D5dJmMXjCsRLhSzCltuhNZg6P10kE0m0nAncLUjH6GeYLhRU1zfLoW3QNQDF" crossorigin="anonymous"></script>

</html>