<?php
$conn = require("../part/mysql.php");
$inf = array(
    'id'=>mysqli_real_escape_string($conn,$_POST['id']),
    'password'=>mysqli_real_escape_string($conn,$_POST['password']),
    'name'=>mysqli_real_escape_string($conn,$_POST['name']),
    'nickname'=>mysqli_real_escape_string($conn,$_POST['nickname'])
);
$sql = "INSERT INTO information(id,password,name,nickname) VALUES('{$inf['id']}','{$inf['password']}','{$inf['name']}','{$inf['nickname']}')";
$result = mysqli_query($conn, $sql);
if($result === false) {
    error_log(mysqli_error($conn));
    echo "<script>alert('상상도 못한 에러입니다. 관계자한테 연락해주세요...');
            location.replace('registration.php');</script>";
} else {
    echo "<script>alert('회원가입을 성공했습니다!');
            location.replace('/index.php');</script>";
}
?>