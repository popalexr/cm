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
								<a href="comisie.php">Comisie</a><br />
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

					$sql = "SELECT * FROM admini WHERE id='$id'";
					$result = $conn->query($sql);
					if ($result->num_rows == 1) {
					//iau datele scolii
					while($row = $result->fetch_assoc()) {
						if(isset($row['email']) && strlen($row['email']) > 0) $email = $row['email'];
						else $email = '<span style="color: #e0240b">Nesetat</span>';
					}
					}
					echo '<h1>'.$prescurtare.', '.$denumire.'</h1>';
					/*echo '<p><a href="modi_scoala.php" title="Modifici datele?">';
					echo $scoala; echo '</a>';
					echo '</p>';
					echo '<p>';
					echo $adresa;
					echo '</p>';
					echo '<p>';
					echo $ipscoala;
					echo '</p>';*/

					echo '<p>Denumirea scolii: <span style="color: #0061ff">'.$scoala.'</span> <a href="modi_scoala.php">✎ Editeaza detaliile</a></p>';
					echo '<p>Adresa scolii: <span style="color: #0061ff">'.$adresa.'</p>';
					echo '<p>IP-ul principal al scolii: <span style="color: #0061ff">'.$ipscoala.'</p>';
					echo '<p>Numar total de laboratoare: <span style="color: #0061ff">'.$sali.'</p>';
					echo '<p>Numar statii per laborator: <span style="color: #0061ff">'.$locuri.'</p>';
					echo '<p>E-mail: <span style="color: #0061ff">'.$email.'</p>';
					
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
