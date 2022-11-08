<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>게시물 올리기</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../assets/style.css">
</head>
<body>
    <?php require("../part/topBar.php"); ?>
    <div class="main">
        <form action="process_write.php" method="post">
            <input type="hidden" name="board" value="<?=$_GET['id']?>">
            <p><input class="inputs" type="text" name="title" placeholder="제목" required></p>
            <p><textarea class="inputs" name="article" rows="20" placeholder="글" required></textarea></p>
            <p><input class="btn btn-outline-success" type="submit" value="글 쓰기"></p>
        </form>
    </div>
</body>
</html>