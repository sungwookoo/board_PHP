<?php 
    include $_SERVER['DOCUMENT_ROOT']."/myBoard/db.php";

    $userpw = ''; // 입력받은 pw
    $bno = $_GET['idx'];
    $sql = mq("select * from board where idx ='$bno';");
    $board = $sql->fetch_array(); // db에서 select한 게시글을 $board에 저장

    $sql = mq("delete from board where idx='$bno';");
    echo "<script>alert('삭제되었습니다.'); </script>";
?>  
<meta http-equiv="refresh" content="0 url=/myBoard">