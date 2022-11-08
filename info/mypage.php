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
    <title>마이페이지</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../assets/style.css">
    <script>
        function clickAndShow(showWhat) {
            checkCheck(showWhat);
            var capShowWhat = showWhat.charAt(0).toUpperCase() + showWhat.slice(1);
            var checkbox = document.getElementById("use"+capShowWhat);
            var div = document.getElementById(showWhat+"Div");
            if(checkbox.checked == true) {
                div.style.display = "block";
                div.getElementsByTagName('input')[0].required = true;
            } else {
                div.style.display = "none";
                div.getElementsByTagName('input')[0].required = false;
            }
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
        function check() {
            if(document.getElementById('useNickname').checked && document.getElementById('useId').checked) {
                if(document.querySelectorAll("[name='checkConfirm']:checked").length !== 2) {
                    alert('닉네임이나 ID 중복 확인을 해주세요.');
                    return false;
                }
            } else if(document.getElementById('useNickname').checked || document.getElementById('useId').checked) {
                if(document.querySelectorAll("[name='checkConfirm']:checked").length !== 1) {
                    alert('닉네임이나 ID 중복 확인을 해주세요.');
                    return false;
                }
            }
            if(document.send.newPassword.value == document.send.newPasswordConfirm.value) {
                return true;
            } else {
                alert('비밀번호 확인을 한번 더 해주세요.');
                return false;
            }
        }
    </script>
</head>
<body>
    <?php require("../part/topBar.php"); ?>
    <div class="main">
    <?php
    if(empty($isLogin)) {
        echo "<p>로그인을 하시고 서비스를 이용해 주세요.</p>";
    } else { ?>
        <h2>회원정보 변경</h2>
        <form action="process_mypage.php" method="POST" onsubmit="return check()" name="send">
            <p>
                <input type="hidden" name="opt0" value="">
                <input type="checkbox" name="opt0" id="useNickname" value="nickname" onclick="clickAndShow('nickname')">
                <label for="useNickname">닉네임</label>
            </p>   
                <div id="nicknameDiv" class="hideDiv">
                    <input type="text" name="nickname" placeholder="New Nickname" id="inf_nn">
                    <button type="button" onclick="window.open('confirmNickname.php?nickname='+document.getElementById('inf_nn').value, '닉네임확인', 'top=10, left=10, width=350, height=200, status=no, menubar=no, toolbar=no, resizable=no');">새 닉네임 중복 확인</button>
                    <p>
                        <label class="hideDiv" id="hideNick"><input type="checkbox" name="checkConfirm" id="nicknameCheck" onclick="checkCheck('nickname')">닉네임 확인 여부</label>
                    </p>
                </div>
            <p>
                <input type="hidden" name="opt1" value="">
                <input type="checkbox" name="opt1" id="useId" value="id" onclick="clickAndShow('id')">
                <label for="useId">ID</label>
            </p>   
                <div id="idDiv" class="hideDiv">
                    <input type="text" name="id" placeholder="New ID" id="inf_id">
                    <button type="button" onclick="window.open('confirmId.php?id='+document.getElementById('inf_id').value, 'ID확인', 'top=10, left=10, width=350, height=200, status=no, menubar=no, toolbar=no, resizable=no');">새 ID 중복 확인</button>
                    <p>
                        <label class="hideDiv" id="hideId"><input type="checkbox" name="checkConfirm" id="idCheck" onclick="checkCheck('id')">ID 확인 여부</label>
                    </p>
                </div>
            <p>
                <input type="hidden" name="opt2" value="">
                <input type="checkbox" name="opt2" id="usePassword" value="password" onclick="clickAndShow('password')">
                <label for="usePassword">비밀번호</label>
            </p>   
                <div id="passwordDiv" class="hideDiv">
                    <p>
                        <input type="password" name="oldPassword" placeholder="Old Password" class="wideInput">
                    </p>
                    <p>
                        <input type="password" name="newPassword" placeholder="New Password" class="wideInput">
                    </p>
                    <p>
                        <input type="password" name="newPasswordConfirm" placeholder="New Password Re" class="wideInput">
                    </p>
                </div>
            <p>
                <input class="btn btn-outline-primary" type="submit" value="변경">
                <button type="button" class="btn btn-outline-dark" onclick="location.href='/index.php';">취소</button>
            </p>
        </form>
    <?php } ?>
    </div>
</body>
</html>