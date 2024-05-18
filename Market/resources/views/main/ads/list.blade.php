@extends('layouts.app')
@section('title', 'Модели')
@section('ads_active', 'active')
@section('content')
  <div class="page-heading">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <h6>С2С Market Экземпляр</h6>
          <h2>Модели уже на площадке</h2>
          <span>
            <a href="{{ route('main.index') }}">Главная</a> 
            <a href="{{ route('main.ads.list') }}">Модели</a>
          </span>
        </div>
      </div>
    </div>
    <div class="featured-explore">
      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-12">
            <div class="owl-features owl-carousel">
              @foreach ($main_ads as $ad)
                <div class="item">
                  <div class="thumb">
                    <img class="ads-list-model-img" src="{{ asset($ad->photo_link) }}" alt="Model image">
                    <div class="hover-effect">
                      <div class="content">
                        <h4>{{ $ad->title }}</h4>
                        <span class="author">
                          <img class="ads-list-user-avatar" src="{{ asset($ad->user->avatar_url) }}" alt="User avatar">
                          <h6>
                            Автор
                            <br>
                            <a href="{{ route('main.users.detail', ['user' => $ad->user]) }}">{{ $ad->user->name }}</a>
                          </h6>
                        </span>
                      </div>
                    </div>
                  </div>
                </div>
              @endforeach
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="discover-items">
    <div class="container">
      <div class="row">
        <div class="col-lg-5">
          <div class="section-heading">
            <div class="line-dec"></div>
            <h2>
              <em>Модели</em> 
              на нашем сайте
            </h2>
          </div>
        </div>
        <div class="col-lg-7"></div>
        @foreach ($ads as $ad)
          <div class="col-lg-3">
            <div class="item">
              <div class="row">
                <div class="col-lg-12">
                  <span class="author">
                    <img class="ads-list-user-avatar" src="{{ asset($ad->user->avatar_url) }}" alt="User avatar"/>
                  </span>
                  <img class="ads-list-model-img" src="{{ asset($ad->photo_link) }}" alt="Model image"/>
                  <h4>{{ $ad->title }}</h4>
                </div>
                <div class="col-lg-12">
                  <div class="line-dec"></div>
                  <div class="row">
                    <div class="col-6">
                      <span>
                        Цена 
                        <br> 
                        <strong>{{ $ad->price }}</strong>
                      </span>
                    </div>
                    <div class="col-6">
                      <span>
                        Рейтинг 
                        <br> 
                        <strong>
                          @if ($ad->get_average_rating() == "" || $ad->get_average_rating() == -1)
                            Нет
                          @else
                            {{ $ad->get_average_rating() }}
                          @endif
                        </strong>
                      </span>
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