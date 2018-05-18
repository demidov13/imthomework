</br>
<table class="table table-bordered table-hover">
  <thead>
    <tr style="background-color: #e3f2fd">
      <th scope="col">id</th>
      <th scope="col">name</th>
      <th scope="col">articul</th>
      <th scope="col">brand</th>
      <th scope="col">description</th>
      <th scope="col">price</th>
      <th scope="col">category_id</th>
      <th scope="col">created_at</th>
      <th scope="col">updated_at</th>
      <th scope="col">publish</th>
      <th scope="col">image_path</th>
      <th scope="col">Опции</th>
    </tr>
  </thead>
  <tbody>
<?php foreach ($arrProducts as $product): ?>
    <tr class="table-light">
      <th scope="row"><?=$product['id']?></th>
      <td><?=$product['name']?></td>
      <td><?=$product['articul']?></td>
      <td><?=$product['brand']?></td>
      <td><?=$product['description']?></td>
      <td><?=$product['price']?></td>
      <td><?=$product['category_id']?></td>
      <td><?=$product['created_at']?></td>
      <td><?=$product['updated_at']?></td>
      <td><?=$product['publish']?></td>
      <td><img src="<?=$product['image_path']?>" width="200" height="200" alt="image_path"></td>
      <td><form name="options" method="post" action="index.php?actions=products">
      	<input type="hidden" name="id" value="<?=$product['id']?>">
      	<button type="submit" name="update" class="btn btn-info" style="margin-top: 50px"><i class="fas fa-pencil-alt"></i></button>
      	<button type="submit" name="delete" class="btn btn-danger" style="margin-top: 15px"><i class="far fa-times-circle"></i></button>
      </form></td>
    </tr>
    <? endforeach; ?>
  </tbody>
</table>