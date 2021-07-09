<?php
require_once "config.php";

$error=[];
if (isset($_POST["create_todo"])) {
	if (empty($_POST['todo'])) {
		$error['todo'] = 'Enter a valid task!';
	}else{
		$addTodo =  $_POST['todo'];
		//echo $addTodo;
		$sql = "INSERT INTO `todo_task` (`task`)VALUES ('$addTodo')";

		if (mysqli_query($link, $sql)) {
			// echo "New record created successfully";
			header("Location: index.php");
		} else {
			echo "Error: " . $sql . "<br>" . mysqli_error($link);
		}
		
	}
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>

<body>
	<div>
		<div>
			<h1>Todo App</h1>
			<form action=" " method="post">

				<input type="text" name="todo">
				<?php if (!empty($error['todo'])) { ?> <p style="color:red; text-align:center"> <?php echo $error['todo']; ?> </p> <?php } ?>
				<input type="submit" name="create_todo" value="Add todo">
			</form>
		</div>
		<!-- TABLE HERE-->

		<table>
		<?php
		require_once "config.php";

		$sql = "SELECT * FROM `todo_task` ";
		if ($result = mysqli_query($link, $sql)) {
			if (mysqli_num_rows($result) > 0) {
		
		
		?>
			<tr>
				<th>Company</th>
				<th>Contact</th>
				<th>Country</th>
			</tr>
			<?php
                  $i=1;
				while ($row = mysqli_fetch_array($result)) {
			?>
			<tr>
				<td><?php echo $i++ ?></td>
				<td><?php echo $row["task"] ?></td>
				<td>
				<a href="edit.php?id=<?php echo $row["id"] ?>">Edit Task</a>
				<a href="delete.php?id=<?php echo $row["id"] ?>">Delete Task</a>
			</td>
			</tr>
			<?php }?>
			<?php } else{ ?>
			<tr>
				<td><?php echo "No Task found" ?></td>
				
			</tr>
			<?php }}
	        //  mysqli_close($link);
		  ?>
		
		</table>


	</div>
</body>

</html>