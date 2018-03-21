 <h1 class="mt-5">Домашняя страница</h1>
 <?php if(file_exists('./data/users.json') && !empty($articles)): ?>
 <?php foreach($articles as $article): ?>
    <h3><a href="/index.php?action=edit&id=<?=$article['id']?>"><?=$article['title']?></a></h3>
    <p><?=$article['content']?></p>
    <?php endforeach ?>
 <?php endif?>
