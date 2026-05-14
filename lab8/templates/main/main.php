<?php include __DIR__ . '/../header.php'; ?>
<?php foreach ($articles as $article): ?>
    <h2><?= $article['name'] ?></h2>
    <p><?= $article['text'] ?></p>
    <hr>
<?php endforeach; ?>
<?php include __DIR__ . '/../footer.php'; ?>


<!-- Переменная $articles создаётся функцией extract()
в классе View — она автоматически превращает массив в переменные. 
VS Code просто не видит этого и выдаёт предупреждение, но ошибки нет." -->