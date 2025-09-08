<h1>Категории</h1>
<?php
if(isset($user))
if($user->getRole() == 'admin'): ?>
<a href="categories/add">Добавить категорию</a>
<?php endif; ?>
<ul class="categories-list">
<?php
foreach($categories as $category): ?>
    <li class="categories-list__item categories-list-item ">
        <h2><a href="categories/<?= $category->getId() ?>"><?= $category->getTitle() ?></a></h2>
    </li>
<?php endforeach;?>
</ul>