<?php include $_SERVER['DOCUMENT_ROOT']."/myBoard/db.php"; 
// DB정보가 저장되어있는 db.php 파일을 include 
// $_server['document_root']는 httpd.conf 파일에 설정된 웹서버의 루트 디렉토리 -> 현재경로 C:\server\www 
$sql = mq("select * from board");
$total = mysqli_num_rows($sql); // 게시글 총 개수

$page_set = 10;
$block_set = 5;

$sql=mq("select count(idx) as total from board");
$board=mysqli_fetch_array($sql);

$total_page = ceil($total / $page_set); // 총 페이지 수 (올림)
$total_block = ceil($total_page / $block_set); //총 블럭 수 (올림)
if(isset($_GET['page'])) {
    $page = $_GET['page'];
} else {
    $page = 1;
}// 현재 페이지 (넘어온값)
$block=ceil ($page / $block_set); // 현재 블럭 (올림)

$limit_idx = ($page-1) * $page_set; // limit 시작 위치

//현재 페이지 쿼리
$sql = mq("select * from board order by idx desc limit $limit_idx, $page_set");

?>

<!doctype html>

<head></head>
<meta charset="UTF-8">
<title>게시판</title>
<link rel="stylesheet" type="text/css" href="/myBoard/css/style.css">
</head>

<body>
    <div id="board_area">
        <h1>게시판</h1>
        <br>
        <p>총 <?php echo $total ?>개의 게시글</p>
        <a href="/myBoard"><button><img class="img_btn" src="/myBoard/img/refresh.png"></button></a>
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
            // $sql = mq("select * from board order by idx desc limit 0,10"); 
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
                    <!-- <td width="500"><a
                            href="/myBoard/page/board/read.php?idx=<?php echo $board["idx"];?> "><?php echo $title;?></a>
                    </td> -->
                    <td width="500"><a href="/myBoard/hit.php?idx=<?php echo $board["idx"];?> "><?php echo $title;?></a>
                    </td>
                    <!-- 제목을 클릭하면 해당 게시글 내용을 볼 수 있도록 게시글의 id값을 통해 링크 -->
                    <td width="120"><?php echo $board['name']?></td>
                    <td width="100"><?php echo $board['date']?></td>
                    <td width="100"><?php echo $board['hit']; ?></td>
                </tr>
            </tbody>
            <?php } //while문 종료 ?>
        </table>
        <div id="write_btn">
            <a href="/myBoard/page/board/write.php"><img class="img_btn" src="/myBoard/img/write.png"></a>
        </div>
        <?php 
            //페이지번호 & 블럭설정
            $first_page = (($block-1) * $block_set)+1; //첫번째 페이지번호
            $last_page = min($total_page, $block*$block_set); //마지막 페이지번호

            $prev_page = $page-1; // 이전페이지
            $next_page = $page+1; // 다음페이지

            $prev_block = $block-1; // 이전블럭
            $next_block = $block+1; // 다음블럭

            //이전블럭을 블럭의 마지막으로
            $prev_block_page = $prev_block*$block_set; //이전블럭 페이지번호
            //이전블럭을 블럭의 처음으로
            // $prev_block_page = $prev_block * $block_set-($block_set-1);
            $next_block_page = $next_block*$block_set-($block_set-1); //다음블럭 페이지번호

            //페이징화면
            echo ($prev_page > 0) ? "　　　　　　　　　　　　　　　　　　　　　　　<a href='".$_SERVER['PHP_SELF']."?page=1'><img style='height:17px; width:17px;' src='/myBoard/img/first.png'></a> " : "　　　　　　　　　　　　　　　　　　　　　　　<img style='height:17px; width:17px;' src='/myBoard/img/first.png'> "; 
            echo ($prev_page > 0) ? "<a href='".$_SERVER['PHP_SELF']."?page=".$prev_page."'><img style='height:17px; width:17px;' src='/myBoard/img/prev.png'></a> " : "<img style='height:17px; width:17px;' src='/myBoard/img/prev.png'> "; 
            echo ($prev_block > 0) ? "<a href='".$_SERVER['PHP_SELF']."?page=".$prev_block_page."'>··· </a> " : "··· "; 
            for ($i=$first_page; $i<=$last_page; $i++) { 
                echo ($i != $page) ?"<a href='".$_SERVER['PHP_SELF']."?page=".$i."'>$i</a> " : "<b>$i</b> "; 
            } 
            echo ($next_block <= $total_block) ? "<a href='".$_SERVER['PHP_SELF']."?page=".$next_block_page."'>··· </a> " : "··· "; 
            echo ($next_page <= $total_page) ? "<a href='".$_SERVER['PHP_SELF']."?page=".$next_page."'><img style='height:17px; width:17px;' src='/myBoard/img/next.png'></a>" : "<img style='height:17px; width:17px;' src='/myBoard/img/next.png'>"; 
            echo ($next_page <= $total_page) ? "<a href='".$_SERVER['PHP_SELF']."?page=".$total_page."'> <img style='height:17px; width:17px;' src='/myBoard/img/last.png'></a>" : "  <img style='height:17px; width:17px;' src='/myBoard/img/last.png'>"; 
        ?>
        <br><br>
        <!-- 검색 -->
        <div id="search_box">
            <form action="/myBoard/page/board/search_result.php" method="get">
                <select name="catgo">
                    <option value="title">제목</option>
                    <option value="name">글쓴이</option>
                    <option value="content">내용</option>
                </select>
                <input type="text" name="search" size="40" required="required" /> <button>검색</button>
            </form>
        </div>

    </div> <!-- body 최상위 div 끝  -->
</body>
</html>