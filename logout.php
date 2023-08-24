<?php
session_start();
if(isset($_SESSION['is_login'])  && $_SESSION['is_login']){
    session_unset();
    session_destroy();
    // echo 'SESSION';
    header("location: http://localhost/schoolproject/login.php") ;
}
if( isset($_COOKIE['is_login']) && $_COOKIE['is_login']){
    setcookie('is_login' , false , 0 );
    setcookie('type' , false , 0 );
    // echo 'COOKIE' ;
    header("location: http://localhost/schoolproject/login.php") ;
}

?>