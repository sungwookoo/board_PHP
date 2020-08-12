<?php 
    include $_SERVER['DOCUMENT_ROOT']."/myBoard/db.php";
    
    $bno = $_GET['idx'];
    $sql = mq("select * from board where idx ='$bno';");
    $board = $sql->fetch_array(); // db에서 select한 게시글을 $board에 저장
?>
<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <title>글 삭제</title>
    <link rel="stylesheet" href="./css/style.css" />
</head>
<body>
    
    <div class="centerOuter">
        <div class="centerInner">
        <h4>삭제 확인</h4><br>
            <form action="delete.php?idx=<?php echo $bno; ?>" method="post">
                <div>
                    <input type="password" name="pw" id="chkpw" placeholder="비밀번호" required autofocus/>
                </div>
                <div>
                    <br><button type="submit">확인</button>
                </div>
            </form>
        </div>
    </div>

</body>
</html>



