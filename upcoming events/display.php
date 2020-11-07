<?php


		include_once('connect.php');
		$query = "SELECT * FROM `upcoming events`";
		$result = mysqli_query($conn, $query);
		echo "<br/>Success2";

?>

<!DOCTYPE html>
<html>
<head>
	<title> Display Database</title>
</head>
<body>

	<table align = "center" border = "1px" style = "width:600px; line-height:40px; ">
		
		<tr>
			<th> Date </th>
			<th> Event Location </th>
			<th> Event Price </th>
			<th> Entertainment Type </th>
		</tr>

		<?php


		while($rows = mysqli_fetch_assoc($result)){

			if($rows['EventDate'] >= date("Y"."-"."m"."-"."d")){

			?>

			<tr>
				
				<td> <?php echo $rows['EventDate']; ?> </td>
				<td> <?php echo $rows['EventLocation']; ?> </td>
				<td> <?php echo $rows['EventPrice']; ?>$ </td>
				<td> <?php echo $rows['EntertainmentType']; ?> </td>


			</tr>

	<?php

		}
	}

		?>



	</table>

</body>
</html>