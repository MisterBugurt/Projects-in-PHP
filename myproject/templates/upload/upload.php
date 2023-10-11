<?php include __DIR__ . '/../header.php'; ?>
    <form action="/upload/upload" method="post" enctype="multipart/form-data">
        <input type="file" name="attachment">
        <input type="submit">
    </form>
<?php include __DIR__ . '/../footer.php'; ?>