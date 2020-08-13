<?php
    include $_SERVER['DOCUMENT_ROOT']."/myBoard/db.php"; // db load 

    $page_set = 10;
    $block_set = 5;

    

?>
<!doctype html>

<head>
    <meta charset="UTF-8">
    <title>게시판</title>
    <link rel="stylesheet" type="text/css" href="./css/style.css">
</head>

<body>
    <div id="board_area">
        <?php
        $catagory = $_GET['catgo'];
        $search_con = $_GET['search'];
    ?>
        <h1>Search '<?php echo $search_con; ?>' by <?php echo $catagory;?></h1>
        <h4 style="margin-top:30px;"><a href="/myBoard">홈으로</a></h4>
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
                $sql = mq("select * from board where $catagory like '%$search_con%' order by idx desc");
                $total = mysqli_num_rows($sql); // 게시글 총 개수
                echo "<br>검색된 게시글 총 개수 : ".$total;
                if(isset($_GET['page'])) {
                    $page = $_GET['page'];
                } else {
                    $page = 1;
                }// 현재 페이지 (넘어온값)
                
                $limit_idx = ($page-1) * $page_set; // limit 시작 위치
                
                $sql2 = mq("select * from board where $catagory like '%$search_con%' order by idx desc limit $limit_idx, $page_set");
                
                $total_page = ceil($total / $page_set); // 총 페이지 수 (올림)
                $total_block = ceil($total_page / $block_set); //총 블럭 수 (올림)
                $block=ceil ($page / $block_set); // 현재 블럭 (올림)
                

                while($board = $sql2->fetch_array()){
                    $title=$board["title"];
                        if(strlen($title)>30) //제목이 30자보다 길면 초과하는부분 ...으로 대체
                        {
                            $title=str_replace($board["title"],mb_substr($board["title"],0,30,"utf-8")."...",$board["title"]);
                        }
            ?>

            <!-- 카테고리에 따라 검색결과 구분하여 표시 -->
            <tbody>
                <tr> 
                    <?php if($catagory=='title'){ ?>
                    <td width="70"><?php echo $board['idx'];?></td>
                    <td width="500">
                        <a href='/myBoard/hit.php?idx=<?php echo $board["idx"];?>'><span
                     style="background:yellow;"> <?php echo $title;?> </span></a>
                    </td>
                    <td width="120"><?php echo $board['name']?></td>
                    <td width="100"><?php echo $board['date']?></td>
                    <td width="100"><?php echo $board['hit']; ?></td>
                    <?php } ?>

                    <?php if($catagory=='name'){ ?>
                    <td width="70"><?php echo $board['idx'];?></td>
                    <td width="500">
                        <a href='/myBoard/hit.php?idx=<?php echo $board["idx"];?>'><?php echo $title;?></a>
                    </td>
                    <td width="120"><span
                     style="background:yellow;"> <?php echo $board['name']?></span></td>
                    <td width="100"><?php echo $board['date']?></td>
                    <td width="100"><?php echo $board['hit']; ?></td>
                    <?php } ?>

                    <?php if($catagory=='content'){ ?>
                    <td width="70"><?php echo $board['idx'];?></td>
                    <td width="500">
                        <a href='/myBoard/hit.php?idx=<?php echo $board["idx"];?>'><?php echo $title;?></a>
                    </td>
                    <td width="120"><?php echo $board['name']?></td>
                    <td width="100"><?php echo $board['date']?></td>
                    <td width="100"><?php echo $board['hit']; ?></td>
                    <?php } ?>
                </tr>
            </tbody>
            <?php } ?>
        </table>
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

            //-------------페이징화면
            //http://localhost/myBoard/page/board/search_result.php?catgo=title&search=test&page=2
            //prev 버튼
            echo ($prev_page > 0) ? "　　　　　　　　　　　　　　　　　　　　　　　<a href='".$_SERVER['PHP_SELF']."?catgo=".$catagory."&search=".$search_con."&page=".$prev_page."'><img style='height:17px; width:17px;' src='/myBoard/img/prev.png'></a> " : "　　　　　　　　　　　　　　　　　　　　　　　<img style='height:17px; width:17px;' src='/myBoard/img/prev.png'> "; 
            echo ($prev_block > 0) ? "<a href='".$_SERVER['PHP_SELF']."?catgo=".$catagory."&search=".$search_con."&page=".$prev_block_page."'>··· </a> " : "··· "; 
            for ($i=$first_page; $i<=$last_page; $i++) { 
                echo ($i != $page) ?"<a href='".$_SERVER['PHP_SELF']."?catgo=".$catagory."&search=".$search_con."&page=".$i."'>$i</a> " : "<b>$i</b> "; 
            } 
            echo ($next_block <= $total_block) ? "<a href='".$_SERVER['PHP_SELF']."?catgo=".$catagory."&search=".$search_con."&page=".$next_block_page."'>··· </a> " : "··· "; 
            //next 버튼
            echo ($next_page <= $total_page) ? "<a href='".$_SERVER['PHP_SELF']."?catgo=".$catagory."&search=".$search_con."&page=".$next_page."'><img style='height:17px; width:17px;' src='/myBoard/img/next.png'></a>" : "<img style='height:17px; width:17px;' src='/myBoard/img/next.png'>"; 
        ?>

        <!-- 검색 -->
        <div id="search_box2">
            <form action="/myBoard/page/board/search_result.php" method="get">
                <select name="catgo">
                    <option value="title">제목</option>
                    <option value="name">글쓴이</option>
                    <option value="content">내용</option>
                </select>
                <input type="text" name="search" size="40" required="required" /> <button>검색</button>
            </form>
        </div>
    </div>
</body>

</html>