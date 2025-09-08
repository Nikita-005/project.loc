<?php
if(empty($_GET['q'])):?>
<h1>Поиск по сайту</h1>
<form>
    <label>Введите запрос: <input type="text" name="q"></label><br>
    <input type="submit">
</form>
<?php else: ?>

<h1>Результаты поиска</h1>
<p>По запросу: <?= $_GET['q'] ?></?p>
<?php if(empty($products)): ?>
        <p>Ничего не найдено</p>
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
<?php endif ?>
