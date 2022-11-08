<?php
session_start();
$conn = require("../part/mysql.php");
$inf = array(
    'nickname'=>mysqli_real_escape_string($conn,$_POST['nickname']),
    'id'=>mysqli_real_escape_string($conn,$_POST['id']),
    'oldPassword'=>mysqli_real_escape_string($conn,$_POST['oldPassword']),
    'password'=>mysqli_real_escape_string($conn,$_POST['newPassword'])
);
$sql = "SELECT * FROM information WHERE idx={$_SESSION['idx']}";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($result);
if(!empty($_POST['opt2'])) {
    if($inf['oldPassword'] !== $row['password']) {
        echo "<script>alert('비밀번호 확인을 한번 더 해주세요.');location.replace('mypage.php');</script>";
        exit;
    }
}
for($i = 0; $i < 3; $i++) {
    if(!empty($_POST['opt'.$i])) {
        $value = $_POST['opt'.$i];
        $sql = "UPDATE information SET {$value}='{$inf[$value]}' WHERE idx={$_SESSION['idx']}";
        $result = mysqli_query($conn, $sql);
        if($result === false) {
            error_log(mysqli_error($conn));
            echo "<script>alert('회원정보 변경에 실패했습니다. 입력한 정보가 잘못됐거나 에러입니다.');location.replace('mypage.php');</script>";
        }
        if(isset($_SESSION[$value])) {
            $_SESSION[$value] = $inf[$value];
        }
    }
}
echo "<script>alert('회원정보 변경에 성공했습니다.');location.replace('mypage.php');</script>";
?>