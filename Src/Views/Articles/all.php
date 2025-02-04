<?php
foreach($articles as $article): ?>
    <h2><a href="/project.loc/articles/<?= $article->getId() ?>"><?= $article->getName() ?></a></h2>
    <p=><?= $article->getText() ?></p>
    <hr>
<?php endforeach;?>