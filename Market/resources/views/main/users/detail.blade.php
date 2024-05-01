@extends('layouts.main')
@section('title', 'Информация об авторе')
@section('page_title', 'Информация об авторе')
@section('page')
  <div class="author-page">
    <div class="container">
      <div class="row">
        <div class="col-lg-6">
          <div class="author">
            <img src="{{ asset($user->avatar_url) }}" alt="Изображение автора" style="border-radius: 50%; max-width: 170px;"/>
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
                  <img src="{{ asset($ad->photo_link) }}" alt="Изображение модели" style="border-radius: 20px;">
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
@endsection('page')