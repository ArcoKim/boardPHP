<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ID확인</title>
</head>
<body>
    <?php
    if($_GET['id'] === "") {
        echo '닉네임을 채워주시고 다시 시도해보세요.';
    } else {
        $conn = require("../part/mysql.php");
        $id = mysqli_real_escape_string($conn,$_GET['id']);
        $sql = "SELECT * FROM information WHERE id='{$id}'";
        $result = mysqli_query($conn, $sql);
        $total_rows = mysqli_num_rows($result);
        if($total_rows >= 1) {
            echo "중복되는 아이디입니다.";
            echo "<script>window.opener.document.getElementById('inf_id').value = '';</script>";
        } else {
            echo "사용하실 수 있는 아이디입니다.";
            echo "<script>window.opener.document.getElementById('hideId').style.display = 'inline-block';
            window.opener.document.getElementById('idCheck').checked = true;
            window.opener.document.getElementById('inf_id').readOnly = true;</script>";
        }
    }
    ?>
</body>
</html>