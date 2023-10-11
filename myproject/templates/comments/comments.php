<?php if (!empty($error)): ?>
    <div style="color: red;"><?= $error ?></div>
<?php endif; ?>
<b>Добавить комментарий:</b><br>
<br>
<form action="/articles/<?= $articles->getId()?>/addComments" method="post">
    <label for="text">Текст комментария</label><br>
    <textarea name="text" id="text" cols="60"><?= $_POST['text'] ?? '' ?></textarea><br>
    <br>
    <input type="submit" value="Отправить">
</form>
