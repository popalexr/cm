<?php

function del_concurent($id, $nume, $prenume, $cnp, $seriebuletin, $scoala, $clasa):void
{
	$servername2 = "localhost";
	$username2 = "root";
	$password2 = "";
	$db2 = "lucru";
	// Create connection
	$conn2 = new mysqli($servername2, $username2, $password2, $db2);
	// Check connection
	if ($conn2->connect_error) {
	    die("Connection failed: " . $conn2->connect_error);
	}

	$sql = "DELETE FROM `concurenti` WHERE ID = '".$id."'";

	if ($conn2->query($sql) === TRUE) {
		header("Location: concurenti.php");
	}
	else {
    echo "Eroare: " . $conn2->error;
	}
	$conn2->close();
}

function edit_concurent($id, $nume, $prenume, $cnp, $seriebuletin, $scoala, $clasa, $prescurtare):void
{
	$servername2 = "localhost";
	$username2 = "root";
	$password2 = "";
	$db2 = "lucru";
	// Create connection
	$conn2 = new mysqli($servername2, $username2, $password2, $db2);
	// Check connection
	if ($conn2->connect_error) {
	    die("Connection failed: " . $conn2->connect_error);
	}

	$idelev = 1;

	$sql = "SELECT * FROM concurenti WHERE clasa = '$clasa'";
	$result = $conn2->query($sql);
	if($result->num_rows > 0)
	{
		while($row = $result->fetch_assoc()) {
			$idelev++;
		}
	}

	if($idelev < 10) $idelevFinal = $prescurtare.'_'.$clasa.'_0'.$idelev;
	else $idelevFinal = $prescurtare.'_'.$clasa.'_'.$idelev;


	$sql = "UPDATE `concurenti` SET `id`='".$idelevFinal."',`nume`='".$nume."',`prenume`='".$prenume."',`cnp`='".$cnp."',`seriebuletin`='".$seriebuletin."',`scoala`='".$scoala."',`clasa`='".$clasa."' WHERE `id` = '".$id."'";
	if ($conn2->query($sql) === TRUE) {
		echo "<script>alert('Elev salvat cu succes.');</script>";
		echo '<script>location.href="concurenti.php";</script>';
	}
	else
	{
		echo "<script>alert('Eroare, elevul nu a putut fi salvat.');</script>";
		echo '<script>location.href="concurenti.php";</script>';
	}
	$conn2->close();
}

function insert_repartizare($judet, $id):void {
	$servername2 = "localhost";
	$username2 = "root";
	$password2 = "";
	$db2 = "lucru";
	// Create connection
	$conn2 = new mysqli($servername2, $username2, $password2, $db2);
	// Check connection
	if ($conn2->connect_error) {
	    die("Connection failed: " . $conn2->connect_error);
	}

	$sql = "INSERT INTO `repartizare` (`idzona`, `idelev`) VALUES ('".$judet."', '".$id."')";
	if ($conn2->query($sql) === TRUE) {
		
	}
	else {
    echo "Eroare: " . $conn2->error;
	}
	$conn2->close();
}

function repartizare_update($id, $sala, $poz):void
{
	$servername2 = "localhost";
	$username2 = "root";
	$password2 = "";
	$db2 = "lucru";
	// Create connection
	$conn2 = new mysqli($servername2, $username2, $password2, $db2);
	$sql = "UPDATE `repartizare` SET `sala`='".$sala."',`pozitie`='".$poz."' WHERE `idelev` = '".$id."'";
	if ($conn2->query($sql) === TRUE) {
		
	}
	else
	{
		echo "Eroare: " . $conn2->error;
	}
	$conn2->close();
}

function repartizare_sali($judet, $nrsali, $statii):void
{
	$servername2 = "localhost";
	$username2 = "root";
	$password2 = "";
	$db2 = "lucru";
	// Create connection
	$conn2 = new mysqli($servername2, $username2, $password2, $db2);
	// Check connection
	if ($conn2->connect_error) {
	    die("Connection failed: " . $conn2->connect_error);
	}
	$sql = "SELECT * FROM `repartizare`";
	$result = $conn2->query($sql);
	if($result->num_rows > 0)
	{
		$elev9 = 0;
		$elevi9 = array();
		$elev12 = 0;
		$elevi12 = array();
		while($row = $result->fetch_assoc()) {
			$clasa = str_split($row['idelev'], 2);
			if($row['idzona'] == $judet) {
				if($clasa[1] == '_9') { //cls 9
					$elevi9[] = $row['idelev'];
					$elev9++;
				}
				else if($clasa[1] == '_1' && $clasa[2] == '2_') { // cls 12
					$elevi12[] = $row['idelev'];
					$elev12++;
				}
			} 
		}
			$sala = 1;
			$poz = 1;
			for($i = 1; $i<=$elev9; $i++) {
				if($i > $statii) {$sala++; $poz = 1; }
				if($sala > $nrsali) break;
				repartizare_update($elevi9[$i-1], $sala, $poz);
				$poz=$poz+2;
			}
			$sala = 1;
			$poz = 2;
			for($i = 1; $i<=$elev12; $i++) {
				if($i > $statii) {$sala++; $poz = 2; }
				if($sala > $nrsali) break;
				repartizare_update($elevi12[$i-1], $sala, $poz);
				$poz=$poz+2;
			}
			$ultimsala = $sala;
	}

	//cls 10 si 11

	$sql = "SELECT * FROM `repartizare`";
	$result = $conn2->query($sql);
	if($result->num_rows > 0)
	{
		$elev10 = 0;
		$elevi10 = array();
		$elev11 = 0;
		$elevi11 = array();
		while($row = $result->fetch_assoc()) {
			$clasa = str_split($row['idelev'], 2);
			if($row['idzona'] == $judet) {
				if($clasa[1] == '_1' && $clasa[2] == '0_') { //cls 10
					$elevi10[] = $row['idelev'];
					$elev10++;
				}
				else if($clasa[1] == '_1' && $clasa[2] == '1_') { // cls 11
					$elevi11[] = $row['idelev'];
					$elev11++;
				}
			} 
		}
			$sala = $ultimsala+1;
			$poz = 1;
			for($i = 1; $i<=$elev10; $i++) {
				if($i > $statii) {$sala++; $poz = 1; }
				if($sala > $nrsali) break;
				repartizare_update($elevi10[$i-1], $sala, $poz);
				$poz=$poz+2;
			}
			$sala = $ultimsala+1;
			$poz = 2;
			for($i = 1; $i<=$elev11; $i++) {
				if($i > $statii) {$sala++; $poz = 2; }
				if($sala > $nrsali) break;
				repartizare_update($elevi11[$i-1], $sala, $poz);
				$poz=$poz+2;
			}
	}

	$conn2->close();

}

function clear_repartizare($judet):void {
	$servername2 = "localhost";
	$username2 = "root";
	$password2 = "";
	$db2 = "lucru";
	// Create connection
	$conn2 = new mysqli($servername2, $username2, $password2, $db2);
	// Check connection
	if ($conn2->connect_error) {
	    die("Connection failed: " . $conn2->connect_error);
	}

	$sql = "DELETE FROM `repartizare` WHERE idzona = '".$judet."'";

	if ($conn2->query($sql) === TRUE) {
		
	}
	else {
    echo "Eroare: " . $conn2->error;
	}
	$conn2->close();
}

function repartizare($judet):void
{
	clear_repartizare($judet);
	$servername2 = "localhost";
	$username2 = "root";
	$password2 = "";
	$db2 = "lucru";
	// Create connection
	$conn2 = new mysqli($servername2, $username2, $password2, $db2);
	// Check connection
	if ($conn2->connect_error) {
	    die("Connection failed: " . $conn2->connect_error);
	}

	$sql = "SELECT * FROM `concurenti`";
	$result = $conn2->query($sql);
	if($result->num_rows > 0)
	{
		while($row = $result->fetch_assoc()) {
			$judetelev = str_split($row['id'], 2);
			if($judetelev[0] == $judet)
			{
				insert_repartizare($judet, $row['id']);
			}
		}
	}
	$conn2->close();
}

function numeelev($id)
{
	$servername2 = "localhost";
	$username2 = "root";
	$password2 = "";
	$db2 = "lucru";
	// Create connection
	$conn2 = new mysqli($servername2, $username2, $password2, $db2);
	// Check connection
	if ($conn2->connect_error) {
	    die("Connection failed: " . $conn2->connect_error);
	}

	$sql = "SELECT * FROM concurenti WHERE id = '".$id."'";

	$result = $conn2->query($sql);
	if($result->num_rows == 1)
	{
		while($row = $result->fetch_assoc()) {
			$nume = $row['prenume'];
			return $nume;
		}
	}
	$conn2->close();
	return null;
}

function prenumeelev($id)
{
	$servername2 = "localhost";
	$username2 = "root";
	$password2 = "";
	$db2 = "lucru";
	// Create connection
	$conn2 = new mysqli($servername2, $username2, $password2, $db2);
	// Check connection
	if ($conn2->connect_error) {
	    die("Connection failed: " . $conn2->connect_error);
	}

	$sql = "SELECT * FROM concurenti WHERE id = '".$id."'";

	$result = $conn2->query($sql);
	if($result->num_rows == 1)
	{
		while($row = $result->fetch_assoc()) {
			$prenume = $row['prenume'];
			return $prenume;
		}
	}
	$conn2->close();
	return null;
}

function scoalaelev($id)
{
	$servername2 = "localhost";
	$username2 = "root";
	$password2 = "";
	$db2 = "lucru";
	// Create connection
	$conn2 = new mysqli($servername2, $username2, $password2, $db2);
	// Check connection
	if ($conn2->connect_error) {
	    die("Connection failed: " . $conn2->connect_error);
	}

	$sql = "SELECT * FROM concurenti WHERE id = '".$id."'";

	$result = $conn2->query($sql);
	if($result->num_rows == 1)
	{
		while($row = $result->fetch_assoc()) {
			$scoala = $row['scoala'];
			return $scoala;
		}
	}
	$conn2->close();
	return null;
}

// cale fisier din tabelul "fisiere"

function fisier1($idelev)
{
	$servername2 = "localhost";
	$username2 = "root";
	$password2 = "";
	$db2 = "lucru";
	// Create connection
	$conn2 = new mysqli($servername2, $username2, $password2, $db2);
	// Check connection
	if ($conn2->connect_error) {
	    die("Connection failed: " . $conn2->connect_error);
	}

	$sql = "SELECT * FROM fisiere WHERE idelev = '".$idelev."'";

	$result = $conn2->query($sql);
	if($result->num_rows == 1)
	{
		while($row = $result->fetch_assoc()) {
			$fisier = $row['fisier1'];
			return $fisier;
		}
	}
	$conn2->close();
	return null;
}

function fisier2($idelev)
{
	$servername2 = "localhost";
	$username2 = "root";
	$password2 = "";
	$db2 = "lucru";
	// Create connection
	$conn2 = new mysqli($servername2, $username2, $password2, $db2);
	// Check connection
	if ($conn2->connect_error) {
	    die("Connection failed: " . $conn2->connect_error);
	}

	$sql = "SELECT * FROM fisiere WHERE idelev = '".$idelev."'";

	$result = $conn2->query($sql);
	if($result->num_rows == 1)
	{
		while($row = $result->fetch_assoc()) {
			$fisier = $row['fisier2'];
			return $fisier;
		}
	}
	$conn2->close();
	return null;
}

function fisier3($idelev)
{
	$servername2 = "localhost";
	$username2 = "root";
	$password2 = "";
	$db2 = "lucru";
	// Create connection
	$conn2 = new mysqli($servername2, $username2, $password2, $db2);
	// Check connection
	if ($conn2->connect_error) {
	    die("Connection failed: " . $conn2->connect_error);
	}

	$sql = "SELECT * FROM fisiere WHERE idelev = '".$idelev."'";

	$result = $conn2->query($sql);
	if($result->num_rows == 1)
	{
		while($row = $result->fetch_assoc()) {
			$fisier = $row['fisier3'];
			return $fisier;
		}
	}
	$conn2->close();
	return null;
}

?>