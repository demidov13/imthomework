      <h2 class="mt-5">Добавить новую статью</h2>
<div class="row mt-5">
    <div class="col">
        <form>
        <div class="form-group">
            <label for="title">Название</label>
            <input type="email" class="form-control" id="title" aria-describedby="titleHelp" placeholder="Введите название...">
            <small id="titleHelp" class="form-text text-muted">Вы должны указать название статьи размером не более 255 символов</small>
        </div>
        <div class="form-group">
            <label for="content">Содержание</label>
            <textarea class="form-control" placeholder="Содержание..."></textarea>
            <small id="titleHelp" class="form-text text-muted">
                Введите полный текст статьи
            </small>
        </div>
        <button type="submit" class="btn btn-primary">Сохранить</button>
        <button type="button" class="btn btn-danger">Удалить</button>
        </form>
    </div>
</div>