      <h2 class="mt-5">Добавить новую статью</h2>
<div class="row mt-5">
    <div class="col">
        <form name="article" method="post" enctype="multipart/form-data" <?php if($_GET['action'] == 'edit'): ?> action="index.php?action=edit" <?php endif?> <?php if($_GET['action'] == 'article'): ?> action="index.php?action=article" <?php endif?>>
        <div class="form-group">
            <label for="title">Название</label>
            <input type="text" name="title" class="form-control" id="title" aria-describedby="titleHelp" placeholder="Введите название..." <?php if(empty($_POST) && $_GET['action'] == 'edit'): ?> value="<?=$article['title']?>" <?else:?> value="<?=$_POST['title']?>" <?endif?>>
            <small id="titleHelp" class="form-text text-muted">Вы должны указать название статьи размером не более 255 символов</small>
            <?php if(!empty($errors['title'])): ?>
            <span><?=$errors['title']?></span>
            <?php endif?>
        </div>
        <div class="form-group">
            <label for="content">Содержание</label>
            <textarea name="content" class="form-control" placeholder="Содержание..."><?php if(empty($_POST) && $_GET['action'] == 'edit'): ?><?=$article['content']?> <?else:?><?=$_POST['content']?><?endif?></textarea>
            <small id="titleHelp" class="form-text text-muted">
                Введите полный текст статьи
            </small>
            <?php if(!empty($errors['content'])): ?>
            <span><?=$errors['content']?></span>
            <?php endif?>
        </div>
        <div class="form-group">
        <input type="file" name="image" id="image">
            <?php if(!empty($errors['image'])): ?>
                <br><span><?=$errors['image']?></span>
            <?php endif?>
        </div>
            <input type="hidden" name="id" <?php if($_GET['action'] == 'edit'): ?> value="<?=$_GET['id']?>" <?php endif?> <?php if($_GET['action'] == 'article'): ?> value="" <?php endif?>>
        <button type="submit" class="btn btn-primary">Сохранить</button>
        <button type="button" class="btn btn-danger">Удалить</button>
        </form>
    </div>
</div>