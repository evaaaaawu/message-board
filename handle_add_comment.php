<?php
  require_once('conn.php');

  if (
    empty($_POST['nickname']) || 
    empty($_POST['content'])
  ) {
    header('Location: index.php?errCode=1');
    die('資料不齊全');
  }

  $nickname = $_POST['nickname'];
  $content = $_POST['content'];

  $sql = sprintf (
    "INSERT INTO comments(nickname, content) VALUES('%s', '%s')",
    $nickname,
    $content
  );

  $result = $conn->query($sql);
  if (!$result) {
    die($conn->error);
  }

  header("Location: index.php");
?>