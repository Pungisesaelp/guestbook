 
<?php include ROOT . '/views/layouts/header.php'; ?>
<?php if (isset($errors) && is_array($errors)): ?>
<ul>
                        <?php foreach ($errors as $error): ?>
                            <li> - <?php echo $error; ?></li>
                        <?php endforeach; ?>
                    </ul>
<?php endif; ?>
<div class="container">
	<div class="row">

		<div class="col-md-8 col-md-offset-2">
			<form role="form" method="POST" action="#">
				<legend class="text-center">Вход</legend>
				<fieldset>
					<div class="form-group col-md-12">
						<label for="">Имейл</label> <input type="email"
							class="form-control" name="email" id=""
							placeholder="2krpromo@gmail.com" value="<?php echo $email?>">
					</div>

					<div class="form-group col-md-12">
						<label for="password">Пароль</label> <input type="password"
							class="form-control" name="password"
							value="<?php echo $password?>" id="password" placeholder="******">
					</div>

				</fieldset>
				<div class="form-group">
					<div class="col-md-12">
						<button type="submit" name="logIn" class="btn btn-primary">
							Ввойти</button>

					</div>
				</div>

			</form>
		</div>

	</div>
</div>
<?php include ROOT . '/views/layouts/footer.php'; ?>