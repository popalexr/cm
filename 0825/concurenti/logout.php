<?php
setcookie('u', $u, time() -(3600 * 30), "/");
header("Location: ../index.php");
?>