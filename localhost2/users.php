<?php
require_once('unclude/connect.php');

$query = "SELECT COUNT(*) as count FROM users";
$result = mysqli_query($link, $query);
$sumid = mysqli_fetch_assoc($result); //получаем кол-во всех юзеров

$count = 30 + $sumid['count']; // начальный (id=30) в базе + кол-во юззеров = ограничитель для цикла

/* вывод всех юзеров кликабельным списком на их профиль */
for ($i = 30; $id <= $count; $id++) {

    $query = "SELECT * FROM users WHERE id ='$id'";
    $result = mysqli_query($link, $query);
    $user = mysqli_fetch_assoc($result);

?><a href="profile.php?id=<?= $id ?> "> <?= $user['name'] ?> </a><br>
<?php }; ?>