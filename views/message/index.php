
<?php include ROOT . '/views/layouts/header.php'; ?>
<a href="../user/login">Войти</a>
<a href="../user/register">Регистрация</a>
<form action="#" method="post">
	<p>
		Name: <input type="text" name="name" />
	</p>
	<p>
		Email: <input type="text" name="email" />
	</p>
	<p>Text:</p>
	<p>
		<textarea rows="10" cols="45" name="text"></textarea>
	</p>

	<div class="g-recaptcha"
		data-sitekey="6Lf2iDMUAAAAAKcNpF7PLUGk1CV7naXGID7W7NUO"></div>
	<input name="button" type="submit" value="Отправить" />

</form>

<hr></hr>
<?php foreach ($messageList as $messageItem):?>
<br>
Number of message: <?php echo $messageItem['id'] ;?></br>
<br>
Text: <?php echo $messageItem['text'] ;?><br>
<br>
Email: <?php echo $messageItem['email'] ;?></br>
<br>
Name: <?php echo $messageItem['name'] ;?></br>
<br>
Picture: <?php echo $messageItem['picture_path'] ;?></br>
<hr></hr>
<?php endforeach;?>
     <?php echo $pagination->get();?>	
	

<?php include ROOT . '/views/layouts/footer.php'; ?>
