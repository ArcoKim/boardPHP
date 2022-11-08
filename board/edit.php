<?php
session_start();
$conn = require("../part/mysql.php");
if(isset($_SESSION['isLogin'])) {
    $sql = "SELECT * FROM boardpost WHERE id=".$_GET['postId'];
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($result);
    if($row['posted'] === $_SESSION['idx']) {
        $title = $row['title'];
        $article = $row['article'];
    } else {
        $title = "";
        $article = "";
        echo "<script>alert('게시자만 수정할 수 있습니다.');location.replace('article.php?postId={$_GET['postId']}');</script>";
    }
} else {
    $title = "";
    $article = "";
    echo "<script>alert('로그인을 하십시오.');location.replace('/info/login.php');</script>";
}
?>
<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>게시물 정보 변경</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../assets/style.css">
</head>
<body>
    <?php require("../part/topBar.php"); ?>
    <div class="main">
        <form action="process_edit.php" method="post">
            <input type="hidden" name="id" value="<?=$_GET['postId']?>">
            <p><input class="inputs" type="text" name="title" placeholder="수정되는 제목" value="<?=$title?>" required></p>
            <p><textarea class="inputs" name="article" rows="20" placeholder="수정되는 글" required><?=$article?></textarea></p>
            <p><input class="btn btn-outline-success" type="submit" value="글 수정"></p>
        </form>
    </div>
</body>
</html>