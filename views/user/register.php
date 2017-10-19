
<?php include ROOT . '/views/layouts/header.php'; ?>
<h2>Регистрация на сайте</h2>

<?php if ($result): ?>
<p>Вы зарегистрированы!</p>
<?php else: ?>
                    <?php if (isset($errors) && is_array($errors)): ?>
<ul>
                            <?php foreach ($errors as $error): ?>
                                <li> - <?php echo $error; ?></li>
                            <?php endforeach; ?>
                        </ul>
<?php endif; ?>
<?php endif; ?>



<form action="#" method="post">
	<p>
		Логин<Br> <input type='text' name="login" cols="40" rows="3"
			value="<?php echo $login?>">
		</textarea>
	</p>
	<p>
		Пароль<Br> <input type='password' name="password" cols="40" rows="3"
			value="<?php echo $password?>">
		</textarea>
	</p>
	<p>
		Повторите пароль<Br> <input type='password' name="rpassword" cols="40"
			rows="3" value="<?php echo $rpassword?>">
		</textarea>
	</p>
	<p>
		E-mail<Br> <input type='text' name="email" cols="40" rows="3"
			value="<?php echo $email?>">
		</textarea>
	</p>
	<p>
		Домашняя страница<Br> <input type='text' name="homepage" cols="40"
			rows="3" value="<?php echo $homepage?>">
		</textarea>
	</p>
	<p>
		Имя <Br> <input type='text' name="firstname" cols="40" rows="3"
			value="<?php echo $firstname?>">
		</textarea>
	</p>
	<p>
		Фамилия<Br> <input type='text' name="lastname" cols="40" rows="3"
			value="<?php echo $lastname?>">
		</textarea>
	</p>



	<input type="submit" name="signUp" value="Зарегистрироваться">
</form>


<?php include ROOT . '/views/layouts/footer.php'; ?>
