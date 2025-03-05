<h1>Категории</h1>
<ul class="categories-list">
<?php
foreach($categories as $category): ?>
    <li class="categories-list__item categories-list-item ">
        <h2><a href="categories/<?= $category->getId() ?>"><?= $category->getTitle() ?></a></h2>
    </li>
<?php endforeach;?>
</ul>