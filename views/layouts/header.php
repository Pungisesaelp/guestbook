<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="">
<meta name="author" content="">
<!--  FOR BOOTSTRAP -->
<link rel="stylesheet"
	href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
<link rel="stylesheet"
	href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap-theme.min.css">
<script
	src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
<link rel="stylesheet"
	href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.4/css/bootstrap.min.css" />
<!-- JQUERY -->
<script
	src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
<!-- JQUERY -->

<title>Главная</title>

<script src='https://www.google.com/recaptcha/api.js'></script>

<link type="text/css" rel="stylesheet" href="css/simplePagination.css" />
</head>
<!--/head-->

<body>
	<script type="text/javascript">
            $(document).ready(function(){
            $('.spoiler-body').hide();
            $('.spoiler-title').click(function(){
                $(this).next().toggle()});
            });
</script>
	<nav class="navbar navbar-inverse">
		<div class="container-fluid">
			<div class="navbar-header">
				<a class="navbar-brand">Гостевая книга</a>
			</div>
			<ul class="nav navbar-nav">
				<li class="active"><a href="../message">Главная</a></li>
				<li><a href="../user/register">Регистрация</a></li>
				<li><a href="../cabinet">Кабинет</a></li>
				<li><a href="../about">О нас</a></li>  
				<li><a href="../user/login">Вход</a></li> 
		 <li><a href="../user/logout">Выход</a></li>  
			</ul>
		</div>
	</nav>