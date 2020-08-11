<?php
include $_SERVER['DOCUMENT_ROOT']."/myBoard/db.php"; // db load 

// 각 변수에 write.php 에서 post 한 값들을 저장
$username = $_POST['name'];
$userpw = password_hash($_POST['pw'],PASSWORD_DEFAULT);
$title = $_POST['title'];
$content = $_POST['content'];
$date = date('Y-m-d');

// write.php에서 사용자가 전송한 form에 username, userpw, title, content의 값이 모두 있다면 쿼리문을 실행
// 작성 성공 알림과 location.href을 통해 list 화면으로 이동
if($username && $userpw && $title && $content){
    $sql = mq("insert into board(name,pw,title,content,date) values('".$username."',
            '".$userpw."','".$title."','".$content."','".$date."')");
    echo "<script>
    alert('게시글이 작성되었습니다.');
    location.href='/myBoard';</script>";
}

// 그중 하나라도 없다면 쿼리문을 실행하지않고 작성 실패 알림 송출과 뒤로 이동
else{
    echo "<script>
    alert('게시글이 작성되지 않았습니다.');
    history.back();
    </script>";
}
?>