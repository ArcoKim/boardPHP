<?php
$conn = require("mysql.php");
$topButtonForm = "<button class='btn btn-outline-primary' onclick=\"location.href='/info/login.php'\">로그인</button>
<button class='btn btn-outline-primary' onclick=\"location.href='/info/registration.php'\">회원가입</button>";
if(isset($_SESSION['isLogin'])) {
    $topButtonForm = "<a class='name' href='/info/mypage.php'>".$_SESSION['nickname']."</a><button class='btn btn-outline-primary' onclick=\"location.href='/info/logout.php'\">로그아웃</button>";
} else {
    $possibleWrite = "";
}
$sql = "SELECT * FROM boardlist";
$result = mysqli_query($conn, $sql);
$boards = "<ul class='navbar-nav me-auto'>";
while($row = mysqli_fetch_array($result)) {
    $boards .= "<li class='nav-item'><a href='/index.php?id={$row['id']}&pgNum=1' class='nav-link'>{$row['title']}</a></li>";
}
$boards .= "</ul>";
?>
<nav class="navbar navbar-expand-lg navbar-light" style="background-color: #e3f2fd;">
    <div class="container-fluid">
        <a class="navbar-brand" href="/"><b>게시판</b></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <?=$boards?>
            <div class="optSet">
                <?=$topButtonForm?>
            </div>
        </div>
    </div>
</nav>