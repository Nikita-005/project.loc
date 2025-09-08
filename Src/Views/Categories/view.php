<div class="breadcrumb">
    <ul class="breadcrumb-list">
        <li class="breadcrumb-item"><a href="catalog">Каталог</a></li>
            <?php if(isset($breadcrumbs)):
                    foreach($breadcrumbs as $breadcrumb): ?>
                        <li class="breadcrumb-item"><a href="categories/<?= $breadcrumb->getId() ?>"><?= $breadcrumb->getTitle() ?></a></li>
            <?php endforeach; endif?>
        <li class="breadcrumb-item"><?= $category->getTitle() ?></li>
    </ul>
</div>

<h1><?= $category->getTitle() ?></h1>
<?php
if(!empty($subCategories)): ?>
    <ul class="sub-categories-list">
    <?php
    foreach($subCategories as $subCategory): ?>
        <li class="categories-list__item categories-list-item ">
            <h2><a href="categories/<?= $subCategory->getId() ?>"><?= $subCategory->getTitle() ?></a></h2>
        </li>
    <?php endforeach;?>
</ul>
<?php endif?>

<?php
if(empty($products)): ?>
    <?php if(empty($subCategories)): ?>
        <p>Ничего не найдено</p>
        <?php endif ?>
<?php else: ?>
<ul class="products-list">
<?php foreach($products as $product): ?>
        <li class="products-list__item products-list-item ">
            <h2><a href="products/<?= $product->getId() ?>"><?= $product->getTitle() ?></a></h2>
            <img src="img/products/<?= $product->getImg() ?>" width="200px" alt="">
            <p><?= $product->getContent() ?></p>
        </li>
    <?php endforeach; ?>
</ul>
<?php endif; ?>
<br>
<?php
if(isset($user)):
    if($user->getRole() == 'admin'):
        if($category->getCatType() != 'subcat' ): ?>
            <p><a href="products/add?id=<?= $category->getID() ?>">Добавить товар</a></p>
        <?php endif;
        if($category->getCatType() != 'products' ): ?>
                <p><a href="categories/add?id=<?= $category->getID() ?>">Добавить подкатегорию</a></p>
        <?php endif; ?>
    <?php endif; ?>
<?php endif; ?>


