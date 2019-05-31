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
							echo '<h1>Panou Elevi</h1>
							<div id="menu">
								<a href="index.php">Pagina Index</a><br />
				 			 </div>';
							 echo $_COOKIE['prenume'];
							 $id=$_COOKIE['id'];
							 echo '<form action="logout.php" method="post">
								<input type="submit" value="LogOut" /></form>';

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

							$sql = "SELECT * FROM `concurenti` WHERE `id` = '".$_COOKIE['id']."'";
							$result = $conn2->query($sql);
							if ($result->num_rows > 0) {
								while($row = $result->fetch_assoc()) {
									$zona = str_split($row['id'], 2);
									$nume = $row['nume'];
									$prenume = $row['prenume'];
								}
							}
							$conn2->close();
						}
?>
				</div>
				<div id="content">
					<h1><img src="images/id.png"/> <?php echo $_COOKIE['id']; ?></h1>

					<table id="content">
						<tr>
							<th>Nume si prenume</th>
							<th><?php if(isset($nume) && isset($prenume)) echo ''.$nume.' '.$prenume.''; ?></th>
						</tr>
						<tr>
							<td><p>Incarca fisierul 1</p></td>
							<?php
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
							$sql = "SELECT * FROM `fisiere` WHERE `idelev` = '".$_COOKIE['id']."'";
							$result = $conn2->query($sql);
							if ($result->num_rows > 0) {
								while($row = $result->fetch_assoc()) {
									if(isset($row['fisier1'])) $fisier1 = 1;
									else $fisier1 = 0;

									if(isset($row['fisier2'])) $fisier2 = 1;
									else $fisier2 = 0;

									if(isset($row['fisier3'])) $fisier3 = 1;
									else $fisier3 = 0;
								}
							}
							else {
								$fisier1 = 0;
								$fisier2 = 0;
								$fisier3 = 0;
							}
							$conn2->close();
							if($fisier1 == 0) echo '<td style="background-color: #ff9b9b"><form action="upload.php" method="post" enctype="multipart/form-data">
								<input type="file" name="fisier1" id="fisier1">
   								<input type="submit" value="Incarca fisierul" name="submit">
   								</form>
							</td>';
							else echo '<td style="background-color: #ff9b9b"><form action="upload.php" method="post" enctype="multipart/form-data">
								<input type="file" name="fileToUpload" id="fileToUpload">
   								<input type="submit" value="Incarca fisierul" name="submit">
   								</form>
							</td>';
							?>
						</tr>
						<tr>
							<td><p>Incarca fisierul2</p></td>
							<?php
							if($fisier2 == 0) echo '<td style="background-color: #ff9b9b"><form action="upload.php" method="post" enctype="multipart/form-data">
								<input type="file" name="fisier2" id="fisier2">
   								<input type="submit" value="Incarca fisierul" name="submit">
   								</form>
							</td>';
							else echo '<td style="background-color: #ff9b9b"><form action="upload.php" method="post" enctype="multipart/form-data">
								<input type="file" name="fisier3" id="fisier3">
   								<input type="submit" value="Incarca fisierul" name="submit">
   								</form>
							</td>'; ?>

						</tr>
						<tr>
							<td><p>Incarca fisierul3</p></td>
							<?php
							if($fisier3 == 0) echo '<td style="background-color: #ff9b9b"><form action="upload.php" method="post" enctype="multipart/form-data">
								<input type="file" name="fisier3" id="fisier3">
   								<input type="submit" value="Incarca fisierul" name="submit">
   								</form>
							</td>';
							else echo '<td style="background-color: #ff9b9b"><form action="upload.php" method="post" enctype="multipart/form-data">
								<input type="file" name="fisier3" id="fileToUpload">
   								<input type="submit" value="Incarca fisierul" name="submit">
   								</form>
							</td>'; ?>

						</tr>
					</table>
				</div>
		</div>
		
<div id="footer">
			Copyright &copy; 2019</div>
</body>
</html>
