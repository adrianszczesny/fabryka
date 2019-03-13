<?php
session_start();

if (isset($_SESSION['user'])) {
    unset($_SESSION['user']);
    header("Location: index.php");
    exit;
}
if(isset($_SESSION['worker'])){
	unset($_SESSION['worker']);
    header("Location: index.php");
    exit;
}
