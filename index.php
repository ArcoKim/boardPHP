<?php
session_start();
$conn = require("./part/mysql.php");
$pgNum = "<div class='center'>";
if(isset($_GET['id'])) {
    if(isset($_SESSION['isLogin'])) {
        $possibleWrite = "<button class='btn btn-outline-success' onClick=\"location.href='./board/write.php?id={$_GET['id']}'\" style='float:right;'>글 쓰기</button>";
    } else {
        $possibleWrite = "";
    }
    $sql = "SELECT * FROM boardlist WHERE id=".$_GET['id'];
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($result);
    $title = $row['title'];
    $description = $row['description'];
    $img = "";
    $table = '<table class="table table-light table-hover showTable"><tr><th>No.</th><th>제목</th><th>게시자</th><th>날짜</th></tr>';
    $sql = "SELECT * FROM boardpost LEFT JOIN information ON posted = idx WHERE board={$_GET['id']} ORDER BY created DESC";
    if(isset($_GET['pgNum'])) {
        if($_GET['pgNum'] === '1') {
            $sql .= " LIMIT 7";
        } else {
            $startNum = $_GET['pgNum'] * 7 - 1;
            $sql .= " LIMIT {$startNum},7";
        }
    } else {
        header("Location: /index.php?id={$_GET['id']}&pgNum=1");
    }
    $result = mysqli_query($conn, $sql);
    while($row = mysqli_fetch_array($result)) {
        $table .= "<tr class='atcList' onClick=\"location.href='./board/article.php?postId={$row[0]}'\"><td>{$row[0]}</td><td class='ttitle'>{$row['title']}</td><td class='tnickname'>{$row['nickname']}</td><td class='tcreated'>{$row['created']}<tr>";
    }
    $table .= '</table>';
    $sql = "SELECT * FROM boardpost WHERE board={$_GET['id']}";
    $result = mysqli_query($conn, $sql);
    $total_rows = mysqli_num_rows($result);
    $pgCount = ceil($total_rows / 7);
    for($i = 1; $i <= $pgCount; $i++) {
        $pgNum .= "<a href=\"index.php?id={$_GET['id']}&pgNum={$i}\" class='pg anchor'>{$i} </a>";
    } 
} else {
    $title = "안녕하세요?";
    $description = "게시판에 오신 것을 환영합니다!";
    $img = '<img src="./assets/welcome.jpg" id="welcome" alt="환영합니다!">';
    $table = "";
    $possibleWrite = "";
    $pgNum .= "</div>";
}
?>
<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>게시판</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="./assets/style.css">
</head>
<body>
    <?php require('part/topBar.php') ?>
    <div class="main">
        <h2><?=$title?></h2>
        <p>
            <?=$description?>
            <?=$possibleWrite?>
        </p>
        <?=$img?>
        <?=$table?>
        <?=$pgNum?>
    </div>
</body>
</html>