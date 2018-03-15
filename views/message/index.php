<?php
use models\Picture;

?>

<?php include ROOT . '/views/layouts/header.php'; ?>
<div class="text-center">
	<h1>Список отзывов</h1>
</div>
<div class="container">
	<div class="row">
<?php foreach ($messageList as $messageItem):?> 
 <div class="col-sm-6 col-md-4">
			<div class="thumbnail">
				<div class="caption">
					<b class="spoiler-title"><h3 title="Нажмите, чтобы увидеть отзыв"><?php echo $messageItem['title'] ;?></h3></b>
					<div class="spoiler-body" style="display: block;">
						<p>  <?php echo $messageItem['text'] ;?></p>
						<img
							alt="<?php echo Picture::searсhFirstPicturePAthForMessageId($messageItem['id'])?>"
							class="img-thumbnail"
							src="../<?php echo Picture::searсhFirstPicturePAthForMessageId($messageItem['id'])?>">
						<div class="text-center">
							<a href="../gallery/<?php echo $messageItem['id']?>">
								<button type="button" class="btn btn-primary btn-xs">Посмотреть
									фото в полном размере (<?php echo Picture::getTotalPictureForMessage($messageItem['id'])?>)</button>
							</a>
						</div>
					</div>
					<br>
				</div>
			</div>
		</div> 
<?php endforeach;?>
</div>
</div>
<?php if ($userId) {?>
<div class="text-center">
	<a href="../createMessage">Создать отзыв</a>
</div>
<?php }?>
<div class="text-center">
	<ul class="pagination">
       <?php echo $pagination->get();?>	
    </ul>
</div>

<?php include ROOT . '/views/layouts/footer.php'; ?>
