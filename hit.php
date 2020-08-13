<?php
    include $_SERVER['DOCUMENT_ROOT']."/myBoard/db.php"; // db load 

    $bno = $_GET['idx']; // bno = idx 
    $hit = mysqli_fetch_array(mq("select * from board where idx ='".$bno."'")); // db에서 해당 게시글을 idx값으로 찾아서 hit에 저장
    $hit = $hit['hit']+1; // 그 게시글의 'hit' 값을 +1
    $fet = mq("update board set hit = '".$hit."' where idx = '".$bno."'"); // +1한 hit를 db에 update
    $sql = mq("select * from board where idx='".$bno."'"); // 업데이트한 게시글을 $sql 에 다시 불러옴
    $board = $sql->fetch_array(); // 그리고 최종적으로 사용자가 제목을 클릭해서 내용을 보게되는 게시글 $board 변수에 저장
?>
<script>
    location.href="/myBoard/page/board/read.php?idx=<?php echo $board['idx'];?>";
</script>

