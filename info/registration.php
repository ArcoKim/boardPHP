<?php
session_start();
$isLogin = false;
if(isset($_SESSION['isLogin'])) {
    if($_SESSION['isLogin'] !== false) {
        $isLogin = true;
    }
    else {
        session_destroy();
    }
}
?>
<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>회원가입</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../assets/style.css">
    <script language="javascript">
        function check() {
            if(document.send.password.value == document.send.re_password.value) {
                if(document.querySelectorAll("[name='checkConfirm']:checked").length == 2) {
                    return true;
                } else {
                    alert('닉네임이나 ID 중복 확인을 해주세요.');
                }
            } else {
                alert('비밀번호 확인을 한번 더 해주세요.');
            }
            return false;
        }
        function checkCheck(type) {
            if(type == 'nickname') {
                document.getElementById('hideNick').style.display = 'none';
                document.getElementById('inf_nn').readOnly = false;
            }
            if(type == 'id') {
                document.getElementById('hideId').style.display = 'none';
                document.getElementById('inf_id').readOnly = false;
            }
        }
    </script>
</head>
<body>
    <?php require('../part/topBar.php'); ?>
    <div class="main">
    <?php
    if($isLogin) {
        echo "<p>로그인이 이미 되어 있습니다.</p>";
    } else { ?>
        <h2>회원가입</h2>
        <form action="process_registration.php" method="POST" onsubmit="return check()" id="regForm" name="send">
            <p>
                <input type="text" name="nickname" id="inf_nn" placeholder="Nickname" required>
                <button class="btn btn-outline-warning" type="button" onclick="window.open('confirmNickname.php?nickname='+document.getElementById('inf_nn').value, '닉네임확인', 'top=10, left=10, width=350, height=200, status=no, menubar=no, toolbar=no, resizable=no');">확인</button>
            </p>
            <p>
                <label class="hideDiv" id="hideNick"><input type="checkbox" name="checkConfirm" id="nicknameCheck" onclick="checkCheck('nickname')">닉네임 확인 여부</label>
            </p>
            <p>
                <input type="text" name="id" id="inf_id" placeholder="Id" required>
                <button class="btn btn-outline-warning" type="button" onclick="window.open('confirmId.php?id='+document.getElementById('inf_id').value, 'ID확인', 'top=10, left=10, width=350, height=200, status=no, menubar=no, toolbar=no, resizable=no');">확인</button>
            </p>
            <p>
                <label class="hideDiv" id="hideId"><input type="checkbox" name="checkConfirm" id="idCheck" onclick="checkCheck('id')">ID 확인 여부</label>
            </p>
            <p>
                <input type="password" name="password" placeholder="Password" class="wideInput" required>
            </p>
            <p>
                <input type="password" name="re_password" placeholder="Password Re" class="wideInput" required>
            </p>
            <p>
                <input type="text" name="name" placeholder="Name" class="wideInput" required>
            </p>
            <p>
                <input class="btn btn-outline-success" type="submit" value="작성 완료">
                <input class="btn btn-outline-primary" type="reset" value="재작성">
                <button type="button" class="btn btn-outline-dark" onclick="location.href ='/index.php';">취소</button>
            </p>
        </form>
    <?php } ?>
    </div>
</body>
</html>