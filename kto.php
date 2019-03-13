<?php
ob_start();
session_start();
require_once 'dbconnect.php';

if(isset($_SESSION['worker'])){
header("Location: headw.php");
}

if (isset($_SESSION['user'])) {
    header("Location: index.php");
    exit;
}

?>

<!DOCTYPE html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Hello </title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css" type="text/css"/>
    <link rel="stylesheet" href="assets/css/index.css" type="text/css"/>
	<style>
	body {
    background-image: url("ritter2.jpg");
    background-repeat: no-repeat;
    background-position: 50% -20%;
    margin-right: 200px;
}
#button1{
width: 300px;
height: 100px;

}
#button2{
width: 300px;
height: 100px;
}
#container{
    text-align: center;
  display: inline-block;
  position: absolute;
  top: 65%;
  left: 30%;
}
</style>
</head>

<nav class="navbar navbar-default navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar"
                    aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="index.php">HOME</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav navbar-right">

                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
                       aria-expanded="false">
                        <span
                            class="glyphicon glyphicon-user"></span>&nbsp;Niezalogowany
                        &nbsp;<span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="login.php?login"><span class="glyphicon glyphicon-log-in"></span>&nbsp;Zaloguj</a>
							<a href="logout.php?logout"><span class="glyphicon glyphicon-log-out"></span>&nbsp;Wyloguj</a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>
<div id="container">
	<font size="6"> Kim jestes?</font>
	<ul class="nav nav-pills">
		<li role="presentation" id="button1" class="active"><a href="login.php">KLIENTEM</a></li>
	    <li role="presentation" id="button2" class="active"><a href="loginw.php">PRACOWNIKIEM</a></li>
	</ul>
</div>
</body>