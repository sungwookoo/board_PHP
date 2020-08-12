<?php 
    include $_SERVER['DOCUMENT_ROOT']."/myBoard/db.php";
    
    $bno = $_GET['idx'];
    $sql = mq("select * from board where idx ='$bno';");
    $board = $sql->fetch_array(); // db에서 select한 게시글을 $board에 저장
?>

<!doctype html>

<head>
    <meta charset="UTF-8">
    <title>게시판</title>
    <link rel="stylesheet" href="./css/style.css" />
    <script type="text/javascript" src="./js/service/HuskyEZCreator.js" charset="utf-8"></script>
</head>

<body>
    <div id="board_write">
        <h1><a href="/myBoard">게시판</a></h1>
        <h4>게시글 수정</h4>
        <div id="write_area">
            <form action="modify_ok.php?idx=<?php echo $bno; ?>" method="post">
                <div id="in_title">
                    <textarea name="title" id="utitle" rows="1" cols="55" placeholder="제목" maxlength="100"
                        required> <?php echo $board['title']; ?></textarea>
                </div>
                <div class="wi_line"></div>
                <div id="in_name">
                    <textarea name="name" id="uname" rows="1" cols="55" placeholder="글쓴이" maxlength="100"
                        required><?php echo $board['name']; ?></textarea>
                </div>
                <div class="wi_line"></div>
                <!-- <div id="in_content">
                    <textarea name="content" id="ucontent" placeholder="내용"
                        required><?php //echo $board['content']; ?></textarea>
                </div> -->
                <div>
                    <textarea name="content" id="ucontent" rows="30" cols="138"><?php echo $board['content']; ?></textarea>
                </div>

                <div id="in_pw">
                    <input type="password" name="pw" id="upw" placeholder="비밀번호" required />
                </div>
                <div class="bt_se">
                <button type="submit" onclick="submitContents()">글 작성</button>
                </div>
        </div>
    </div>
</body>

</html>

<script type="text/javascript">
    var oEditors = [];
    nhn.husky.EZCreator.createInIFrame({
        oAppRef: oEditors,
        elPlaceHolder: "ucontent",
        sSkinURI: "./SmartEditor2Skin.html",
        fCreator: "createSEditor2"
    });

    // ‘저장’ 버튼을 누르는 등 저장을 위한 액션을 했을 때 submitContents가 호출된다고 가정한다.
    function submitContents(elClickedObj) {
    // 에디터의 내용이 textarea에 적용된다.
    oEditors.getById["ucontent"].exec("UPDATE_CONTENTS_FIELD", []);

    // 에디터의 내용에 대한 값 검증은 이곳에서
    // document.getElementById("ir1").value를 이용해서 처리한다.

        try {
            elClickedObj.form.submit();
        } catch(e) {}
    }
</script>