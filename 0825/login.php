<?php
include "dbconect.php";
$u="u";$p="p";
$u=mysqli_real_escape_string($conn, $_POST['user']);
$p=mysqli_real_escape_string($conn, md5($_POST['pass']));
$prenume="test";
$sql = "SELECT * FROM admini WHERE user='$u' AND pass='$p'";
$result = $conn->query($sql);
if ($result->num_rows == 1) {
	//iau datele omului
	while($row = $result->fetch_assoc()) {
        $id=$row['id'];
		$prenume=$row['prenume'];
		//echo $prenume;
	}
	
	//creez cookie
	setcookie('u', md5($u), time() + (3600 * 30), "/");
	setcookie('id', $id, time() + (3600 * 30), "/");
	setcookie('prenume', $prenume, time() + (3600 * 30), "/");
	echo "<script>alert('Salut, ".$prenume."!');</script>";
	echo '<script>location.href="admin/index.php";</script>';
}
 else {
 	$sql = "SELECT * FROM concurenti WHERE id='$u'";
	$result = $conn->query($sql);
	if ($result->num_rows == 1) {
		//iau datele omului
		while($row = $result->fetch_assoc()) {
	        $id=$row['id'];
			$prenume=$row['prenume'];
			//echo $prenume;
		}
	 	setcookie('u', md5($u), time() + (3600 * 30), "/");
		setcookie('id', $id, time() + (3600 * 30), "/");
		setcookie('prenume', $prenume, time() + (3600 * 30), "/");
		echo "<script>alert('Salut, ".$prenume."!');</script>";
		echo '<script>location.href="concurenti/index.php";</script>';}
    //echo "0 results";
	else {
		setcookie('u', "", -36000, "/");
		echo "<script>alert('Ceva nu merge bine ;(');</script>";
		echo '<script>location.href="index.php";</script>';
	}
}

$conn->close();

?>