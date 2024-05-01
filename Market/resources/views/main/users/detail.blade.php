@extends('layouts.app')
@section('title', 'Информация о модели')
@section('content')
  <div class="page-heading normal-space">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <h2>Информация об авторе</h2>
          <span><a href="{{ route('main.index') }}">Home</a> > Автор</span>
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
  <div class="author-page">
    <div class="container">
      <div class="row">
        <div class="col-lg-6">
          <div class="author">
            <img src="{{ asset($user->avatar_url) }}" alt="" style="border-radius: 50%; max-width: 170px;">
            <h4>{{ $user->name }}</h4>
          </div>
        </div>
        <div class="col-lg-12">
          <div class="section-heading">
            <div class="line-dec"></div>
            <h2><em>Модели</em> автора</h2>
          </div>
        </div>
        @foreach ($user->ads as $ad)
          <div class="col-lg-3 col-md-6">
            <div class="item">
              <div class="row">
                <div class="col-lg-12">
                  <img src="{{ asset($ad->photo_link) }}" alt="" style="border-radius: 20px;">
                  <h4>{{ $ad->title }}</h4>
                </div>
                <div class="col-lg-12">
                  <div class="line-dec"></div>
                  <div class="row">
                    <div class="col">
                      <span>Цена: <br> <strong>{{ $ad->price }}</strong></span>
                    </div>
                  </div>
                </div>
                <div class="col-lg-12">
                  <div class="main-button">
                    <a href="{{ route('main.ads.detail', ['ad' => $ad]) }}">Подробнее</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        @endforeach
      </div>
    </div>
  </div>
@endsection('content')