<?php
require_once('err.php');

$dbh = new PDO('mysql:dbname=mydb;host=localhost', 'root', 'root');
$sth = $dbh->prepare("SELECT * FROM `country` ORDER BY `country_ru`");
$sth->execute();
$list = $sth->fetchAll(PDO::FETCH_ASSOC);

?>

<form action="" method="post">
    <input name="login" value="<?= $_POST['login'] ?>"> <?= $err['login'] ?>
    <input name="password" type="password" value="Пароль"> <?= $err['pass'] ?>
    <input name="confirm" type="password" value="Пароль">
    <input name="name" value="Имя">
    <input name="lastname" value="Отчество">
    <input name="surname" value="Фамилия">
    <input name="email" value="Почта">
    <select name="country" class="form-control">
        <?php foreach ($list as $row) : ?>
            <option value="<?php echo $row['iso']; ?>"><?php echo $row['emoji'] . ' ' . $row['country_ru']; ?></option>
        <?php endforeach; ?>
    </select>
    <button type="submit">Отправить</button>
    <a href="login.php">Назад</a>
</form>