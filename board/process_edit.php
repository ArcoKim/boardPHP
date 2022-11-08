<?php
session_start();
$conn = require("../part/mysql.php");
$inf = array(
    'title'=>mysqli_real_escape_string($conn,$_POST['title']),
    'article'=>mysqli_real_escape_string($conn,$_POST['article'])
);
$sql = "UPDATE boardpost SET title='{$inf['title']}',article='{$inf['article']}' WHERE id={$_POST['id']}";
$result = mysqli_query($conn, $sql);
if($result === false) {
    error_log(mysqli_error($conn));
    echo "<script>alert('상상도 못한 에러입니다. 관계자한테 연락해주세요...');location.replace('article.php?postId={$_POST['id']}');</script>";
} else {
    echo "<script>alert('글 수정을 성공했습니다.');location.replace('article.php?postId={$_POST['id']}');</script>";
}
?>