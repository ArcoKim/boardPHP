<?php
session_start();
$conn = require("../part/mysql.php");
$inf = array(
    'id'=>mysqli_real_escape_string($conn,$_POST['id']),
    'password'=>mysqli_real_escape_string($conn,$_POST['password'])
);
$sql = "SELECT * FROM information WHERE id='{$inf['id']}' AND password='{$inf['password']}'";
$result = mysqli_query($conn, $sql);
$total_rows = mysqli_num_rows($result);
if($total_rows === 1) {
    $row = mysqli_fetch_array($result);
    $_SESSION['isLogin'] = true;
    $_SESSION['nickname'] = $row['nickname'];
    $_SESSION['idx'] = $row['idx'];
    header('Location: /index.php');
} else {
    echo "<script>alert('아이디나 비밀번호가 일치하지 않습니다.');location.replace('login.php');</script>";
}
?>