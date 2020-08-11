<?php
    session_start(); 
    header('Content-Type: text/html; charset=utf-8'); //utf-8 인코딩

    $db = new mysqli("localhost","root","qwer1234","test"); // host주소, id, pw, DB명
    $db->set_charset("utf8"); // DB문자열 인코딩 : utf-8

    function mq($sql) {  // DB에 쿼리 날릴때 mq 함수 사용함
        global $db; // global 변수 선언으로 외부에서 선언된 $sql을 함수내에서 쓸수 있도록 함
        return $db->query($sql);
    }
?>