 <h1 class="mt-5">Домашняя страница</h1>
 <?php if(file_exists('./data/users.json') && !empty($articles)): ?>
 <?php foreach($articles as $article): ?>
    <div class="col-md-8">
          <div class="card flex-md-row mb-4 box-shadow h-md-250">
            <div class="card-body d-flex flex-column align-items-start">
              <h3 class="mb-0">
                <a class="text-dark" href="/index.php?action=edit&id=<?=$article['id']?>"><?=$article['title']?></a>
              </h3>
              <p class="card-text mb-auto"><?=$article['content']?></p>
            </div>
            <img class="card-img-right flex-auto d-none d-md-block" 
            data-src="holder.js/200x250?theme=thumb" 
            alt="Thumbnail [200x250]" style="width: 200px; height: 250px;" 
            src="/upload/<?=$article['image']?>" data-holder-rendered="true">
          </div>
        </div>
    <?php endforeach ?>
 <?php endif?>
