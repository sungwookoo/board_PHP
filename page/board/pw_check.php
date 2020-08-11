<!DOCTYPE html>

<head>
    <meta charset="UTF-8">
    <title>글 삭제</title>
    <link rel="stylesheet" type="text/css" href="./css/style.css">
</head>

<body>
    <div id="board_write">
        <h4>게시글 삭제</h4>
        <div id="write_area">
            <form action="delete.php" method="post">
                <div id="in_pw">
                    <input type="password" name="pw" id="upw" placeholder="비밀번호" required />
                </div>
                <div class="bt_se">
                    <button type="submit">확인</button>
                </div>
            </form>
        </div>
    </div>
</body>

</html>