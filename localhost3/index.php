<meta charset="utf-8">
<link href="scc.css" rel="stylesheet">

<?php
error_reporting(E_ALL);
ini_set('display_errors', 'on');
require_once 'connect.php';

$url = $_SERVER['REQUEST_URI'];
preg_match('#([a-z0-9_-]+)#', $url, $match);
$slug = $match[1];

$qeury  = "SELECT * FROM pages WHERE slug='$slug'";
$result = mysqli_query($link, $qeury) or die(mysqli_error($link));
$page = mysqli_fetch_assoc($result);
//$path = 'view' . $url . '.php';
$layout  = file_get_contents('layout.php');
$layout = str_replace(
	'{{ title }}',
	$page['title'],
	$layout
);
$layout = str_replace(
	'{{ content }}',
	$page['content'],
	$layout
);

/*определяем некорректность запроса*/
//if (file_exists($path)) {
/* получаем контент*/
$content = file_get_contents('view' . $url . '.php');

/*в тексте контента удалим не нужную больше команду*/
$content2 = preg_replace('#{{ title: "(.+?)" }}#', '', $content);

/* всталяем отредактированный контент*/
$layout = str_replace('{{ content }}', $content2, $layout);

/*получим тайтл из текста контента и записываем в переменную $title:*/
preg_match(
	'#{{ title: "(.+?)" }}#',
	$content,
	$match
);
$title = $match[1];

/* всталяем тайтл*/
$layout = str_replace('{{ title }}', $title, $layout);
//} else {
header("HTTP/1.1 404 Not Found");

$content = file_get_contents('view/404.php');
$layout = str_replace('{{ content }}', $content, $layout);
//}
echo $layout;
