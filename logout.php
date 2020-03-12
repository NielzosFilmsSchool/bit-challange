<?php
if(isset($_COOKIE["logged_in"])){
    unset($_COOKIE["logged_in"]);
    setcookie('logged_in', null, -1, '/'); 
}
header("Location: index.php");
?>