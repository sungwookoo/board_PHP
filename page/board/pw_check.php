<?php 
    include $_SERVER['DOCUMENT_ROOT']."/myBoard/db.php";

    $userpw = ''; // 입력받은 pw
    $bno = $_GET['idx'];
    $sql = mq("select * from board where idx ='$bno';");
    $board = $sql->fetch_array(); // db에서 select한 게시글을 $board에 저장

if(password_verify($userpw,$board['pw'])){
    $sql = mq("delete from board where idx='$bno';");
    echo "<script>alert('삭제되었습니다.'); </script>";
?>  
<meta http-equiv="refresh" content="0 url=/myBoard">
<?php 
} //여기까지 if문
else{
    echo "<script>
    alert('비밀번호가 틀렸습니다.');
    location.href='/myBoard';
    </script>";
}
?>