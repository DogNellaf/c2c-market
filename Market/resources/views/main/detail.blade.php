@extends('layouts.app')
@section('title', 'Информация о модели')
@section('content')
  <div class="page-heading normal-space">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <h6>Экземпляр C2C-Market</h6>
          <h2>Информация о модели {{ $ad->title }}</h2>
          <span><a href="{{ route('main.index') }}">Главная</a> > Информация о модели</span>
          <div class="buttons">
            <div class="main-button">
              <a href="{{ route('main.ads.list') }}">Посмотреть модели</a>
            </div>
            <div class="border-button">
              <a href="{{ route('home.ads.create.page') }}">Добавьте свою модель</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="item-details-page">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <div class="section-heading">
            <div class="line-dec"></div>
            <h2>Информация о модели <em>{{ $ad->title }}</em></h2>
          </div>
        </div>
        <div class="col-lg-7">
          <div class="left-image">
            <img src="{{ asset($ad->photo_link)}}" alt="" style="border-radius: 20px;">
          </div>
        </div>
        <div class="col-lg-5 align-self-center">
        	<h4>{{ $ad->title }}</h4>
          	<span class="author">
            <img src="{{ asset($ad->user->avatar_url) }}" alt="" style="max-width: 50px; border-radius: 50%;">
            <h6><a href="#">{{ $ad->user->name }}</a></h6>
          </span>
          <p>{{ $ad->description }}</p>
          <div class="row">
            <div class="col">
              <span class="bid">
                Цена<br><strong>{{ $ad->price }} рублей</strong>
              </span>
            </div>
          </div>
		  	<div class="main-button">
		  		<a href="{{ route('main.ads.buy', ['ad' => $ad]) }}" class="	main-button">Купить</a>
        	</div>
        </div>
      </div>
    </div>
  </div>
@endsection('content')