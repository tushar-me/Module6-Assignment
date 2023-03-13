<!DOCTYPE html>
<html>
<head>
	<title>User List</title>
	<style>
		table {
			border-collapse: collapse;
			width: 100%;
		}

		th, td {
			text-align: left;
			padding: 8px;
			border-bottom: 1px solid #ddd;
		}

		tr:hover {
			background-color: #f5f5f5;
		}
	</style>
</head>
<body>
	<h1>User List</h1>
	<table>
		<thead>
			<tr>
				<th>Name</th>
				<th>Email</th>
				<th>Profile Picture</th>
			</tr>
		</thead>
		<tbody>
			<?php
			// Read users.csv file and display contents in table
			if (($handle = fopen("users.csv", "r")) !== FALSE) {
				while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
					echo "<tr>";
					echo "<td>".$data[0]."</td>";
					echo "<td>".$data[1]."</td>";
					echo "<td><img src='uploads/".$data[2]."' height='100'></td>";
					echo "</tr>";
				}
				fclose($handle);
			} else {
				echo "Error: Could not open users.csv";
			}
			?>
		</tbody>
	</table>
</body>
</html>
