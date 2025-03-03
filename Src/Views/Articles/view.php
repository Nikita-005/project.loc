<a href="articles/all">Все статьи</a>
<h1><?= $article->getName() ?></h1>
<p><?= $article->getText() ?></p>
<p>Автор: <?= $article->getAuthor()->getNickName() ?></p>
<a href="articles/<?= $article->getId() ?>/edit">Редактировать</a>
<a href="articles/<?= $article->getId() ?>/delete">Удалить</a>