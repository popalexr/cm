<?php
	include "functii.php";
	include "dbconect.php";

	$idadmin=$_COOKIE['id'];
	$sql = "SELECT * FROM admini WHERE id='".$idadmin."'";
	$result = $conn->query($sql);
	if($result->num_rows > 0) {
		while($row = $result->fetch_assoc())
		{
			$zona = $row['zona'];
		}
	}


	$user = mysqli_real_escape_string($conn, $_POST['user']);
	$nume = mysqli_real_escape_string($conn, $_POST['nume']);
	$prenume = mysqli_real_escape_string($conn, $_POST['prenume']);
	$email = mysqli_real_escape_string($conn, $_POST['email']);
	$ip = mysqli_real_escape_string($conn, $_POST['ip']);
	$parola = mysqli_real_escape_string($conn, $_POST['parola']);
	$id = 1;
	$sql = "SELECT * FROM admini";
	$result = $conn->query($sql);
	if($result->num_rows > 0) {
		while($row = $result->fetch_assoc())
		{
			$id++;
		}
	}

	$sql = "INSERT INTO admini (`id`, `user`, `pass`, `ip`, `nume`, `prenume`, `email`, `zona` ) VALUES ('".$id."', '$user', '$parola', '$ip', '$nume', '$prenume', '$email', '".$zona."')";

	if ($conn->query($sql) === TRUE) {
    echo "<script>alert('Adaugat cu succces');</script>";
	echo '<script>location.href="index.php";</script>';
	} else {
	    echo "<script>alert('Nu am modificat datele');</script>";
		echo '<script>location.href="index.php";</script>';
	}
?>