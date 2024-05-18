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
            <h2>
              Информация о модели 
              <em>{{ $ad->title }}</em>
            </h2>
          </div>
        </div>
        <div class="col-lg-7">
          <div class="left-image">
            <img class="model-detail-model-img" src="{{ asset($ad->photo_link) }}" alt="Изображение модели"/>
          </div>
        </div>
        <div class="col-lg-5 align-self-center">
        	<h4>{{ $ad->title }}</h4>
          <span class="author">
            <img class="model-detail-user-img" src="{{ asset($ad->user->avatar_url) }}" alt="Изображение автора"/>
            <h6>
              <a href="{{ route('main.users.detail', ['user' => $ad->user]) }}">{{ $ad->user->name }}</a>
            </h6>
          </span>
          <p>{{ $ad->description }}</p>
          <div class="row">
            <div class="col">
              <span class="bid">
                Цена
                <br>
                <strong>{{ $ad->price }} рублей</strong>
              </span>
              <span class="bid text-center">
                Средняя оценка
                <br>
                <strong>{{ $ad->get_average_rating() }}</strong>
              </span>
            </div>
          </div>
          <div class="main-button">
            <a href="{{ route('main.ads.buy', ['ad' => $ad]) }}" class="main-button">Купить</a>
          </div>
        </div>
      </div>
      <div class="currently-market">
        <div class="container">
	        <div class="row">
	          <div class="col-lg-6">
		          <div class="section-heading">
		            <div class="line-dec"></div>
			          <h2>
                  <em>Отзывы</em>
                </h2>
		          </div>
		        </div>
	        </div>
	        <div class="col-lg-12">
		        <div class="row grid">
              @foreach ($ad->reviews_with_pagination() as $review)
                <div class="col-lg-12"> 
                  <div class="row grid">
                    <div class="col-lg-6 currently-market-item all msc">
                      <div class="item">
                        <div class="right-content">
                          <span class="author">
                            <h6><a href="{{ route('main.users.detail', ['user' => $ad->user]) }}">{{ $ad->user->name }}</a></h6>
                          </span>
                          <h4>{{ $review->title }}</h4>
                          <div class="line-dec"></div>
                          <span class="bid">
                            {{ $review->text }}
                          </span>
                          <div class="line-dec"></div>
                          <span class="bid">
                            @if ($review->is_recommended)
                              Рекомендую!
                            @else
                              Не рекомендую!
                            @endif
                          </span>
                          <span style="color: gold;">
                            @if ($review->rate == 5)
                              ★★★★★
                            @elseif ($review->rate == 4)
                              ★★★★
                            @elseif ($review->rate == 3)
                              ★★★
                            @elseif ($review->rate == 2)
                              ★★
                            @else
                              ★
                            @endif
                          </span>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              @endforeach
              {{ $ad->reviews_with_pagination()->links('pagination::bootstrap-4') }}
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection('page')