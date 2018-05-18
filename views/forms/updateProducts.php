
<div class="container" style="padding: 20px; margin: 20px; border: 1px solid #e3f2fd;">
<form name="update" method="post" action="index.php?actions=products">
    <div class="form-group">
      	<label for="name">name</label>
        	<input class="form-control" id="name" type="text" name="name" value="<?=$updateProduct['name']?>">
    </div>
    <div class="form-group"> 	
        <label for="articul">articul</label>
        <input class="form-control" id="articul" type="text" name="articul" value="<?=$updateProduct['articul']?>">
    </div>
    <div class="form-group">     	
        <label for="brand">brand</label>
        <input class="form-control" id="brand" type="text" name="brand" value="<?=$updateProduct['brand']?>">
    </div>
    <div class="form-group">
        <label for="description">description</label>
        <textarea class="form-control" id="description" name="description" rows="3"><?=$updateProduct['description']?></textarea>
    </div>
    <div class="form-group">
        <label for="price">price</label>
        <input class="form-control" id="price" type="text" name="price" value="<?=$updateProduct['price']?>">
    </div>
    <div class="form-group">
        <label for="publish">publish</label>
        <input class="form-control" id="publish" type="text" name="publish" value="<?=$updateProduct['publish']?>">
    </div>
    <div class="form-group">
        <label for="image_path">image_path</label>
        <input class="form-control" id="image_path" type="text" name="image_path" value="<?=$updateProduct['image_path']?>">
    </div>
    	<input type="hidden" name="id" value="<?=$updateProduct['id']?>">
    	<input type="hidden" name="category_id" value="<?=$updateProduct['category_id']?>">
    	<input type="hidden" name="created_at" value="<?=$updateProduct['created_at']?>">
    	<input type="hidden" name="updated_at" value="<?=$updateProduct['updated_at']?>">
        <button type="submit" name="updateCancel" class="btn btn-secondary">Отменить</button>
        <button type="submit" name="updateComplete" class="btn btn-primary">Сохранить изменения</button>
    </div>
</form>
</div>