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
							echo "<script>alert('Nu sunteti logat.');</script>";
							echo '<script>location.href="../index.php";</script>';
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
					echo '<h1>'.$prescurtare.', '.$denumire.'</h1>';

					$elevi = 1;
					$sql = "SELECT * FROM fisiere";
					$result = $conn->query($sql);
					if ($result->num_rows == 1)
					{
						echo '<table id="conrent">';
						echo '
							<tr>
								<th>Nr. crt.</th>
								<th>Nume si prenume</th>
								<th>ID elev</th>
								<th>Fisier1</th>
								<th>Fisier2</th>
								<th>Fisier3</th>
							</tr>
						';
						while($row = $result->fetch_assoc()) {
							$zona = str_split($row['idelev'], 2);
							if($zona == $prescurtare)
							{
							$nume = numeelev($row['idelev']);
							$prenume = prenumeelev($row['idelev']);
							echo '<tr>
									<td>'.$elevi.'</td>
									<td>'.$nume.' '.$prenume.'</td>
									<td>'.$row["idelev"].'</td>
									<td></td>
									<td></td>
									<td></td>
								</tr>
							';
							$elevi++;
							}
						}
						echo '</table>';
					}
					else
					{
						echo '<h3>Eroare:</h3>
							<p>Niciun elev nu a publicat fisiere din judetul dumneavoastra.</p>
						';
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
