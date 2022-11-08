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
    <title>로그인</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../assets/style.css">
</head>
<body>
    <?php require('../part/topBar.php'); ?>
    <div class="main">
    <?php
    if($isLogin) {
        echo "<p>로그인이 이미 되어 있습니다.</p>";
    } else { ?>
        <h2>로그인</h2>
        <form action="process_login.php" method="POST" id="logForm">
            <p>
                <input type="text" name="id" placeholder="ID" class="wideInput" required>
            </p>
            <p>
                <input type="password" name="password" placeholder="Password" class="wideInput" required>
            </p>
            <p>
                <input class="btn btn-outline-primary" type="submit" value="로그인">
                <button class="btn btn-outline-dark" onclick="location.href = '/index.php';">취소</button>
            </p>
        </form>
    <?php } ?>
    </div>
</body>
</html>