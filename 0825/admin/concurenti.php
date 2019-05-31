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
					echo '</p>'; */
					echo '<p><a href="add_concurenti.php">Adauga concurent <img src="images/backgrounds/a.jpg"></a></p>';
					echo '<br />';
					echo '<table>
					<tr>
						<th>ID</th>
						<th>Nume</th>
						<th>Prenume</th>
						<th>CNP</th>
						<th>Serie de buletin</th>
						<th>Scoala de provenienta</th>
						<th>Clasa</th>
						<th>Setari</th>
					</tr>';
					
					$sql = "SELECT * FROM concurenti";
					$result = $conn->query($sql);
					if ($result->num_rows > 0) {
					//iau datele scolii
						while($row = $result->fetch_assoc()) {
							$zona = str_split($row['id'], 2);
							if($zona[0] == $prescurtare)
							{
								if(isset($_GET['edit']) && $row["id"] == $_GET['edit'])
									{
										echo '<form action="?save_concurent='.$row["id"].'" method="post"><tr>
													<td>'.$row["id"].'</td>
													<td><input type="text" name="numeelev" value="'.$row["nume"].'"/></td>
													<td><input type="text" name="prenumeelev" value="'.$row["prenume"].'"/></td>
													<td><input type="text" name="cnpelev" value="'.$row["cnp"].'"/></td>
													<td><input type="text" name="seriebuletinelev" value="'.$row["seriebuletin"].'"/></td>
													<td><input type="text" name="scoalaelev" value="'.$row["scoala"].'"/></td>
													<td><input type="text" name="clasaelev" value="'.$row["clasa"].'"/></td>
													<td><input type="submit"  value="Salveaza datele"/></td>
												</tr></form>';
									}
								else {
									echo '<tr>
										<td>'.$row["id"].'</td>
										<td>'.$row["nume"].'</td>
										<td>'.$row["prenume"].'</td>
										<td>'.$row["cnp"].'</td>
										<td>'.$row["seriebuletin"].'</td>
										<td>'.$row["scoala"].'</td>
										<td>'.$row["clasa"].'</td>
										<td><a href="?edit='.$row["id"].'">Editare</a> <a href="?del='.$row["id"].'">Stergere</a></td>
									</tr>';
								}
							}
						}
					}
						echo '
							<tr>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td><a href="add_concurenti.php">Adauga concurent</a></td>
						';
				}
				else
						echo '<h1>Sectiune administrare</h1>
						<p>
							Pentru administrare trebuie sa fiti autrentificati!
						</p>';
				include "functii.php";

				if(isset($_GET['del']))
				{
					$sql = "SELECT * FROM concurenti WHERE `id` = '".$_GET['del']."'";
					$result = $conn->query($sql);
					if ($result->num_rows == 1) {
						$row = $result->fetch_assoc();
						del_concurent($row['id'], $row['nume'], $row['prenume'], $row['cnp'], $row['seriebuletin'], $row['scoala'], $row['clasa']);
					}
				}
				else
				{
					if(isset($_GET['save_concurent']))
					{
						edit_concurent($_GET['save_concurent'], $_POST['numeelev'], $_POST['prenumeelev'], $_POST['cnpelev'], $_POST['seriebuletinelev'], $_POST['scoalaelev'], $_POST['clasaelev'], $prescurtare);
					}
				}
				?>
			</table>
			</div>
		</div>
		
<div id="footer">
			Copyright &copy; 2019</div>
</body>
</html>
