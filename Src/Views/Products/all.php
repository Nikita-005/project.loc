<h1>Товары</h1>
<ul class="products-list">
<?php
foreach($products as $product): ?>
    <li class="products-list__item products-list-item ">
        <h2><a href="products/<?= $product->getId() ?>"><?= $product->getTitle() ?></a></h2>
        <img src="img/products/<?= $product->getImg() ?>" width="200px" alt="">
        <p><?= $product->getContent() ?></p>
    </li>
<?php endforeach;?>
</ul>

