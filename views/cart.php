<?php if(!empty($_SESSION['cart'])): ?>
<h2 class="mt-5">Ваш заказ</h2>
<ul class="list-group list-group-flush">
<?php foreach($_SESSION['cart'] as $item): ?>
    <li class="list-group-item"><?=$item['title']; ?> цена: <?=$item['price']; ?>грн.</li>
    <?php $totalPrice += $item['price']; ?>
    <?php endforeach ?>
</ul>
<h5 class="mt-2">Итого к оплате: <?=$totalPrice ?>грн.</h5>
<form name="cart" method="post" action="index.php?action=cart">
<input type="hidden" name="total" value="<?=$totalPrice ?>">
<button type="button" name="pay" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">Оплатить заказ</button>
<button type="submit" name="delete" class="btn btn-danger">Удалить заказ</button>
</form>
<?php endif?>


<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Как нибудь в другой раз ;)</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>