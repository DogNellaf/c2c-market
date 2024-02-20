<!DOCTYPE html>
<html lang="ru">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

		<title>@yield('title')</title>

		<link rel="stylesheet" href="{{ asset('bootstrap/css/bootstrap.min.css') }}">
		<link rel="stylesheet" href="{{ asset('css/fontawesome.css') }}">
		<link rel="stylesheet" href="{{ asset('css/templatemo-liberty-market.css') }}">
		<link rel="stylesheet" href="{{ asset('css/owl.css') }}">
		<link rel="stylesheet" href="{{ asset('css/animate.css') }}">
		<link rel="stylesheet" href="{{ asset('css/roboto.css') }}">
		<link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css"/>
	</head>
	<body>
		<div id="js-preloader" class="js-preloader">
			<div class="preloader-inner">
				<span class="dot"></span>
				<div class="dots">
					<span></span>
					<span></span>
					<span></span>
				</div>
			</div>
		</div>
		<header class="header-area header-sticky">
			<div class="container">
				<div class="row">
					<div class="col-12">
						<nav class="main-nav">
							<a href="index.html" class="logo">
								<img src="{{ asset('images/logo.png') }}" alt="">
							</a>
							<ul class="nav">
								<li><a href="{{ route('index') }}" class="active">Главная</a></li>
								<li><a href="">Модели</a></li>
								<li><a href="{{ route('admin') }}">Панель администратора</a></li>
								<li><a href="">Личный кабинет</a></li>
							</ul>   
							<a class='menu-trigger'>
								<span>Меню</span>
							</a>
						</nav>
					</div>
				</div>
			</div>
		</header>
  
		@yield('content')
  
		<footer>
			<div class="container">
				<div class="row">
					<div class="col-lg-12">
						<p>Copyright © 2024 Петунин Иван Евгеньевич
					</div>
				</div>
			</div>
		</footer>
		<script src="{{ asset('jquery/jquery.min.js') }}"></script>
		<script src="{{ asset('bootstrap/js/bootstrap.min.js') }}"></script>
		<script src="{{ asset('js/isotope.min.js') }}"></script>
		<script src="{{ asset('js/owl-carousel.js') }}"></script>
		<script src="{{ asset('js/tabs.js') }}"></script>
		<script src="{{ asset('js/popup.js') }}"></script>
		<script src="{{ asset('js/custom.js') }}"></script>
	</body>
</html>