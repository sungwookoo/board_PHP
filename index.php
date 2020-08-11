<?php include $_SERVER['DOCUMENT_ROOT']."/myBoard/db.php"; 
// DB정보가 저장되어있는 db.php 파일을 include 
// $_server['document_root']는 httpd.conf 파일에 설정된 웹서버의 루트 디렉토리 -> 현재경로 C:\server\www 
?> 

<!doctype html>
<head>
    <meta charset="UTF-8">
    <title>게시판</title>
    <link rel="stylesheet" type="text/css" href="/myBoard/css/style.css">
</head>

<body>
    <div id="board_area">
        <h1>게시판</h1>
        <table class="list-table">
            <thead>
                <tr>
                    <th width="70">번호</th>
                    <th width="500">제목</th>
                    <th width="120">글쓴이</th>
                    <th width="100">작성일</th>
                    <th width="100">조회수</th>
                </tr>
            </thead>
            <?php
            $sql = mq("select * from board order by idx desc limit 0,10"); 
            // 게시글 10개씩표시
            while($board=$sql->fetch_array()){
            //mysqli_fetch_array : 쿼리를 날려 얻은 result set에서 레코드를 1개씩 리턴해주는 함수 [일반배열+연관배열 모두 값으로 갖는 배열을 리턴]
                  $title=$board["title"];
                  if(strlen($title)>30)
                  {
                     $title=str_replace($board["title"],mb_substr($board["title"],0,30,"utf-8")."...",$board["title"]);
                     // 0번째 문자부터 30글자까지 쓰고 뒤는 ... 으로 대체
                  }
            ?>
                <tbody>
                    <tr>
                        <td width="70"><?php echo $board['idx']; ?></td>
                        <td width="500"><a href="/myBoard/page/board/read.php?idx=<?php echo $board["idx"];?> "><?php echo $title;?></a></td>
                        <td width="120"><?php echo $board['name']?></td>
                        <td width="100"><?php echo $board['date']?></td>
                        <td width="100"><?php echo $board['hit']; ?></td>
                    </tr>
                </tbody>
            <?php } ?>
        </table>
        <div id="write_btn">
            <a href="/myBoard/page/board/write.php"><button>글쓰기</button></a>
        </div>
    </div>
</body>
</html>