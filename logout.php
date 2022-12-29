<?php
  $expire = time() - 3600;
  setcookie("username", "", $expire);
  header("Location: index.php");
?>