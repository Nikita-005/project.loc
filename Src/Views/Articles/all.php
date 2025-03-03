<a href="articles/add">Добавить статью</a>
<br>
<br>
<?php
foreach($articles as $article): ?>
    <h2><a href="articles/<?= $article->getId() ?>"><?= $article->getName() ?></a></h2>
    <p=><?= $article->getText() ?></p>
    <hr>
<?php endforeach;?>