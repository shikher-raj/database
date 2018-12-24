<?php 
	if(isset($_POST['submit'])) {
		require "config.php";
		require 'common.php';
		try {
			$connection = new PDO($dsn, $username, $password, $options);
			$new_user = array(
				"firstname" => $_POST["firstname"],
				"lastname" => $_POST["lastname"],
				"email" => $_POST["email"],
				"age" => $_POST["age"],
				"location" => $_POST["loacation"],
			);
			$sql = sprintf(
				"INSERT INTO %s (%s) values (%s)",
				"users",
				implode(", ", array_keys($new_user)), ":" . implode(", :", array_keys($new_user))
			);
			$statement = $connection->prepare($sql);
			$statement->execute($new_user);
		} catch(PDOException $error) {
			echo $sql . "<br>" . $error->getMessage();
		}
	}
 ?>
<?php include "templates/header.php"; ?>
<?php if(isset($_POST['submit']) && $statement) {?> <blockquote> <?php echo $_POST['firstname']; ?>
	succesfully added.</blockquote>
<?php } ?>
	<h2>Add a User</h2>
	<form method="post">
		<label for="firstname">First name</label>
		<input type="text" name="firstname" id="firstname">
		<label for="lastname">Last name</label>
		<input type="text" name="lastname" id="lastname">
		<label for="email">E-mail Address</label>
		<input type="text" name="email" id="email">
		<label for="age">Age</label>
		<input type="text" name="age" id="age">
		<label for="loacation">Location</label>
		<input type="text" name="loacation" id="location">
		<br>
		<input type="submit" name="submit" value="Submit">
	</form>
	<br><br>
	<a id="home" class="home" href="index.php">Back to Home</a>
<?php include "templates/footer.php"; ?>