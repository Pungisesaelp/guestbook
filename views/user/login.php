<html>
<head></head>
<body>
	<h1>Вход</h1>
	  

                <?php if (isset($errors) && is_array($errors)): ?>
                    <ul>
                        <?php foreach ($errors as $error): ?>
                            <li> - <?php echo $error; ?></li>
                        <?php endforeach; ?>
                    </ul>
                <?php endif; ?>
	
	<form action="#" method="POST">
		<p>
			Логин<Br> <input type='text' name="login" cols="40" rows="3">
			</textarea>
		</p>
		<p>
			Пароль<Br> <input type='password' name="password" cols="40" rows="3">
			</textarea>
		</p>

		<input type="submit" name="logIn" value="Войти">
	</form>
</body>

</html>