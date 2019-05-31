<?php
include('functii.php');
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html"; charset=="UTF-8" />
<title>Conquest Management</title>
<link href="main.css" rel="stylesheet" type="text/css" />
</head>

<body>
<div id="title">
		<a href="#"><img src="images/header.jpg" alt="" border="0" title="" /></a><br />
		<h1>Conquest<font color="#0183E5"> Management</font></h1>
		<p>
					???
		</p>
</div>
		
		<div id="container">
				<div id="sidebar">
					<?php
						if(!isset($_COOKIE['u'])) {
							echo '<h1>Autentificare</h1>';
							echo '<p><form action="login.php" method="post">';
							echo 'Utilizator:';
							echo '<input type="text" name="user" />';
							echo 'Parola:';
							echo '<input type="password" name="pass" />';
							echo '<input type="submit" value="LogIn" />';
							echo '</form></p>';
						} else {
							echo '<h1>Administrare</h1>
							<div id="menu">
								<a href="index.php">Pagina index</a><br />
								<a href="concurenti.php">Concurenti</a><br />
								<a href="repartizare.php">Repartizare pe sali</a><br />
								<a href="fisiere_elevi.php">Fisiere elevi</a><br />
				 			 </div>';
							 echo $_COOKIE['prenume'];
							 $id=$_COOKIE['id'];
							 echo '<form action="logout.php" method="post">
								<input type="submit" value="LogOut" /></form>';
						}

					?>
				</div>
				<div id="content">
				<?php
				if(isset($_COOKIE['u'])) 
				{
					include "dbconect.php";
					$sql = "SELECT * FROM zona WHERE idadmin='$id'";
					$result = $conn->query($sql);
					if ($result->num_rows == 1) {
					//iau datele scolii
					while($row = $result->fetch_assoc()) {
						$idzona=$row['idzona'];
						$denumire=$row['denumire'];
						$prescurtare=$row['prescurtare'];
						$scoala=$row['scoala'];
						$adresa=$row['adresa'];
						$ipscoala=$row['ipscoala'];
						$sali = $row['sali'];
						$locuri = $row['locuri'];
					}
					}

					repartizare($prescurtare);
					repartizare_sali($prescurtare, $sali, $locuri);

					$nrlab = 1;
					echo '<h1>'.$prescurtare.', '.$denumire.'</h1>';
					echo '<p>Numar de sali: '.$sali.'</p>';
					echo '<p>Numar de locuri per sala: '.$locuri.'</p>';
					for($i=1; $i<=$sali; $i++) {
						$sql = "SELECT * FROM repartizare WHERE sala='".$i."'";
						$result = $conn->query($sql);
						if ($result->num_rows > 0) {
							echo '<a href="?view_sala='.$i.'">Lista Lab '.$i.'</a><br />';
						}
					}
					if(!isset($_GET['view_sala'])) {
						$sql = "SELECT * FROM `repartizare` WHERE `idzona` = '".$prescurtare."' ORDER BY `idelev` ASC";
						$result = $conn->query($sql);
						if ($result->num_rows > 0) {
						//iau datele scolii
						echo '<table class="repartizare">';
						echo '<tr>
								<th>Nr. crt</th>
								<th>ID Concurent</th>
								<th>Nume si prenume</th>
								<th>Scoala</th>
								<th>Laborator</th>
								<th>Statie</th>
								</tr>
								';
						$elevi = 1;
						while($row = $result->fetch_assoc()) {
							$numeelev = numeelev($row['idelev']);
							$prenumeelev = prenumeelev($row['idelev']);
							$scoalaelev = scoalaelev($row['idelev']);
							echo '<tr>
								<td>'.$elevi.'</td>
								<td>'.$row["idelev"].'</td>
								<td>'.$numeelev.' '.$prenumeelev.'</td>
								<td>'.$scoalaelev.'</td>
								<td>'.$row["sala"].'</td>
								<td>'.$row["pozitie"].'</td>
							</tr>';
							$elevi++;
						}
						}
						echo '</table>';
					}
					else {
						echo '<a href="repartizare.php">Repartizare generala</a><br />';
						$viewsala = $_GET['view_sala'];
						echo '<table class="repartizare">';
						echo '<tr>
								<th>Nr. crt</th>
								<th>ID Concurent</th>
								<th>Nume si prenume</th>
								<th>Scoala</th>
								<th>Laborator</th>
								<th>Statie</th>
								</tr>
						';
						$elevi = 1;
						$sql = "SELECT * FROM `repartizare` WHERE `idzona` = '".$prescurtare."' AND `sala` = '".$viewsala."' ORDER BY `pozitie` ASC";
						$result = $conn->query($sql);
						if ($result->num_rows > 0) {
							while($row = $result->fetch_assoc()) {
								$numeelev = numeelev($row['idelev']);
								$prenumeelev = prenumeelev($row['idelev']);
								$scoalaelev = scoalaelev($row['idelev']);
								echo '<tr>
									<td>'.$elevi.'</td>
									<td>'.$row["idelev"].'</td>
									<td>'.$numeelev.' '.$prenumeelev.'</td>
									<td>'.$scoalaelev.'</td>
									<td>'.$row["sala"].'</td>
									<td>'.$row["pozitie"].'</td>
								</tr>';
								$elevi++;
							}
						}
						echo '</table>';
					}
				}
				else
						echo '<h1>Sectiune administrare</h1>
						<p>
							Pentru administrare trebuie sa fiti autrentificati!
						</p>';
				?>
				</div>
		</div>
		
<div id="footer">
			Copyright &copy; 2019</div>
</body>
</html>
