<?php include __DIR__ . '/../header.php'; ?>
<h1>Админка:</h1>
<?php foreach ($articles as $article): ?>
    <h2><a href="/articles/<?= $article->getId() ?>"><?= $article->getName() ?></a></h2>
    <small><a href="/articles/<?= $article->getId() ?>/edit">Редактировать</a></small>
<?php endforeach; ?>
<?php foreach ($comment as $value) {
    echo '<br>' . $value->getNickName() . ': ' . $value->getText() . "<br>"; ?>
    <small><a href="/comments/<?= $value->getId() ?>/edit">Изменить</a></small>
<?php } ?>
<?php include __DIR__ . '/../footer.php'; ?>
