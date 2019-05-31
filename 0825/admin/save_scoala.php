<?php
include "dbconect.php";
$id=$_COOKIE['id'];
$s=mysqli_real_escape_string($conn, $_POST['s']);
$a=mysqli_real_escape_string($conn, $_POST['a']);
$i=mysqli_real_escape_string($conn, $_POST['i']);
$sali=mysqli_real_escape_string($conn, $_POST['sali']);
$locuri=mysqli_real_escape_string($conn, $_POST['locuri']);
$email=mysqli_real_escape_string($conn, $_POST['email']);
$sql = "UPDATE zona SET scoala='$s', adresa='$a', ipscoala='$i', sali='$sali', locuri='$locuri' WHERE idadmin='$id'";

if ($conn->query($sql) === TRUE) {

} else {
    echo "<script>alert('Nu am modificat datele');</script>";
	echo '<script>location.href="index.php";</script>';
}

$sql = "UPDATE admini SET email='$email' WHERE id='$id'";

if ($conn->query($sql) === TRUE) {
    echo "<script>alert('Modificare cu succces');</script>";
	echo '<script>location.href="index.php";</script>';
} else {
    echo "<script>alert('Nu am modificat datele');</script>";
	echo '<script>location.href="index.php";</script>';
}
$conn->close();

?>