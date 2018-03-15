
<?php include ROOT . '/views/layouts/header.php'; ?> 

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
<?php
 
if (!User::isGuest()) {
    ?>
<div class="text-center">
	<h1>Вы уже зарегистрированы</h1>
</div>
<?php
} else {
    ?>

<div class="container">
	<div class="row">

		<div class="col-md-8 col-md-offset-2">
			<form role="form" method="POST" action="#">

				<legend class="text-center">Регистрация</legend>

				<fieldset>
					<legend>Детали аккаунта</legend>

					<div class="form-group col-md-6">
						<label for="first_name">Имя</label> <input type="text"
							class="form-control" name="firstname" id="first_name"
							placeholder="Павел" value="<?php echo $firstname?>">
					</div>

					<div class="form-group col-md-6">
						<label for="last_name">Фамилия</label> <input type="text"
							class="form-control" name="lastname"
							value="<?php echo $lastname?>" id="" placeholder="Техник">
					</div>
					<div class="form-group col-md-12">
						<label for="last_name">Домашняя страница</label> <input
							type="text" class="form-control" name="homepage"
							value="<?php echo $homepage?>" id=""
							placeholder="https://vk.com/originalpashatechnique">
					</div>


					<div class="form-group col-md-12">
						<label for="">Имейл</label> <input type="email"
							class="form-control" name="email" id=""
							placeholder="2krpromo@gmail.com" value="<?php echo $email?>">
					</div>

					<div class="form-group col-md-6">
						<label for="password">Пароль</label> <input type="password"
							class="form-control" name="password"
							value="<?php echo $password?>" id="password"
							placeholder="pasha228">
					</div>

					<div class="form-group col-md-6">
						<label for="confirm_password">Повторите пароль</label> <input
							type="password" class="form-control" name="rpassword"
							id="confirm_password" placeholder="pasha228"
							value="<?php echo $rpassword?>">
					</div>


				</fieldset>


				<div class="form-group">
					<div class="col-md-12">
						<div class="checkbox">
							<label> <input type="checkbox" value="" id=""> Я согласен на
								обработку моих данных
							</label>
						</div>
					</div>
				</div>

				<div class="form-group">
					<div class="col-md-12">
						<button type="submit" name="signUp" class="btn btn-primary">
							Регистрация</button>
						<a href="../user/login">Уже зарегистрированы?</a>
					</div>
				</div>

			</form>
		</div>

	</div>
</div><?php };?>
<?php include ROOT . '/views/layouts/footer.php'; ?>
