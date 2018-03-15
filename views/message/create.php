<?php include ROOT . '/views/layouts/header.php'; ?>
<div class="container">
	<div class="row">
		<form action="#" method="post" enctype="multipart/form-data">
			<div class="col-md-8 col-md-offset-2">
				<legend class="text-center">Написать отзыв</legend>
				<fieldset>
					<div class="form-group col-md-12">
						<label for="first_name">Тема:</label> <input type="text"
							class="form-control" name="title" id="first_name"
							placeholder="Тема" value="<?php echo $title?>">
					</div> 
					<div class="form-group">
						<label for="comment">Отзыв:</label>
						<textarea class="form-control" rows="5" id="comment" name="text"
							value="<?php echo $text?>";></textarea>
					</div>
				</fieldset>
				<div class="form-group">
					<div class="text-center">
						<div class="col-md-12">
							<input type="submit" name="submit" class="btn btn-primary"
								value="Отправить"> 
								
						<p>Изображения:
                        <input type="file" name="pictures[]" />
                        <input type="file" name="pictures[]" />
                        <input type="file" name="pictures[]" />

						</div>
					</div>
				</div>
			</div>
		</form>
	</div>
</div>
<?php include ROOT . '/views/layouts/footer.php'; ?>
