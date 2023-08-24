<?php
 session_start();
 if (  (isset($_SESSION['is_login'])  && $_SESSION['is_login']) || ( isset($_COOKIE['is_login']) && $_COOKIE['is_login'])){

 }else {
    header("location: http://localhost/schoolproject/login.php") ;
 }

if(isset($_SESSION['is_login'])  && $_SESSION['is_login']){
    echo 'SESSION';
    $userid = $_SESSION['id'];
    $type = $_SESSION['type'];
    // echo "logined by session";

   
}
if( isset($_COOKIE['is_login']) && $_COOKIE['is_login']){
    echo 'COOKIE';
    $userid = $_COOKIE['id'] ;
    $type = $_COOKIE['type'] ;
    // echo "logined by cookie";
}


?>