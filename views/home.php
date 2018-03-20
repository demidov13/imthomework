 <h1 class="mt-5">Домашняя страница</h1>
 <?php if(!empty($rticles)): ?>
 <?php foreach($articles as $article): ?>
    <h3><a href="/index.php?action=edit&id=<?=$article['id']?>"><?=$article['title']?></a></h3>
    <p><?=$article['content']?></p>
    <?php endforeach ?>
 <?php endif ?>
