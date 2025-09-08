<h1>Создание новой категории</h1>

<?php if (!empty($error)): ?>
    <div style="background-color: red"><?= $error ?></div>
<?php endif; ?>

<form action="" method="POST">
    <label>Название категории <input type="text" name="title" value="<?= $_POST['title'] ?? '' ?>" size="50"></label><br>
    <label>Description <textarea name="description" rows="10" cols="80"><?= $_POST['description'] ?? '' ?></textarea></label><br>
    <label>Категория
    <select name="category" value="<?= $_POST['category'] ?? '' ?>" size="1">
        <option value="0">Каталог</option>
    <?php
    foreach($categories as $category): ?>
        <option value="<?= $category->getId() ?>" <?= ($parentId==$category->getId()) ? 'selected' : '' ?>  ><?= $category->getTitle() ?></option>
    <?php endforeach;?>
    </select></label><br>
    <input type="submit" value="Создать">
</form>