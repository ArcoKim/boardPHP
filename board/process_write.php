<?php
session_start();
$conn = require("../part/mysql.php");
$inf = array(
    'title'=>mysqli_real_escape_string($conn,$_POST['title']),
    'article'=>mysqli_real_escape_string($conn,$_POST['article'])
);
$sql = "INSERT INTO boardpost(title,article,created,posted,board) VALUES('{$inf['title']}','{$inf['article']}',NOW(),'{$_SESSION['idx']}','{$_POST['board']}')";
$result = mysqli_query($conn, $sql);
if($result === false) {
    error_log(mysqli_error($conn));
    echo "<script>alert('상상도 못한 에러입니다. 관계자한테 연락해주세요...');location.replace('write.php');</script>";
} else {
    echo "<script>alert('글 쓰기를 성공했습니다.');location.replace('/index.php?id={$_POST['board']}&pgNum=1');</script>";
}
?>