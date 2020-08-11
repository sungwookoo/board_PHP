<?php

include $_SERVER['DOCUMENT_ROOT']."/myBoard/db.php";

$username = $_POST['name'];
$userpw = password_hash($_POST['pw'],PASSWORD_DEFAULT);
$title = $_POST['title'];
$content = $_POST['content'];
$date = date('Y-m-d');
if($username && $userpw && $title && $content){
    $sql = mq("insert into board(name,pw,title,content,date) values('".$username."',
            '".$userpw."','".$title."','".$content."','".$date."')");
    echo "<script>
    alert('게시글이 작성되었습니다.');
    location.href='/myBoard';</script>";
}
else{
    echo "<script>
    alert('게시글이 작성되지 않았습니다.');
    history.back();
    </script>";
}
?>