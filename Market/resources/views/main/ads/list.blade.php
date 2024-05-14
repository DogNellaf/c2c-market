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
            <a href="{{ route('main.index') }}">Главная</a> > 
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
                    <img src="{{ asset($ad->photo_link) }}" alt="" style="border-radius: 20px;">
                    <div class="hover-effect">
                      <div class="content">
                        <h4>{{ $ad->title }}</h4>
                        <span class="author">
                          <img src="{{ asset($ad->user->avatar_url) }}" alt="" style="max-width: 50px; max-height: 50px; border-radius: 50%;">
                          <h6>Автор<br><a href="{{ route('main.users.detail', ['user' => $ad->user]) }}">{{ $ad->user->name }}</a></h6>
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
            <h2><em>Модели</em> на нашем сайте</h2>
          </div>
        </div>
        <div class="col-lg-7">

        </div>
        @foreach ($ads as $ad)
          <div class="col-lg-3">
            <div class="item">
              <div class="row">
                <div class="col-lg-12">
                  <span class="author">
                    <img src="{{ asset($ad->user->avatar_url) }}" alt="" style="width: 50px; height: 50px; border-radius: 50%;">
                  </span>
                  <img src="{{ asset($ad->photo_link) }}" alt="" style="border-radius: 20px;">
                  <h4>{{ $ad->title }}</h4>
                </div>
                <div class="col-lg-12">
                  <div class="line-dec"></div>
                  <div class="row">
                    <div class="col-6">
                      <span>Цена <br> <strong>{{ $ad->price }}</strong></span>
                    </div>
                    <div class="col-6">
                      <span>Средняя оценка: <br> <strong>{{ $ad->get_average_rating() }}</strong></span>
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
  
  <!-- <div class="top-seller">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <div class="section-heading">
            <div class="line-dec"></div>
            <h2>Лучшие продавцы на этой неделе</h2>
          </div>
        </div>
        <div class="col-lg-4 col-sm-6">
          <div class="row">
            <div class="col-lg-12">
              <div class="item">
                <h4>1.</h4>
                <img src="{{ asset('images/author.jpg') }}" alt="" style="max-width: 50px; max-height: 50px; border-radius: 50%;">
                <h6>NFT Top Artist<br><a href="#">8.6 ETH or $12,000</a></h6>
              </div>
            </div>
            <div class="col-lg-12">
              <div class="item">
                <h4>2.</h4>
                <img src="{{ asset('images/author-02.jpg') }}" alt="" style="max-width: 50px; max-height: 50px; border-radius: 50%;">
                <h6>George Brandon<br><a href="#">4.8 ETH or $14,000</a></h6>
              </div>
            </div>
            <div class="col-lg-12">
              <div class="item">
                <h4>3.</h4>
                <img src="{{ asset('images/author-03.jpg') }}" alt="" style="max-width: 50px; max-height: 50px; border-radius: 50%;">
                <h6>Johnny Mayson<br><a href="#">6.2 ETH or $26,000</a></h6>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-4 col-sm-6">
          <div class="row">
            <div class="col-lg-12">
              <div class="item">
                <h4>4.</h4>
                <img src="{{ asset('images/author.jpg') }}" alt="" style="max-width: 50px; max-height: 50px; border-radius: 50%;">
                <h6>Liberty Artist<br><a href="#">4.5 ETH or $11,600</a></h6>
              </div>
            </div>
            <div class="col-lg-12">
              <div class="item">
                <h4>5.</h4>
                <img src="{{ asset('images/author-02.jpg') }}" alt="" style="max-width: 50px; max-height: 50px; border-radius: 50%;">
                <h6>Ronald Martino<br><a href="#">7.2 ETH or $14,500</a></h6>
              </div>
            </div>
            <div class="col-lg-12">
              <div class="item">
                <h4>6.</h4>
                <img src="{{ asset('images/author-03.jpg') }}" alt="" style="max-width: 50px; max-height: 50px; border-radius: 50%;">
                <h6>Anthony Brown<br><a href="#">8.6 ETH or $7,400</a></h6>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-4 col-sm-6">
          <div class="row">
            <div class="col-lg-12">
              <div class="item">
                <h4>7.</h4>
                <img src="{{ asset('images/author.jpg') }}" alt="" style="max-width: 50px; max-height: 50px; border-radius: 50%;">
                <h6>Liberty Artist<br><a href="#">9.8 ETH or $14,200</a></h6>
              </div>
            </div>
            <div class="col-lg-12">
              <div class="item">
                <h4>8.</h4>
                <img src="{{ asset('images/author-02.jpg') }}" alt="" style="max-width: 50px; max-height: 50px; border-radius: 50%;">
                <h6>Ronald Martino<br><a href="#">6.5 ETH or $15,000</a></h6>
              </div>
            </div>
            <div class="col-lg-12">
              <div class="item">
                <h4>9.</h4>
                <img src="{{ asset('images/author-03.jpg') }}" alt="" style="max-width: 50px; max-height: 50px; border-radius: 50%;">
                <h6>David Walker<br><a href="#">2.5 ETH or $12,000</a></h6>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div> -->
@endsection('content')