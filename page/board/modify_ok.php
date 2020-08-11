<?php
include $_SERVER['DOCUMENT_ROOT']."/myBoard/db.php"; // db load 

$bno = $_GET['idx'];
$sql = mq("select * from board where idx ='$bno';");
$board = $sql->fetch_array(); // db에서 select한 게시글을 $board에 저장
$username = $_POST['name'];
// $userpw = password_hash($_POST['pw'],PASSWORD_DEFAULT);
$userpw = $_POST['pw'];
$title = $_POST['title'];
$content = $_POST['content'];

if(password_verify($userpw,$board['pw'])){
    $sql = mq("update board set name='".$username."',title='".$title."',content='".$content."' where idx='".$bno."'"); 
    echo "<script>alert('수정되었습니다.'); </script>";
?>  <meta http-equiv="refresh" content="0 url=/myBoard/page/board/read.php?idx=<?php echo $bno; ?>"> 
<?php 
} //여기까지 if문
else{
    echo "<script>
    alert('비밀번호가 틀렸습니다.');
    location.href='/myBoard';
    </script>";
}
?>