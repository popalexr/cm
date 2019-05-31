<?php
setcookie('u', md5($u), time() -(3600 * 30), "/");
header("Location: index.php");
?>