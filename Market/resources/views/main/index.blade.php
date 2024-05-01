@extends('layouts.app')
@section('title', 'Главная')
@section('index_active', 'active')
@section('content')
	<div class="main-banner">
		<div class="container">
			<div class="row">
				<div class="col-lg-6 align-self-center">
					<div class="header-text">
						<h6>С2С-площадка торговли 3D моделями</h6>
						<h2>Создавай, Продавай, Используй лучшие 3D модели</h2>
						<p>У нас представлен широкий выбор качественных и уникальных 3D моделей для различных целей: от дизайна интерьеров и архитектуры до создания игр и анимации. На нашей платформе вы сможете как продавать свои собственные 3D модели, так и приобретать работы других талантливых дизайнеров. Присоединяйтесь к нашему сообществу и воплотите в жизнь свои креативные идеи с помощью качественных 3D моделей от лучших специалистов!</p>
					</div>
				</div>
				<div class="col-lg-5 offset-lg-1">
					<div class="owl-banner owl-carousel">
						<div class="item">
							<img src="{{ asset('images/banner-01.png')}}" alt="">
						</div>
						<div class="item">
							<img src="{{ asset('images/banner-02.png')}}" alt="">
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="create-nft">
		<div class="container">
			<div class="row">
				<div class="col-lg-8">
					<div class="section-heading">
						<div class="line-dec"></div>
						<h2>Создавайте свои 3D модели и размещайте на площадке</h2>
					</div>
				</div>
				<div class="col-lg-4">
					<div class="main-button">
						<a href="create.html">Добавить модель</a>
					</div>
				</div>
				<div class="col-lg-4">
					<div class="item first-item">
						<div class="icon">
							<img src="{{ asset('images/icon-02-new.png')}}" alt="">
						</div>
						<h4>Зарегистрируйтесь</h4>
						<p>Зарегистрируйте новый профиль за пару минут на соответствующей <a href="">странице</a></p>
					</div>
				</div>
				<div class="col-lg-4">
					<div class="item second-item">
						<div class="icon">
							<img src="{{ asset('images/icon-04-new.png')}}" alt="">
						</div>
						<h4>Добавьте модель</h4>
						<p><a href="">Добавьте</a> модель на площадку, указав все характеристики и цену</p>
					</div>
				</div>
				<div class="col-lg-4">
					<div class="item">
						<div class="icon">
							<img src="{{ asset('images/icon-06-new2.png')}}" alt="">
						</div>
						<h4>Продавайте и покупайте</h4>
						<p>Ждите первой прибыли, либо покупайте модели других пользователей для своих проектов</p>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="currently-market">
		<div class="container">
			<div class="row">
				<div class="col-lg-6">
					<div class="section-heading">
						<div class="line-dec"></div>
						<h2><em>Модели</em> уже на площадке</h2>
					</div>
				</div>
			</div>
			@foreach ($ads as $ad)
				<div class="col-lg-12">
					<div class="row grid">
						<div class="col-lg-6 currently-market-item all msc">
							<div class="item">
								<div class="left-image">
									<img src="{{ $ad->photo_link }}" alt="" style="border-radius: 20px; min-width: 195px;">
								</div>
								<div class="right-content">
									<h4>{{ $ad->title }}</h4>
									<span class="author">
										<img src="{{ $ad->user->avatar_url }}" alt="" style="max-width: 50px; border-radius: 50%;">
										<h6>{{ $ad->author }}</h6>
									</span>
									<div class="line-dec"></div>
									<span class="bid">
										Цена<br><strong>{{ $ad->price }} Руб.</strong>
									</span>
									<!-- <span class="ends">
										Средняя оценка<br>
										<strong>{{  $ad->get_average_rating() == -1 ? "-": $ad->get_average_rating() }}</strong>
									</span> -->
									<div class="text-button">
										<a href="{{ route('main.ads.detail', ['ad' => $ad]) }}">Подробнее</a>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			@endforeach
		</div>
    </div>
@endsection('content')