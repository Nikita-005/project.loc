<h1>Добавление товара</h1>

<?php if (!empty($error)): ?>
    <div style="background-color: red"><?= $error ?></div>
<?php endif; ?>
<script>
    let allCategories = <?=  json_encode($categories); ?>;
</script>


<form action="" id="add_product"method="POST" enctype="multipart/form-data">
    <label class="form-label">Наименование товара <input type="text" name="title" value="<?= $_POST['title'] ?? '' ?>" size="50"></label><br>
    <label>Описание товара <textarea name="content" rows="10" cols="80"><?= $_POST['content'] ?? '' ?></textarea></label><br>
    <label>Цена <input type="text" name="price" value="<?= $_POST['price'] ?? '' ?>" size="20"></label><br>
    <label>Изображение <input type="file" name="image_file" value="<?= $_POST['image_file'] ?? '' ?>"></label><br>
    <label>Категория
    <select id="baseCat" name="category" value="<?= $_POST['category'] ?? '' ?>" size="1">
    <option value="0" >Выберите категорию</option>
    <?php
    $baseCategories = array_filter($categories, function($cat){
        return $cat->getParentId() == 0;
    });
    foreach($baseCategories as $category): ?>
        <option value="<?= $category->getId() ?>" <?= ($categoryId==$category->getId()) ? 'selected' : '' ?>><?= $category->getTitle() ?></option>
    <?php endforeach;?>
    </select></label><br>
    <div id="subcat"></div>
    <input type="submit" value="Добавить"><br>
</form>
<script src="script/addproduct.js"></script>