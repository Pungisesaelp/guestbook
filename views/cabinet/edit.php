<?php include ROOT . '/views/layouts/header.php'; ?>

<section> 
    <?php if ($result): ?>
                   <div class="text-center">
		<h2>Данные отредактированы!</h2>
	</div>
                <?php else: ?>
                    <?php if (isset($errors) && is_array($errors)): ?>
                        <ul>
                            <?php foreach ($errors as $error): ?>
                                <li> - <?php echo $error; ?></li>
                            <?php endforeach; ?>
                        </ul>
                    <?php endif; ?> 
				<!--/sign up form-->


	<div class="container">
		<div class="row">
			<form action="#" method="post">
				<div class="col-md-8 col-md-offset-2">
					<legend class="text-center">Изменить</legend>
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

						<div class="form-group col-md-12">
							<label for="last_name">Пароль</label> <input type="text"
								class="form-control" name="password"
								value="<?php echo $password?>" id="" placeholder="Техник">
						</div>

					</fieldset>
					<div class="form-group">
						<div class="text-center">
							<div class="col-md-12">
								<input type="submit" name="submit" class="btn btn-primary"
									value="Изменить">
							</div>
						</div>
					</div>
				</div>
		
		</div>
	</div>
	</form>
		  <?php endif; ?> 
</section>

<?php include ROOT . '/views/layouts/footer.php'; ?>