<?php 
    include $_SERVER['DOCUMENT_ROOT']."/myBoard/db.php";
    
    $bno = $_GET['idx'];
    $sql = mq("select * from board where idx ='$bno';");
    $board = $sql->fetch_array(); // db에서 select한 게시글을 $board에 저장
    
    if(password_verify($_POST['pw'],$board['pw'])){
        $sql = mq("delete from board where idx='$bno';");
        echo "<script>
        alert('삭제되었습니다.'); 
        opener.parent.location='/myBoard';
        window.close();
        </script>";
?>
<?php 
    } //여기까지 if문

    else{
        echo "<script>
        alert('비밀번호가 틀렸습니다.');
        opener.parent.location='/myBoard';
        window.close();
        </script>";
    }
?>