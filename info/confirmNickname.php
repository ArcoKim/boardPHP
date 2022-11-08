<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>닉네임확인</title>
</head>
<body>
    <?php
    if($_GET['nickname'] === "") {
        echo '닉네임을 채워주시고 다시 시도해보세요.';
    } else {
        $conn = require("../part/mysql.php");
        $nickname = mysqli_real_escape_string($conn,$_GET['nickname']);
        $sql = "SELECT * FROM information WHERE nickname='{$nickname}'";
        $result = mysqli_query($conn, $sql);
        $total_rows = mysqli_num_rows($result);
        if($total_rows >= 1) {
            echo "중복되는 아이디입니다.";
            echo "<script>window.opener.document.getElementById('inf_nn').value = '';</script>";
        } else {
            echo "사용하실 수 있는 아이디입니다.";
            echo "<script>window.opener.document.getElementById('hideNick').style.display = 'inline-block';
            window.opener.document.getElementById('nicknameCheck').checked = true;
            window.opener.document.getElementById('inf_nn').readOnly = true;</script>";
        }
    }
    ?>
</body>
</html>