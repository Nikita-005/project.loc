<div class="products-breadcrumb">
    <ul class="breadcrumb-list">
        <li class="breadcrumb-item"><a href="catalog">Каталог</a></li>
            <?php foreach($breadcrumbs as $breadcrumb): ?>
                <li class="breadcrumb-item"><a href="categories/<?= $breadcrumb->getId() ?>"><?= $breadcrumb->getTitle() ?></a></li>
            <?php endforeach?>
        <li class="breadcrumb-item"><?= $product->getTitle() ?></li>
    </ul>
</div>
<h1><?= $product->getTitle() ?></h1>
<img src="img/products/<?= $product->getImg() ?>" width="500px" alt="">
<p><?= $product->getContent() ?></p>
