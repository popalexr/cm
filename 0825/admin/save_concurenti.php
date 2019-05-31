<?php
include "dbconect.php";
$id=$_COOKIE['id'];
$numeelev=mysqli_real_escape_string($conn, $_POST['numeelev']);
$prenumeelev=mysqli_real_escape_string($conn, $_POST['prenumeelev']);
$cnpelev=mysqli_real_escape_string($conn, $_POST['cnpelev']);
$serieelev=mysqli_real_escape_string($conn, $_POST['serieelev']);
$scoalaelev=mysqli_real_escape_string($conn, $_POST['scoalaelev']);
$clasaelev=mysqli_real_escape_string($conn, $_POST['clasaelev']);
$idelev = 0;

$sql = "SELECT * FROM zona WHERE idadmin='$id'";
					$result = $conn->query($sql);
					if ($result->num_rows == 1) {
					//iau datele scolii
					while($row = $result->fetch_assoc()) {
						$prescurtare=$row['prescurtare'];
					}
					}

$sql = "SELECT * FROM concurenti WHERE clasa = '$clasaelev'";
$result = $conn->query($sql);
if($result->num_rows > 0)
{
	while($row = $result->fetch_assoc()) {
		$idelev++;
	}
} else $idelev++;

if($idelev < 10) $idelevFinal = $prescurtare.'_'.$clasaelev.'_0'.$idelev;
else $idelevFinal = $prescurtare.'_'.$clasaelev.'_'.$idelev;

$sql = "SELECT * FROM concurenti WHERE `id` = '".$idelevFinal."'";
$result = $conn->query($sql);
if($result->num_rows > 0) {
	$idelev++;
	if($idelev < 10) $idelevFinal = $prescurtare.'_'.$clasaelev.'_0'.$idelev;
	else $idelevFinal = $prescurtare.'_'.$clasaelev.'_'.$idelev;
}

$sql = "INSERT INTO concurenti (id, nume, prenume, cnp, seriebuletin, scoala, clasa) VALUES ('$idelevFinal', '$numeelev', '$prenumeelev', '$cnpelev', '$serieelev', '$scoalaelev', '$clasaelev')";

if ($conn->multi_query($sql) === TRUE) {
    echo "<script>alert('Elev adaugat cu succes.');</script>";
	echo '<script>location.href="index.php";</script>';
} else {
    echo "<script>alert('Nu a fost adaugat niciun elev.');</script>";
	echo "Error: " . $sql . "<br>" . $conn->error;
	//echo '<script>location.href="index.php";</script>';
}
$conn->close();

?>