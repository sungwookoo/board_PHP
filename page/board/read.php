<?php
    include $_SERVER['DOCUMENT_ROOT']."/myBoard/db.php";
?>
<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <title>게시판</title>
    <link rel="stylesheet" type="text/css" href="./css/style.css">
</head>
<body>
    <?php
        $bno = $_GET['idx'];
        $hit = mysqli_fetch_array(mq("select * from board where idx ='".$bno."'"));
        
    ?>
</body>