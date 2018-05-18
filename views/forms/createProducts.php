
<form name="create" method="post" action="index.php?actions=products">
    <div class="form-group">
      	<label for="name">name</label>
        	<input class="form-control" id="name" type="text">
        <label for="brand">brand</label>
        	<input class="form-control" id="brand" type="text">
        <label for="description">description</label>
        	<textarea class="form-control" id="description" rows="3"></textarea>
        <label for="price">price</label>
        	<input class="form-control" id="price" type="text">
        <label for="publish">publish</label>
        	<input class="form-control" id="publish" type="text">
        <button type="submit" class="btn btn-secondary">Отменить</button>
        <button type="submit" class="btn btn-primary">Сохранить изменения</button>
    </div>
</form>