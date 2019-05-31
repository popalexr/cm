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
							include "dbconect.php";
							$sql = "SELECT * FROM concurenti WHERE id='".$_COOKIE['id']."'";
							$result = $conn->query($sql);
							if ($result->num_rows == 1) echo '<script>location.href="concurenti/index.php";</script>';
							else echo '<script>location.href="admin/index.php";</script>';
						}

					?>
				</div>
				<div id="content">
				
						<h1>Bine ai venit!</h1>
						<p>
							Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
						</p>

				</div>
		</div>
		
<div id="footer">
			Copyright &copy; 2019</div>
</body>
</html>
