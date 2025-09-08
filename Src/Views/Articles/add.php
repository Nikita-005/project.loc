<h1>Создание новой статьи</h1>

<?php if (!empty($error)): ?>
    <div style="background-color: red"><?= $error ?></div>
<?php endif; ?>

<form action="articles/add" method="POST">
    <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">
    <label>Название статьи <input type="text" name="name" value="<?= $_POST['name'] ?? '' ?>" size="50"></label><br>
    <label>Текст статьи <textarea name="text" rows="10" cols="80"><?= $_POST['text'] ?? '' ?></textarea></label><br>
    <input type="submit" value="Создать">
</form>