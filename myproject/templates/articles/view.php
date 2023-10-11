<?php include __DIR__ . '/../header.php'; ?>

<h1><?= $articles->getName() ?></h1>
<p><?= $articles->getParsedText() ?></p>
<p>Автор: <?= $articles->getAuthor()->GetNickname() ?></p>
<?php if ($user !== null && $user->isAdmin()): ?>
    <small><a href="/articles/<?= $articles->getId() ?>/edit">Редактировать</a></small><br>
<?php endif; ?>

<b>Комментарии:</b><br>
<?php foreach ($comment as $value) { ?>
    <img src="http://myproject/templates/upload/<?= $value->getAvatarPath() ?>" height="25px">
    <?= $value->getNickName() . ': ' . $value->getText() . ' ' . $value->getCreatedAt() . "<br>";
    if ($user->getNickname() === $value->getNickName()): ?>
        <small><a href="/comments/<?= $value->getId() ?>/edit">Изменить</a></small>
    <?php endif ?>
<?php } ?>
<?php include __DIR__ . '/../footer.php'; ?>
<?php if ($user !== null) { ?>
    <?php include __DIR__ . '/../comments/comments.php';
} ?>

