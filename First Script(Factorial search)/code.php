<div style="font-size: 100px; margin-top:35%; text-align: center; font-family: sans-serif">

<?php

// Скрит для поиска факториала числа

$num = 3; // Задаём число
	
$arr = [];
$Factorial = 1;

for($i = $num; $i < $num+1 and $i > 0; $i--) {
	$arr[] = $i;
}
foreach($arr as $j) {
	$Factorial *= $j; 
}

echo $Factorial; // Вывод результата

?>

</div>
