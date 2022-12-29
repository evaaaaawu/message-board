<?php
  require_once('conn.php');
  require_once("utils.php");

  if (
    empty($_POST['username']) || 
    empty($_POST['password'])
  ) {
    header('Location: login.php?errCode=1');
    die('資料不齊全');
  }

  $username = $_POST['username'];
  $password = $_POST['password'];

  $sql = sprintf (
    "SELECT * FROM users WHERE username='%s' and password='%s'",
    $username,
    $password
  );

  $result = $conn->query($sql);
  if (!$result) {
    die($conn->error);
  }

  if ($result->num_rows) {
    // 建立 token 並儲存
    $token = generateToken();
    $sql = sprintf(
      "INSERT INTO tokens(token, username) VALUES('%s', '%s')",
      $token,
      $username
    );
    $result = $conn->query($sql);
    if(!$result) {
      die($conn->error);
    }

    // 登入成功
    $expire = time() + 3600 * 24 * 30;
    setcookie("token", $token, $expire );
    header("Location: index.php");
  } else {
    header("Location: login.php?errCode=2");
  }
?>