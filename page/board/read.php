<!DOCTYPE html>
<?php
    include $_SERVER['DOCUMENT_ROOT']."/myBoard/db.php"; // db load 
?>


<head>
    <meta charset="UTF-8">
    <title>게시판</title>
    <link rel="stylesheet" type="text/css" href="./css/style.css" />
</head>

<body>
    <?php
        $bno = $_GET['idx']; // bno = idx 
        $hit = mysqli_fetch_array(mq("select * from board where idx ='".$bno."'")); // db에서 해당 게시글을 idx값으로 찾아서 hit에 저장
        $hit = $hit['hit']+1; // 그 게시글의 'hit' 값을 +1
        $fet = mq("update board set hit = '".$hit."' where idx = '".$bno."'"); // +1한 hit를 db에 update
        $sql = mq("select * from board where idx='".$bno."'"); // 업데이트한 게시글을 $sql 에 다시 불러옴
        $board = $sql->fetch_array(); // 그리고 최종적으로 사용자가 제목을 클릭해서 내용을 보게되는 게시글 $board 변수에 저장
    ?>
    <!-- read -->
    <div id="board_read">
        <h2><?php echo $board['title']; ?></h2>
        <div id="user_info">
        <div id="bo_ser">
            <ul>
                <li><a href="/myBoard"><strong>[목록]</strong></a></li>
                <li><a href="modify.php?idx=<?php echo $board['idx']; ?>"><strong>[수정]</strong></a></li>
                <li><a href="pw_check.php?idx=<?php echo $board['idx']; ?>" onclick="window.open(this.href,'팝업창','width=400,height=240');return false;"><strong>[삭제]</strong></a></li>
            </ul>
        </div>
            <?php echo $board['name']; ?> <?php echo $board['date']; ?> 조회:<?php echo $board['hit']; ?>
            <div id="bo_line"></div>
            
        </div>
        
        
        <div id="bo_content">
            <?php echo nl2br("$board[content]"); ?>
            <!-- nl2br : 문자열 중 \n을 <br>로 변환 / 게시글 내용의 엔터(줄바꿈)을 표현하기위해 사용 -->
            <br><br>
        </div>

        <!-- function -->
        <div id="bo_ser">
            <ul><br>
                <li><a href="/myBoard"><strong>[목록]</strong></a></li>
                <li><a href="modify.php?idx=<?php echo $board['idx']; ?>"><strong>[수정]</strong></a></li>
                <li><a href="pw_check.php?idx=<?php echo $board['idx']; ?>" onclick="window.open(this.href,'팝업창','width=400,height=240');return false;"><strong>[삭제]</strong></a></li>
                
            </ul>
        </div>
    </div>
</body>
</html>
