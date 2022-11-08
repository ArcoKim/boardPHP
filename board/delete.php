<?php
session_start();
$conn = require("../part/mysql.php");
if(isset($_SESSION['isLogin'])) {
    $sql = "SELECT * FROM boardpost WHERE id=".$_POST['id'];
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($result);
    if($row['posted'] === $_SESSION['idx']) {
        $sql = "DELETE FROM boardpost WHERE id=".$_POST['id'];
        $result = mysqli_query($conn, $sql);
        if($result === false) {
            error_log(mysqli_error($conn));
            echo "<script>alert('상상도 못한 에러입니다. 관계자한테 연락해주세요...');location.replace('article.php?postId={$_POST['id']}');</script>";
        } else {   
            echo "<script>alert('글 삭제를 성공했습니다.');location.replace('/index.php?id={$row['board']}&pgNum=1');</script>";
        }
    } else {
        echo "<script>alert('게시자만 수정할 수 있습니다.');location.replace('article.php?postId={$_POST['id']}');</script>";
        exit;
    }
} else {
    echo "<script>alert('로그인을 하십시오.');location.replace('/info/login.php');</script>";
    exit;
}
?>