<?php
  require_once("conn.php");
  $sql = "SELECT * FROM comments ORDER BY id DESC";
  $result = $conn->query($sql);
  if(!$result) {
    die("Error:" . $conn->error);
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>留言板</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <header class="warning">
    <strong>注意！本站為練習用網站，因教學用途刻意忽略資安的實作，註冊時請勿使用任何真實的帳號或密碼。</strong>
  </header>
  <main class="board">
    <h1 class="board__title">Comments</h1>
    <form class="board__new-comment-form" method="POST" action="./handle_add_comment.php">
      <div class="board__nickname">
        <span>暱稱:</span>
        <input type="text" name="nickname" />
      </div>
      <textarea name="content" id="" cols="30" rows="5"></textarea>
      <input class="board__submit-btn" type="submit" />
    </form>
    <div class="board__hr"></div>
    <section>
      <?php while($row = $result->fetch_assoc()) { ?>
        <div class="card">
          <div class="card__avatar"></div>
          <div class="card__body">
            <div class="card__info">
              <span class="card__author"><?php echo $row['nickname']; ?></span>
              <span class="card__time"><?php echo $row['created_at']; ?></span>
            </div>
            <p class="card__content">
              <?php echo $row['content']; ?>
            </p>
          </div>
        </div>
      <?php } ?>
      
    </section>
  </main>
</body>
</html>