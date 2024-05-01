@extends('layouts.main')
@section('title', 'Информация о модели')
@section('page_title', 'Информация о модели')
@section('page')
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
            <img src="{{ asset($ad->photo_link) }}" alt="Изображение модели" style="border-radius: 20px;"/>
          </div>
        </div>
        <div class="col-lg-5 align-self-center">
        	<h4>{{ $ad->title }}</h4>
          <span class="author">
            <img src="{{ asset($ad->user->avatar_url) }}" alt="Изображение автора" style="max-width: 50px; border-radius: 50%;"/>
            <h6>
              <a href="{{ route('main.users.detail', ['user' => $ad->user]) }}">{{ $ad->user->name }}</a>
            </h6>
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
            <a href="{{ route('main.ads.buy', ['ad' => $ad]) }}" class="main-button">Купить</a>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection('page')