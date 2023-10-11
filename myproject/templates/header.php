<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title><?= $title ?? 'Мой блог'; ?> </title>
    <link rel="stylesheet" href="/styles.css">
</head>
<body>

<table class="layout">
    <tr>
        <td colspan="2" class="header">
            Мой блог
        </td>
    </tr>
    <tr>
        <td colspan="2" style="text-align: right">
        <?php if (!empty($user)): ?>
            Привет, <?= $user->getNickname() ?> | <a href="/users/logout">Выйти</a> <br>
            <a href="/admin/lastArticle">Админ панель</a>
            <a href="/upload/upload">Загрузить аватар</a>
        <?php else: ?> <a href="/users/login">Войдите на сайт</a> | <a href="/users/register">  Зарегистрироваться</a>
        <?php endif ?>
        </td>

    </tr>
    <tr>
        <td>


