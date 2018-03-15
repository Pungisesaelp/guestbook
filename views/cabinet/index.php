<?php
use models\Picture; 
?> 
<?php include ROOT . '/views/layouts/header.php'; ?>

<?php if (User::isGuest()) {?>
<h1>Вам нужно ввойти</h1><?php }else{?>
<section>
	<h1>Кабинет пользователя</h1>
		<h4>Данные регистрации</h4>
	<table class="table">

		<tbody>
			<tr>
				<td><b>Имя<b></td>
				<td> <?php echo $user['firstname']?></td>
			</tr>
			<tr>
				<td><b>Фамилия<b></td>
				<td><?php echo $user['lastname']?></td>
			</tr>
			<tr>
				<td><b>Email<b></td>
				<td><?php echo $user['email']?></td>
			</tr>
			<tr>
				<td><b>Password<b></td>
				<td><?php echo $user['password']?></td>
			</tr>
			<tr>
				<td><b>Домашняя страница<b></td>
				<td><?php echo $user['homepage']?></td>
			</tr>
		</tbody>
	</table>
	<ul>
		<li><a href="/cabinet/edit">Редактировать данные регистрации</a></li>
	</ul> 
	
 Список сообщений <?php
    
 if (empty($messageList)) {
        echo "пуст";
    }
    ;
    ?>
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

<div class="text-center">
		<ul class="pagination">
       <?php echo $pagination->get();?>	
    </ul>
	</div>
</section>

<?php }?>
<?php include ROOT . '/views/layouts/footer.php'; ?>