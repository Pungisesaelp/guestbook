<?php include ROOT . '/views/layouts/header.php'; ?>
<div class="container">
	<div class="text-center">
		<h1>Фотографии к отзыву</h1>
	</div>
<?php foreach ($pictureList as $pictureItem):?>
<ul class="thumbnails">
		<li class="span4">
			<div class="thumbnail">
				<img src="../<?php echo $pictureItem['path']?>">
			</div>
		</li>
	</ul>
</div>
<?php endforeach;?>
<?php include ROOT . '/views/layouts/footer.php'; ?>