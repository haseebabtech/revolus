<?php
    session_start();
    $_SESSION['language'] = $_POST['language'];
    print_r($_SESSION['language']);
    die();
?>