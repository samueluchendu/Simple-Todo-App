<?php
require_once "config.php";

if (isset($_POST['update_todo'])) {
	if (empty($_POST['todo']) || empty($_POST['todo_id'])) {
		$error['todo'] = 'Enter a valid task!';
	} else {
		$todo =  $_POST['todo'];
		$id = $_POST['todo_id'];
		//echo $addTodo;
		$sql = "UPDATE  `todo_task` SET `task`='$todo' WHERE `id`=$id";

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
</head>

<body>
	<div>

		<div>
			<h1 style="text-align:center">Edit Task</h1>
			<?php
			require_once "config.php";

			if (isset($_GET['id']) && !empty($_GET["id"])) {

				$id = $_GET['id'];
				$sql = "SELECT * FROM `todo_task` WHERE id=$id";
				if ($result = mysqli_query($link, $sql)) {
					if (mysqli_num_rows($result) > 0) {


			?>
						<form action=" " method="post" style="text-align:center">
							<?php while ($row = mysqli_fetch_array($result)) { ?>
								<input type="text" name="todo" value="<?php echo $row["task"]; ?>">
								<input type="hidden" name="todo_id" value="<?php echo $row["id"]; ?>">
				<?php }
						}
					}
				} else {
					header("Location: index.php");
				} ?>
				<?php if (!empty($error['todo'])) { ?> <p style="color:red; text-align:center"> <?php echo $error['todo']; ?> </p> <?php } ?>
				<input type="submit" name="update_todo" value="Update todo">
						</form>
		</div>

	</div>

</body>

</html>