      <h2 class="mt-5">Добавить новую статью</h2>
<div class="row mt-5">
    <div class="col">
        <form name="article" method="post" action="index.php?action=article">
        <div class="form-group">
            <label for="title">Название</label>
            <input type="text" name="title" class="form-control" id="title" aria-describedby="titleHelp" placeholder="Введите название..." value="<?=$_POST['title']?>">
            <small id="titleHelp" class="form-text text-muted">Вы должны указать название статьи размером не более 255 символов</small>
            <?php if(!empty($errors['title'])): ?>
            <span><?=$errors['title']?></span>
            <?php endif?>
        </div>
        <div class="form-group">
            <label for="content">Содержание</label>
            <textarea name="content" class="form-control" placeholder="Содержание..."><?=$_POST['content']?></textarea>
            <small id="titleHelp" class="form-text text-muted">
                Введите полный текст статьи
            </small>
            <?php if(!empty($errors['content'])): ?>
            <span><?=$errors['content']?></span>
            <?php endif?>
        </div>
        <button type="submit" class="btn btn-primary">Сохранить</button>
        <button type="button" class="btn btn-danger">Удалить</button>
        </form>
    </div>
</div>