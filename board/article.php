<?php
$conn = require("../part/mysql.php");
$sql = "SELECT * FROM boardpost WHERE id={$_GET['postId']}";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($result);
$sql = "SELECT * FROM boardpost LEFT JOIN information ON posted = idx WHERE boardpost.id={$_GET['postId']}";
$result = mysqli_query($conn, $sql);
$nicknameRow = mysqli_fetch_array($result);
$article = nl2br(htmlspecialchars($row['article']));
$table = "<table class='table table-light showTable' id='articleTable'><tr><th>제목</th><td>{$row['title']}</td><th>날짜</th><td>{$row['created']}</td></tr>";
$table .= "<tr><th>게시자</th><td>{$nicknameRow['nickname']}</td><th>옵션</th><td><button class='btn btn-outline-secondary' onClick=\"location.href = 'edit.php?postId={$_GET['postId']}'\">수정</button>
<form action='delete.php' method='POST' onsubmit=\"return confirm('정말로 이 게시물을 삭제하시겠습니까?')\" style='display:inline-block;'>
<input type='hidden' name='id' value='{$_GET['postId']}'>
<input type='submit' class='btn btn-outline-secondary' value='삭제'>
</form></td></tr>";
$table .= '</table>';
?>
<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>게시물</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../assets/style.css">
</head>
<body>
    <?php require("../part/topBar.php"); ?>
    <div class="main">
        <?=$table?>
        <div class="article">
            <?=$article?>
        </div>
    </div>
</body>
</html>