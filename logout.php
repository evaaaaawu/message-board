<?php
  require_once("conn.php");

  // 刪除token
  $token = $_COOKIE['token'];
  $sql = sprintf(
    "DELETE FROM tokens WHERE token = '%s'",
    $token
  );
  $result = $conn->query($sql);
 
  $expire = time() - 3600;
  setcookie("token", "", $expire);
  header("Location: index.php");
?>