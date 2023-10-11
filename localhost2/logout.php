<?php 
session_start();

$_SESSION['auth'] = null;

session_destroy();

header('Location:index.php');
